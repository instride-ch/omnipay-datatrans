<?php

/**
 * instride AG
 *
 * LICENSE
 *
 * This source file is subject to the MIT License
 * For the full copyright and license information, please view the LICENSE.md
 * file that are distributed with this source code.
 *
 * @copyright 2024 instride AG (https://instride.ch)
 * @license   MIT License
 */

namespace Omnipay\Datatrans;

use Omnipay\Common\AbstractGateway;
use Omnipay\Datatrans\Message\TokenizeRequest;

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
            'testMode'          => true
        );
    }

    /**
     * @param $value
     * @return $this
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * get the merchant id
     *
     * @return string
     */
    public function getMerchantId()
    {
        return  $this->getParameter('merchantId');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setSign($value)
    {
        return $this->setParameter('sign', $value);
    }

    /**
     * @return string
     */
    public function getSign()
    {
        return $this->getParameter('sign');
    }

    /**
     * @param array $options
     *
     * @return TokenizeRequest
     */
    public function createCard(array $options = array())
    {
        return $this->createRequest('\Omnipay\Datatrans\Message\TokenizeRequest', $options);
    }
}
