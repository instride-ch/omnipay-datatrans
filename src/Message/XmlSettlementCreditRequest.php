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
 * Class XmlSettlementCreditRequest
 *
 * @package Omnipay\Datatrans\Message
 */
class XmlSettlementCreditRequest extends XmlSettlementRequest
{
    /**
     * @return string
     */
    public function getTransactionType() {
        return static::DATATRANS_TRANSACTION_TYPE_CREDIT;
    }
}
