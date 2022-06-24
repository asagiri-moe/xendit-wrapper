# Xendit Wrapper for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/asagiri-moe/xendit-wrapper.svg?style=flat-square)](https://packagist.org/packages/asagiri-moe/xendit-wrapper)
[![Total Downloads](https://img.shields.io/packagist/dt/asagiri-moe/xendit-wrapper.svg?style=flat-square)](https://packagist.org/packages/asagiri-moe/xendit-wrapper)
![GitHub Actions](https://github.com/asagiri-moe/xendit-wrapper/actions/workflows/main.yml/badge.svg)

A Laravel Wrapper for [Xendit](https://github.com/xendit/xendit-php) Payment Gateway (ID/PH)

## Installation
You can install the package via composer:

```bash
composer require asagiri-moe/xendit-wrapper
```

then publish the config file

```bash
php artisan vendor:publish --provider="AsagiriMoe\XenditWrapper\XenditWrapperServiceProvider"
```

in your `.env`

```bash
XENDIT_SECRET_KEY=""
XENDIT_REDIRECT_URL=""
XENDIT_CURRENCY=""
```
| .env                   | Description                                                                                                                                                                                                      | Accepted Value |
|------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|----------------|
| `XENDIT_SECRET_KEY=""`   | Your Xendit [Generated API Key](https://dashboard.xendit.co/settings/developers#api-keys). For guide how to generate API KEY: [Click Here](https://docs.xendit.co/api-integration/quick-start#generate-api-key). |                |
| `XENDIT_REDIRECT_URL=""` | Custom redirect url                                                                                                                                                                                              |                |
| `XENDIT_CURRENCY=""`     | Currency used for the transaction in ISO4217, Choose 1 which currency will you use in you apps                                                                                                                   | `"IDR"`,`"PHP"`    |

## Usage

### Example of usage
```php
use AsagiriMoe\XenditWrapper\XenditWrapper;

public function sendEWallet()
{
    $xendit = new XenditWrapper;

    $callback = $xendit->createEWalletPayment($idPayment, $typeEWallet, $amount, $phoneNumber, $metadata);

    return $callback;
}
```
---
## Avaliable Methods and Example

### E-Wallets
#### Create E-Wallet Charge
```php
$callback = $xendit->createEWalletPayment($idPayment, $typeEWallet, $amount, $phoneNumber, $metadata);
```

### QR Code (QRIS)
#### Create a QR Code (Currently only available in ID / Indonesia)
```php
$callback = $xendit->createQRPayment($idPayment, $amount, $callbackUrl);
```

---
### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email gfdioni@gmail.com instead of using the issue tracker.

## Credits

-   [Fernando Dioni](https://github.com/asagiri-moe)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
