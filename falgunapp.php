<?php

require_once 'falgunapp_client.php';

class FalgunApp
{
    protected $logKey;
    protected $logCode;
    protected $falgunAppClient;
    protected $apiEndPoint = 'http://localhost:3000/api';
    protected $apiVersion = 1;


    public function __construct($logKey, $logCode)
    {
        $this->logKey = $logKey;
        $this->logCode = $logCode;
        $this->falgunAppClient = new FalgunappClient($this->apiEndPoint);
    }

    public function logInfo(array $data)
    {
        $data['type'] = 'info';
        $this->falgunAppClient->post('/logs?log_key='. $this->logKey. '&code='. $this->logCode, $data);
    }
}
