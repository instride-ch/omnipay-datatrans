<?php

namespace Omnipay\Datatrans;

use Omnipay\Common\AbstractGateway;

/**
 * Datatrans Gateway
 *
 * @TODO: add optional fields
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Datatrans';
    }

    public function getDefaultParameters()
    {
        return array(
            // general params
            'merchantId'        => '',
            'sign'              => '',
            'testMode'          => true,

            // template parameters
            'theme'             => ''
        );
    }

    /**
     * @param $value
     * @return $this
     */
    public function setMerchantId($value) {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * get the merchant id
     *
     * @return string
     */
    public function getMerchantId() {
        return  $this->getParameter('merchantId');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setSign($value) {
        return $this->setParameter('sign', $value);
    }

    /**
     * @return string
     */
    public function getSign() {
        return $this->getParameter('sign');
    }

    /**
     * Start a purchase request
     *
     * @param array $parameters array of options
     * @return \Omnipay\Datatrans\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Datatrans\Message\PurchaseRequest', $parameters);
    }

    /**
     * Complete a purchase
     *
     * @param array $parameters
     * @return \Omnipay\Datatrans\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Datatrans\Message\CompletePurchaseRequest', $parameters);
    }
}
