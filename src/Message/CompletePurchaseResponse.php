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
     * @return bool
     */
    public function isRedirect()
    {
        return false;
    }
}
