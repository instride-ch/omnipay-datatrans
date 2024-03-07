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
 * Class XmlSettlementCreditRequest
 *
 * @package Omnipay\Datatrans\Message
 */
class XmlSettlementCreditRequest extends XmlSettlementRequest
{
    /**
     * @return string
     */
    public function getTransactionType()
    {
        return static::DATATRANS_TRANSACTION_TYPE_CREDIT;
    }
}
