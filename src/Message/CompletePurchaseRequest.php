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

class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * @return array
     */
    public function getData()
    {
        return $this->httpRequest->request->all();
    }

    /**
     * @return ResponseInterface
     */
    public function send()
    {
        return $this->sendData($this->getData());
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
