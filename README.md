# Omnipay: Datatrans

**Datatrans Gateway for the Omnipay PHP payment processing library.**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+.

This Gateway implements offsite payments via Datatrans. Purchase and Authorization are available, capturing an authorized payment has to be performed via Datatrans backend (not currently implemented for this Gateway).

## Installation

Omnipay can be installed using [Composer](https://getcomposer.org/). [Installation instructions](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

Run the following command to install omnipay and the datatrans gateway:

    composer require w-vision/omnipay-datatrans~0.1

## Basic Usage

Payment requests to the Datatrans Gateway must at least supply the following parameters:

 - `merchantId` Your merchant ID
 - `transactionId` unique transaction ID
 - `amount` monetary amount
 - `currency` currency
 - `sign` Your sign identifier. Can be found in datatrans backend.

```php
$gateway = Omnipay::create('Datatrans');
$gateway->setMerchantId('merchantId');
$gateway->setSign('sign');

// Send purchase request
$response = $gateway->purchase(
    [
        'transactionId' => '17',
        'amount' => '10.00',
        'currency' => 'CHF'
    ]
)->send();

// This is a redirect gateway, so redirect right away
$response->redirect();

```

