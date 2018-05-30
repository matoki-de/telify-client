<?php

/**
 * Telify - A Closed Loop Telephone Number Verification Service
 *
 * This is an implementation of a PSR-4 compliant PHP class for using the Telify Closed-Loop
 * Telephone Number Verification Service
 *
 * @author Christian Schätzlein <c.schaetzlein@bequadrat.de>
 * @see https://www.bequadrat.de/systeme-loesungen/telify-telefonverifizierung.html
 */

namespace Matoki\Telify;

use SoapClient;
use SoapFault;

class Client
{

    /**
     * The URL to the WSDL file to consume by the SOAP Client
     */
    const SOAP_WSDL = 'https://bequadrat.de/telify-api/wsdl';

    /**
     * The SoapClient instance to use for making requests to the remote Telify API
     *
     * @var SoapClient
     */
    private $soapClient;

    /**
     * TelifyClient Constructor
     *
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->soapClient = new SoapClient(self::SOAP_WSDL, [
            'login' => $username,
            'password' => $password
        ]);
    }

    /**
     * Calls a destination phone number using the given campaign settings
     * and returns the call ID and the length of the code being sent to the
     * destination number
     *
     * @param string $destination
     * @param string $campaign
     * @throws Exception
     * @return int
     */
    public function call(string $destination, string $campaign)
    {
        $response = $this->sendRequest('call', [$campaign, $destination]);
        return (int)$response['id'];
    }

    /**
     * Verifies a previously called phone number identified by its call ID and the
     * given code.
     *
     * @param int $callId
     * @param string $code
     * @throws Exception
     * @return boolean
     */
    public function verify(int $callId, string $code)
    {
        $response = $this->sendRequest('verify', [$callId, $code]);
        return (bool)$response['result'];
    }

    /**
     * Sends a SOAP request to the remote service
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     * @throws Exception
     */
    protected function sendRequest(string $method, array $arguments)
    {
        try {
            return $this->soapClient->__soapCall($method, $arguments);
        } catch (SoapFault $e) {
            throw new Exception((int)$e->faultcode);
        }
    }

}

?>