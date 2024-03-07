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

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * PayPal REST Authorize Response
 */
class XmlAuthorizationResponse extends XmlResponse implements RedirectResponseInterface
{
    /**
     * @return null
     */
    public function getUppTransactionId()
    {
        if (isset($this->data['response'])) {
            return $this->data['response']['uppTransactionId'];
        }

        return null;
    }
}
