<?php
/**
 * w-vision
 *
 * LICENSE
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2016 Woche-Pass AG (http://www.w-vision.ch)
 * @license    GNU General Public License version 3 (GPLv3)
 */

namespace Omnipay\Datatrans\Message;

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * Datatrans abstract request.
 * Implements all property setters and getters.
 */
abstract class XmlRequest extends AbstractRequest
{
    /**
     * The XML API Endpoint Base URL
     *
     * @var string
     */
    protected $apiBaseProdUrl = 'https://payment.datatrans.biz/upp/jsp';
    /**
     * The XML API Endpoint Base URL
     *
     * @var string
     */
    protected $apiBaseTestUrl = 'https://pilot.datatrans.biz/upp/jsp';

    /**
     * defines the endpoint for a specific api
     *
     * @var string
     */
    protected $apiEndpoint = null;

    /**
     * @var string
     */
    protected $serviceName = null;

    /**
     * @var int
     */
    protected $serviceVersion = null;

    /**
     * @param $requestChild
     * @return mixed
     */
    protected function prepareRequestXml($requestChild)
    {
        $fields = $this->getData();

        foreach ($fields as $key => $value) {
            if (is_array($value)) {
                $array = $requestChild->addChild($key);

                foreach ($value as $subKey => $subValue) {
                    $array->addChild($subKey, $subValue);
                }
            } else {
                $requestChild->addChild($key, $value);
            }
        }

        return $requestChild;
    }

    /**
     * Generate XML for request
     *
     * @return \SimpleXMLElement
     */
    protected function getRequestXml()
    {
        $serviceXmlNode = "<" . $this->getServiceName() . "/>";
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' . $serviceXmlNode);
        $xml->addAttribute('version', $this->getServiceVersion());

        $bodyChild = $xml->addChild('body');
        $bodyChild->addAttribute('merchantId', $this->getMerchantId());

        $transactionChild = $bodyChild->addChild('transaction');
        $transactionChild->addAttribute('refno', $this->getTransactionId());

        $requestChild = $transactionChild->addChild('request');

        $this->prepareRequestXml($requestChild);

        $requestChild->addChild('sign', $this->getSign());

        return $xml;
    }

    /**
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * @return int
     */
    public function getServiceVersion()
    {
        return $this->serviceVersion;
    }

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * @param mixed $data
     * @return XmlResponse
     *
     * @throws InvalidResponseException
     */
    public function sendData($data)
    {
        $httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            array(
                'Accept' => 'application/xml',
                'Content-type' => 'application/xml',
            ),
            $this->getRequestXml()->asXML()
        );


        // Might be useful to have some debug code here, PayPal especially can be
        // a bit fussy about data formats and ordering.  Perhaps hook to whatever
        // logging engine is being used.
        // echo "Data == " . json_encode($data) . "\n";

        try {
            $httpRequest->getCurlOptions()->set(CURLOPT_SSLVERSION, 6); // CURL_SSLVERSION_TLSv1_2 for libcurl < 7.35
            $httpResponse = $httpRequest->send();
            // Empty response body should be parsed also as and empty array
            $body = $httpResponse->getBody(true);
            $xmlResponse = !empty($body) ? $httpResponse->xml() : '';

            /*var_dump($httpResponse->getRawHeaders());
            echo $httpResponse->getBody(true);
            exit;*/

            if ($xmlResponse instanceof \SimpleXMLElement) {
                $response = $xmlResponse->body->transaction;

                $response = json_decode(json_encode($response), true);

                return $this->response = $this->createResponse($response);
            }

            throw new InvalidResponseException('Error communicating with payment gateway');
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }

    /**
     * @param $data
     *
     * @return XmlResponse
     */
    protected function createResponse($data)
    {
        return $this->response = new XmlResponse($this, $data);
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        $base = $this->getTestMode() ? $this->getApiBaseTestUrl() : $this->getApiBaseProdUrl();
        return $base . '/' . $this->getApiEndpoint();
    }

    /**
     * @return string
     */
    public function getApiBaseProdUrl()
    {
        return $this->apiBaseProdUrl;
    }

    /**
     * @return string
     */
    public function getApiBaseTestUrl()
    {
        return $this->apiBaseTestUrl;
    }

    /**
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }
}
