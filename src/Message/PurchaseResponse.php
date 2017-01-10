<?php

namespace Omnipay\Datatrans\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Datatrans purchase redirect response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @var string
     */
    protected $productionEndpoint = 'https://payment.datatrans.biz/upp/jsp/upStart.jsp';

    /**
     * @var string
     */
    protected $testEndpoint = 'https://pilot.datatrans.biz/upp/jsp/upStart.jsp';

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * Gets the redirect target url.
     */
    public function getRedirectUrl()
    {
        return $this->getCheckoutEndpoint();
    }

    /**
     * Get the required redirect method (either GET or POST).
     */
    public function getRedirectMethod()
    {
        return 'POST';
    }

    /**
     * Gets the redirect form data array, if the redirect method is POST.
     */
    public function getRedirectData()
    {
        // Build the post data as expected by Datatrans.
        $params = $this->getData();
        $getData = array();
        foreach ($params as $key => $value) {
            $getData[$key] = $value;
        }

        return $getData;
    }

    /**
     * @return string
     */
    protected function getCheckoutEndpoint()
    {
        $req = $this->getRequest();

        if($req->getTestMode()) {
            return $this->testEndpoint;
        }

        return $this->productionEndpoint;
    }
}
