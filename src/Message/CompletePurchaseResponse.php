<?php

namespace Omnipay\Datatrans\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Datatrans Complete Purchase Response
 */
class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        $status = $this->getCode();

        return $status === 1;
    }

    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return $this->data['responseMessage'];
        }

        return '';
    }

    public function getCode()
    {
        return isset($this->data['responseCode']) ? $this->data['responseCode'] : '';
    }

    public function getTransactionReference()
    {
        return isset($this->data['refno']) ? $this->data['refno'] : '';
    }
}
