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

namespace Omnipay\Datatrans\Message;

/**
 * Class TokenizeRequest
 *
 * @package Omnipay\Datatrans\Message
 */
class TokenizeRequest extends AbstractRedirectRequest
{
    /**
     * @var string
     */
    protected $apiEndpoint = 'upStart.jsp';

    /**
     * @return array
     */
    public function getData()
    {
        $this->validate('merchantId', 'transactionId', 'sign', 'returnUrl', 'errorUrl', 'cancelUrl');

        $data = array(
            'merchantId' => $this->getMerchantId(),
            'refno'      => $this->getTransactionId(),
            'amount'     => 0,
            'currency'   => $this->getCurrency(),
            'sign'       => $this->getSign(),
            'useAlias'   => 'yes'
        );

        $data['successUrl'] = $this->getReturnUrl();
        $data['cancelUrl'] = $this->getCancelUrl();
        $data['errorUrl'] = $this->getErrorUrl();
        $data['cancelUrl'] = $this->getCancelUrl();

        return $data;
    }

    /**
     * @param mixed $data
     *
     * @return TokenizeRequest
     */
    public function sendData($data)
    {
        return $this->response = new TokenizeResponse($this, $data);
    }
}
