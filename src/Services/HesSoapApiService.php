<?php

namespace HESCommon\Services;

/**
 * Class HesSoapApiService
 *
 * Supports communication with the HES SOAP interface
 */
abstract class HesSoapApiService
{
    /**
     * Defines methods that are handled by the LBNL API rather than by our own
     * code. Calls to these methods will be transparently passed to the copy of
     * the LBNL API that we are running and the response will be passed back to
     * the caller.
     *
     * @var array
     */
    const LBNL_METHODS = [
        'submit_hpxml_inputs',
        'submit_inputs',
        'calculate_base_building',
        'calculate_package_building',
        'commit_results',
        'retrieve_extended_results',
        'retrieve_inputs',
        'retrieve_recommendations',
        'retrieve_results'
    ];

    /**
     * The URI of the SOAP API's WSDL
     *
     * @var string
     */
    protected $soapApiWsdlUri;

    /**
     * Map of operation names to the names of the main element used to wrap requests to that operation.
     * Only required for operations whose wrapper element isn't the name of the operation itself.
     *
     * @var array
     */
    protected $mainElementNames = [
        'retrieve_buildings_by_id'        => 'buildings_by_id',
        'retrieve_buildings_by_partner'   => 'buildings_by_partner',
        'retrieve_buildings_by_mentor'    => 'buildings_by_mentor',
        'retrieve_buildings_by_address'   => 'buildings_by_address',
        'submit_address'                  => 'building_address',
        'submit_inputs'                   => 'building',
        'generate_label'                  => 'building_label',
        'generate_custom_label'           => 'custom_building_label',

        'retrieve_inputs'                 => 'building_info',
        'retrieve_recommendations'        => 'building_info',
        'retrieve_extended_results'       => 'building_info',
        'retrieve_label_results'          => 'building_info',
        'retrieve_hpwes'                  => 'building_info',
        'calculate_base_building'         => 'building_info',
        'commit_results'                  => 'building_info',
        'calculate_package_building'      => 'building_info',
        'get_building_status'             => 'building_info',
        'validate_inputs'                 => 'building_info',
        'building_ca_id'                  => 'building_info',
    ];

    /**
     * @var string
     */
    protected $userKey;

    /**
     * If TRUE, SOAP requests will be fired asynchronously
     *
     * @var bool
     */
    protected $isAsyncronousMode = false;

    /**
     * @param string $soapApiWsdlUri
     * @param string $userKey Pass to set a user key to be used in all calls.
     */
    public function __construct(string $soapApiWsdlUri, string $userKey)
    {
        $this->soapApiWsdlUri = $soapApiWsdlUri;
        $this->userKey = $userKey;
    }

    /**
     * @param bool $isAsynchronousMode
     */
    public function setAsynchronousMode(bool $isAsynchronousMode)
    {
        $this->isAsyncronousMode = $isAsynchronousMode;
    }

    /**
     * Retrieves the session token to be used for requests generated by generateSoapCall(). Abstract because the
     * session token is stored different ways in different HES applications
     */
    abstract public function getSessionToken() : ?string;

    /**
     * Generates a call to the HES SOAP API and returns the response.
     *
     * @throws \SoapFault If the SOAP call returns a SoapFault
     * @throws \RuntimeException If the SOAP call returns any error other than a SoapFault
     * @param string $operationName
     * @param array $parameters
     * @param bool $requireSessionToken
     * @return array|null NULL if we are in asynchronous mode
     */
    public function generateSoapCall(string $operationName, array $parameters, bool $requireSessionToken = true) : ?array
    {
        // Automatically add the session_token and user_key parameters to each outgoing request
        if ( !in_array($operationName, static::getNoSessionTokenMethods()) && empty($parameters['session_token']) && $requireSessionToken ) {
            $parameters['session_token'] = $this->getSessionToken();
        }
        $parameters['user_key'] = $this->userKey;

        $mainElementName = isset($this->mainElementNames[$operationName]) ? $this->mainElementNames[$operationName] : $operationName;
        $parameters = [
            $operationName . "Request" => [
                $mainElementName => $parameters
            ]
        ];

        $soapClient = $this->getSoapClient();
        $originalSocketTimeout = ini_get('default_socket_timeout');
        try {
            // Timeout after 10 minutes, unless we are in asynchronous mode, in which case we timeout immediately
            ini_set('default_socket_timeout', $this->isAsyncronousMode ? 1 : 600);
            $response = $soapClient->__soapCall($operationName, $parameters);
        } catch (\SoapFault $e) {
            // If we are in async mode, we will instantly fail with a SoapFault reading "Error Fetching http headers"
            // due to hitting the timeout - this is expected and can be ignored, but we won't have a response to
            // return, so we just return null.
            if ($this->isAsyncronousMode && $e->getMessage() == "Error Fetching http headers") {
                return null;
            }

            throw $e;
        } catch (\Exception $e) {
            throw new \RuntimeException("SOAP call to $operationName returned an unexpected error");
        } finally {
            // Clean up after ourselves by restoring the default_socket_timeout to the value it had before we messed with it
            ini_set('default_socket_timeout', $originalSocketTimeout);
        }

        $response = json_decode(json_encode($response), true); // Deep cast object to array

        if (count($response) == 1) {
            return reset($response);
        }

        // Most API methods always return a container that wraps a single child - thus the reset() call above. However,
        // some methods (e.g. retrieve_buildings_by_id if the filter doesn't match any buildings) can return an empty
        // container object.
        return [];
    }

    /**
     * @return \SoapClient
     */
    public function getSoapClient()
    {
        static $soapClient;

        if (!$soapClient) {
            $soapClient = new \SoapClient($this->soapApiWsdlUri, [
                'trace' => true, // Enables __getLastResponse(), which we use because it allows us to more easily pass a response back out from the LBNL API
                'exceptions' => true
            ]);
        }

        return $soapClient;
    }

    /**
     * @return string
     */
    public function getLastRequestXml()
    {
        return $this->getSoapClient()->__getLastRequest();
    }

    /**
     * @return string
     */
    public function getLastResponseXml()
    {
        return $this->getSoapClient()->__getLastResponse();
    }

    /**
     * Gets the names of all API methods that should not get a session_token field set. This is a method rather than a
     * constant so that child classes can override as necessary.
     *
     * @return string[]
     */
    public static function getNoSessionTokenMethods() : array
    {
        return [
            'get_session_token',

            // These methods require no session token because they are internal-only methods - they're not publicly accessible
            // at all and are only called via internal call to the LBNL API
            'calculate_base_building',
            'commit_results',
            'calculate_package_building'
        ];
    }
}
