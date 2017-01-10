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

use Omnipay\Common\Message\ResponseInterface;

class PurchaseRequest extends AbstractRequest
{
    /**
     * @var array
     */
    protected $optionalParams = array(

    );

    /**
     * @return array
     */
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
                $data[$param] = $value;
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
     * @return string
     */
    public function setErrorUrl($value)
    {
        return $this->setParameter('errorUrl', $value);
    }

    /**
     * @return string
     */
    public function getErrorUrl()
    {
        return $this->getParameter('errorUrl');
    }

    /**
     * @return ResponseInterface
     */
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
