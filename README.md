# Omnipay: Datatrans

**Datatrans Gateway for the Omnipay PHP payment processing library.**

[![Build Status](https://api.travis-ci.org/instride/omnipay-datatrans.png)](https://travis-ci.org/instride/omnipay-datatrans)
[![Code Coverage](https://scrutinizer-ci.com/g/instride/omnipay-datatrans/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/instride/omnipay-datatrans/?branch=main)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/instride/omnipay-datatrans/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/instride/omnipay-datatrans/?branch=main)
[![Latest Stable Version](https://poser.pugx.org/instride/omnipay-datatrans/v/stable)](https://packagist.org/packages/instride/omnipay-datatrans)
[![Latest Unstable Version](https://poser.pugx.org/instride/omnipay-datatrans/v/unstable)](https://packagist.org/packages/instride/omnipay-datatrans)
[![License](https://poser.pugx.org/instride/omnipay-datatrans/license)](https://packagist.org/packages/instride/omnipay-datatrans)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework-agnostic, multi-gateway payment
processing library for PHP 5.3+.

This Gateway implements offsite payments via Datatrans. Purchase and Authorization are available,
capturing an authorized payment has to be performed via Datatrans backend (not currently implemented for this Gateway).

## Installation

Omnipay can be installed using [Composer](https://getcomposer.org/). [Installation instructions](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

Run the following command to install omnipay and the datatrans gateway:

    composer require instride/omnipay-datatrans:^1.0.0

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

