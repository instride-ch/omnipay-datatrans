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
 * Class XmlStatusRequest
 *
 * @package Omnipay\Datatrans\Message
 */
class XmlStatusRequest extends XmlSettlementRequest
{
    /**
     * @var array
     */
    protected $optionalParameters = array(
        'reqtype'
    );

    /**
     * @var string
     */
    protected $apiEndpoint = 'XML_status.jsp';

    /**
     * @var string
     */
    protected $serviceName = 'statusService';

    /**
     * @return array
     */
    public function getData()
    {
        $this->validate('merchantId', 'transactionId', 'sign', 'uppTransactionId');

        $data = array(
            'merchantId'        => $this->getMerchantId(),
            'sign'              => $this->getSign(),
            'uppTransactionId'  => $this->getUppTransactionId(),
            'refno'             => $this->getTransactionId()
        );

        foreach ($this->optionalParameters as $param) {
            $value = $this->getParameter($param);

            if ($value) {
                $data[$param] = $value;
            }
        }

        return $data;
    }
}
