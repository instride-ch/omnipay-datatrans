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

use Omnipay\Common\Message\AbstractResponse;

/**
 * Datatrans Complete Purchase Response
 */
class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        $status = $this->getStatus();

        return $status === 'success';
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return $this->data['responseMessage'];
        }

        return '';
    }

    /**
     * @return string
     */
    public function getTransactionReference()
    {
        return isset($this->data['refno']) ? $this->data['refno'] : '';
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->data['status'];
    }
}
