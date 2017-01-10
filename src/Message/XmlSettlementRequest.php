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

/**
 * Class XmlSettlementRequest
 *
 * @package Omnipay\Datatrans\Message
 */
class XmlSettlementRequest extends XmlRequest
{
    /**
     * @var array
     */
    protected $optionalParameters = [
        'transtype', 'acqAuthorizationCode', 'errorEmail'
    ];

    /**
     * @var string
     */
    protected $apiEndpoint = 'XML_processor.jsp';

    /**
     * @var string
     */
    protected $serviceName = 'paymentService';

    /**
     * @var int
     */
    protected $serviceVersion = 3;

    /**
     * Settlement Debit/Credit
     */
    const DATATRANS_REQUEST_TYPE_COA = 'COA';

    /**
     * Submission of acqAuthorizationCode after referral
     */
    const DATATRANS_REQUEST_TYPE_REF = 'REF';

    /**
     * Submission of acqAuthorizationCode after denial
     */
    const DATATRANS_REQUEST_TYPE_REC = 'REC';

    /**
     * Transaction status request
     */
    const DATATRANS_REQUEST_TYPE_STA = 'STA';

    /**
     * Transaction cancel request
     */
    const DATATRANS_REQUEST_TYPE_DOA = 'DOA';

    /**
     * Re-Authorization of old transaction
     */
    const DATATRANS_REQUEST_TYPE_REA = 'REA';

    /**
     * Debit Transaction
     */
    const DATATRANS_TRANSACTION_TYPE_DEBIT = '05';

    /**
     * Credit Transaction
     */
    const DATATRANS_TRANSACTION_TYPE_CREDIT = '06';

    /**
     * @return array
     */
    public function getData()
    {
        $this->validate('merchantId', 'transactionId', 'sign', 'uppTransactionId');

        $requestType = $this->getRequestType();

        if(is_null($requestType)) {
            $requestType = self::DATATRANS_REQUEST_TYPE_COA;
        }

        $data = array(
            'merchantId'        => $this->getMerchantId(),
            'sign'              => $this->getSign(),
            'amount'            => $this->getAmountInteger(),
            'currency'          => $this->getCurrency(),
            'uppTransactionId'  => $this->getUppTransactionId(),
            'refno'             => $this->getTransactionId(),
            'reqtype'           => $requestType,
            'transtype'         => $this->getTransactionType()
        );

        foreach ($this->optionalParameters as $param) {
            $value = $this->getParameter($param);

            if ($value) {
                $data[$param] = $value;
            }
        }

        return $data;
    }

   /**
     * @param $value
     *
     * @return static
     */
    public function setUppTransactionId($value) {
        return $this->setParameter("uppTransactionId", $value);
    }

    /**
     * @return string
     */
    public function getUppTransactionId() {
        return $this->getParameter("uppTransactionId");
    }

    /**
     * @param $value
     *
     * @return static
     */
    public function setRequestType($value) {
        return $this->setParameter("requestType", $value);
    }

    /**
     * @return string
     */
    public function getRequestType() {
        return $this->getParameter("requestType");
    }

    /**
     * @return string
     */
    public function getTransactionType() {
        return static::DATATRANS_TRANSACTION_TYPE_DEBIT;
    }

    /**
     * @param $data
     * @return XmlResponse
     */
    protected function createResponse($data)
    {
        return $this->response = new XmlResponse($this, $data);
    }
}
