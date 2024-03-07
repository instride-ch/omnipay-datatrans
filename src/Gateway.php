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

namespace Omnipay\Datatrans;

/**
 * Datatrans Gateway
 */
class Gateway extends AbstractDatatransGateway
{
    public function getName()
    {
        return 'Datatrans';
    }

    /**
     * Start a purchase request
     *
     * @param array $parameters array of options
     * @return \Omnipay\Datatrans\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Datatrans\Message\PurchaseRequest', $parameters);
    }

    /**
     * Complete a purchase
     *
     * @param array $parameters
     * @return \Omnipay\Datatrans\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Datatrans\Message\CompletePurchaseRequest', $parameters);
    }
}
