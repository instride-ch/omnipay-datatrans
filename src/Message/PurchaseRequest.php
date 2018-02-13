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
        'uppReturnMaskedCC'
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
}
