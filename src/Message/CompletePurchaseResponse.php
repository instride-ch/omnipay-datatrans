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
        $status = $this->getStatus();

        return $status === 'success';
    }

    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return $this->data['responseMessage'];
        }

        return '';
    }


    public function getTransactionReference()
    {
        return isset($this->data['refno']) ? $this->data['refno'] : '';
    }

    public function getStatus() {
        return $this->data['status'];
    }
}
