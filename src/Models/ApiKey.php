<?php
class ApiKey extends Model
{

    const VALID_API_KEY_STATUS_VALS = [
        self::ACTIVE_STATUS,
        self::INACTIVE_STATUS,
        self::CANDIDATE_STATUS
    ];

    /** @var int */
    protected $keyId;

    /**
    * The actual value of the API key - the string that is passed in the user_key field of SOAP API calls
    * @var string
    */
    protected $apiKeyString;

    /** @var int */
    protected $softwareProvider;

    /** @var string */
    protected $application;

    /** @var string */
    protected $status;

    //Getter methods
    /**
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getApiKeyString() : string
    {
        return $this->apiKeyString;
    }

    /**
     * @return string
     */
    public function getSoftwareProvider() : string
    {
        return $this->softwareProvider;
    }

    /**
     * @return string
     */
    public function getApplication() : string
    {
        return $this->application;
    }

    /**
     * @return string
     */
    public function getStatus() : string
    {
        return $this->status;
    }

    //Setter methods
    /**
     * @return ApiKey
     * @param string $apiKeyString
     */
    public function setApiKey(string $apiKeyString) : ApiKey
    {
        $this->apiKeyString = $apiKeyString;
        return $this;
    }

    /**
     * @return ApiKey
     * @param string $softwareProvider
     */
    public function setSoftwareProvider(string $softwareProvider) : ApiKey
    {
        $this->softwareProvider = $softwareProvider;
        return $this;
    }

    /**
     * @return ApiKey
     * @param string $application
     */
    public function setApplication(string $application) : ApiKey
    {
        $this->application = $application;
        return $this;
    }

    /**
     * @return ApiKey
     * @param string $status Must be one of the values contained VALID_API_KEY_STATUS_VALS
     * @throws \InvalidArgumentException
     */
    public function setStatus(string $status) : ApiKey
    {
        if (in_array($status, self::VALID_API_KEY_STATUS_VALS)) {
            $this->status = $status;
            return $this;
        } else {
            throw new \InvalidArgumentException("Unexpected status value '$status'. Must be one of this class's VALID_API_KEY_STATUS_VALS constants");
        }
    }
 }