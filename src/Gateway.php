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
