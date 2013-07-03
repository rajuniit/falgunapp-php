<?php

require_once 'falgunapp_client.php';

class FalgunApp
{
    /**
     * @var string
     */
    protected $logKey;

    /**
     * @var string
     */
    protected $logCode;

    /**
     * @var FalgunappClient
     */
    protected $falgunAppClient;

    /**
     * @var string
     */
    protected $apiEndPoint = 'http://localhost:3000/api';


    /**
     * @param $logKey string
     * @param $logCode string
     */
    public function __construct($logKey, $logCode)
    {
        $this->logKey = $logKey;
        $this->logCode = $logCode;
        $this->falgunAppClient = new FalgunappClient($this->apiEndPoint);
    }

    /**
     * @param array $data
     */
    public function logInfo(array $data)
    {
        $data['type'] = 'info';
        $this->falgunAppClient->post('/logs?log_key='. $this->logKey. '&code='. $this->logCode, $data);
    }

    /**
     * @param $exception
     */
    public function logException($exception)
    {
        $data = "<b>MESSAGE:</b> "  . $exception->getMessage() . "<br />";
        $data .= "<b>FILE:</b> "    . $exception->getFile() . ", " . $exception->getLine() . "<br />";
        $data .= "<b>CODE:</b> "    . get_class($exception) . "<br />";

        $filtered_data = array(
            'title' => $exception->getMessage(),
            'data' => $data,
            'type' => 'error'
        );

        $this->falgunAppClient->post('/logs?log_key='. $this->logKey. '&code='. $this->logCode, $filtered_data);

    }

    /**
     * @param $code string
     * @param $message string
     * @param $file string
     * @param $line string
     */
    public function errorHandler($code, $message, $file, $line)
    {

        $data = "<b>MESSAGE:</b> "  . $message . "<br />";
        $data .= "<b>FILE:</b> "    . $file . ", " . $line . "<br />";
        $data .= "<b>CODE:</b> "    . $code . "<br />";

        $filtered_data = array(
            'title' => $message,
            'data' => $data,
            'type' => 'error'
        );

        $this->falgunAppClient->post('/logs?log_key='. $this->logKey. '&code='. $this->logCode, $filtered_data);


    }

    /**
     * @param $exception
     */
    public function exceptionHandler($exception)
    {
        $data  = "<b>MESSAGE:</b> " . $exception->getMessage() . "<br />";
        $data .= "<b>FILE:</b> "    . $exception->getFile() . ", " . $exception->getLine() . "<br />";
        $data .= "<b>CODE:</b> "    . get_class($exception) . "<br />";

        $filtered_data = array(
            'title' => $exception->getMessage(),
            'data' => $data,
            'type' => 'error'
        );

        $this->falgunAppClient->post('/logs?log_key='. $this->logKey. '&code='. $this->logCode, $filtered_data);

    }

    /**
     *
     */
    public function enableCustomErrorHandler()
    {
        set_error_handler(array($this, "errorHandler"));
        set_exception_handler(array($this, "exceptionHandler"));
    }

}
