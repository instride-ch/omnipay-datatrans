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

namespace Omnipay\Datatrans;

use Omnipay\Datatrans\Message\TokenizeRequest;

/**
 * Datatrans Gateway
 *
 * @TODO: add optional fields
 */
class XmlGateway extends AbstractDatatransGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Datatrans XML';
    }

    /**
     * @param array $options
     * @return Message\XmlAuthorizationRequest
     */
    public function purchase(array $options = array())
    {
        return $this->authorize($options);
    }

    /**
     * @param array $options
     * @return \Omnipay\Datatrans\Message\XmlAuthorizationRequest
     */
    public function authorize(array $options = array())
    {
        return $this->createRequest('\Omnipay\Datatrans\Message\XmlAuthorizationRequest', $options);
    }

    /**
     * @param array $options
     * @return \Omnipay\Datatrans\Message\XmlSettlementRequest
     */
    public function settlementDebit(array $options = array())
    {
        return $this->createRequest('\Omnipay\Datatrans\Message\XmlSettlementRequest', $options);
    }

    /**
     * @param array $options
     * @return \Omnipay\Datatrans\Message\XmlSettlementRequest
     */
    public function settlementCredit(array $options = array())
    {
        return $this->createRequest('\Omnipay\Datatrans\Message\XmlSettlementCreditRequest', $options);
    }

    /**
     * @param array $options
     * @return \Omnipay\Datatrans\Message\XmlSettlementRequest
     */
    public function void(array $options = array())
    {
        return $this->createRequest('\Omnipay\Datatrans\Message\XmlCancelRequest', $options);
    }

    /**
     * @param array $options
     * @return \Omnipay\Datatrans\Message\XmlStatusRequest
     */
    public function status(array $options = array())
    {
        return $this->createRequest('\Omnipay\Datatrans\Message\XmlStatusRequest', $options);
    }
}
