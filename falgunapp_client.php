<?php

/**
 * Falgunapp PHP Client
 *
 * A wrapper for the PECL HTTP client with helper functions to work with
 * falgunapp API.
 *
 * @copyright   Falgunapp.
 * @author      Raju Mazumder <rajuniit@gmail.com>
 */
class FalgunappClient
{
    /**
     * @var HttpRequest
     */
    protected $httpRequest;

    /**
     * @var string
     */
    protected $endPoint;


    /**
     * @param string $endPoint
     */
    public function __construct($endPoint)
    {
        $this->endPoint = $endPoint;
        $this->httpRequest = new HttpRequest($this->endPoint);
    }


    /**
     * @param string $path
     * @param array $data
     * @return string Response Body
     */
    public function post($path, $data)
    {
        $this->httpRequest->setUrl($this->endPoint . $path);
        $this->httpRequest->addPostFields($data);
        $this->httpRequest->setMethod(HttpRequest::METH_POST);
        $this->httpRequest->send();

        return $this->httpRequest->getResponseBody();
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function addHeader($key, $value)
    {
        $this->httpRequest->addHeaders(array($key => $value));
    }
}