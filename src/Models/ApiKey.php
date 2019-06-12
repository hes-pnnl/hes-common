<?php
class ApiKey extends Model
{

    const API_KEY_STATUS = [
        self::ACTIVE_STATUS,
        self::INACTIVE_STATUS,
        self::CANDIDATE_STATUS
    ];

    /** @var int|null */
    protected $keyId;

    //the actual value of the api key
    /** @var string|null */
    protected $apiKey;

    /** @var string|null */
    protected $softwareProvider;

    /** @var string|null */
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
     * @return int
     */
    public function getApiKey() : ApiKey
    {
        return $this->apiKey;
    }

    /**
     * @return int
     */
    public function getSoftwareProvider() : string
    {
        return $this->softwareProvider;
    }

    /**
     * @return int
     */
    public function getApplication() : string
    {
        return $this->application;
    }

    /**
     * @return int
     */
    public function getStatus() : string
    {
        return $this->status;
    }

    //Setter methods
    /**
     * @return ApiKey
     */
    public function setApiKey(string $apiKey) : ApiKey
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return ApiKey
     */
    public function setSoftwareProvider(string $softwareProvider) : ApiKey
    {
        $this->softwareProvider = $softwareProvider;
        return $this;
    }

    /**
     * @return ApiKey
     */
    public function setApplication(string $application) : ApiKey
    {
        $this->application = $application;
        return $this;
    }

    /**
     * @return ApiKey
     */
    public function setStatus(string $status) : ApiKey
    {
        $this->status = $status;
        return $this;
    }
 }