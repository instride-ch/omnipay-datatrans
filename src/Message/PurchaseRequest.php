<?php
/**
 * w-vision
 *
 * LICENSE
 *
 * This source file is subject to the MIT License
 * For the full copyright and license information, please view the LICENSE.md
 * file that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2016 Woche-Pass AG (http://www.w-vision.ch)
 * @license    MIT License
 */

namespace Omnipay\Datatrans\Message;

class PurchaseRequest extends AbstractRedirectRequest
{
    /**
     * @var array
     */
    protected $optionalParams = array(
        'useAlias',
        'uppReturnMaskedCC',
        'uppRememberMe',
        'paymentMethod'
    );

    /**
     * @return array
     */
    public function getData()
    {
        $data = parent::getData();

        //set customer details if set
        if (($customerDetails = $this->getParameter('uppCustomerDetails')) && is_array($customerDetails)) {
            $data['uppCustomerDetails'] = 'yes';
            foreach ($customerDetails as $key => $value) {
                $data[$key] = $value;
            }
        }

        // card data for prefilling redirect form
        $this->addCardData($data);

        return $data;
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setUppReturnMaskedCC($value)
    {
        return $this->setParameter('uppReturnMaskedCC', $value);
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setUseAlias($value)
    {
        return $this->setParameter('useAlias', $value);
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setUppCustomerDetails($value)
    {
        return $this->setParameter('uppCustomerDetails', $value);
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setUppRememberMe($value)
    {
        return $this->setParameter('uppRememberMe', $value);
    }

    /**
     * enable functionality to prefill datatrans form in redirect mode
     *
     * @param $data
     */
    private function addCardData(&$data)
    {
        // rename paymentmethod if set
        if (isset($data['paymentMethod'])) {
            $data['paymentmethod'] = $data['paymentMethod'];
            unset($data['paymentMethod']);
        }

        if ($card = $this->getCard()) {
            if ($expMonth = $card->getExpiryMonth()) {
                $data['expm'] = $expMonth;
            }

            if ($expYear = $card->getExpiryDate('y')) {
                $data['expy'] = $expYear;
            }

            if ($number = $card->getNumber()) {
                $data['aliasCC'] = $number;
            }
        }
    }
}
