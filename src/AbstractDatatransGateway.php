<?php

namespace Omnipay\Datatrans;

use Omnipay\Common\AbstractGateway;

/**
 * Datatrans Gateway
 *
 * @TODO: add optional fields
 */
abstract class AbstractDatatransGateway extends AbstractGateway
{
    /**
     * @return array
     */
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
}
