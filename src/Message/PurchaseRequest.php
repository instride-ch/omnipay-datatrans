<?php

namespace Omnipay\Datatrans\Message;

use Omnipay\Common\CreditCard;

class PurchaseRequest extends AbstractRequest
{
    protected $optionalParams = array(
        'theme'
    );

    public function getData()
    {
        $this->validate('merchantId', 'transactionId', 'sign');

        $data = array(
            'merchantId' => $this->getMerchantId(),
            'refno'      => $this->getTransactionId(),
            'amount'     => $this->getAmountInteger(),
            'currency'   => $this->getCurrency(),
            'sign'       => $this->getSign()
        );

        foreach ($this->optionalParams as $param) {
            $value = $this->getParameter($param);

            if ($value !== '') {
                $data[strtoupper($param)] = $value;
            }
        }

        $data['successUrl'] = $this->getReturnUrl();
        $data['cancelUrl'] = $this->getCancelUrl();
        $data['errorUrl'] = $this->getErrorUrl();
        $data['cancelUrl'] = $this->getCancelUrl();

        return $data;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setErrorUrl($value) {
        return $this->setParameter('errorUrl', $value);
    }

    /**
     * @return string
     */
    public function getErrorUrl() {
        return $this->getParameter('errorUrl');
    }

    // Send request the 1.x way
    public function send()
    {
        return $this->sendData($this->getData());
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
