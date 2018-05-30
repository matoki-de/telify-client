# Telify Client

This is a PSR-4 compliant PHP class for using the Telify Closed-Loop Telephone Number Verification Service. 
If a user enters his/her phone number on your website (e.g. in a sign-up form), you can easily use the
Telify service to verify, that the provided phone number actually belongs to the person who gave it to you.

This is how it works:

1.  Send the user provided phone number to the Telify service.
2.  Telify calls the phone number and announces a randomly generated verification code.
    Telify returns a unique call ID you need to make your website "remember".
3.  Present the user an input field for entering his verification code.
4.  Send the given code along with the call ID back to the Telify service to check if it's correct.
5.  If it's correct, save the user's IP address and the current timestamp to prove that the phone
    number has been successfully verified.

See the [Telify Website](https://www.bequadrat.de/systeme-loesungen/telify-telefonverifizierung.html) for
further information on pricing, how it works and an interactive demo.

## Installation via Composer

You'll need PHP 7.0+ with the SOAP extension enabled. No other dependencies required.

Simply add the Telify Client to your Composer-managed project by requiring it:

```
composer require matoki/telify-client
```

## Usage

Instantiate the Client using your credentials:
```php
$telify = new Matoki\Telify\Client('username', 'password');
```

Trigger a call to a phone number using the configuration of a given campaign and make your app "remember"
the returned `$callId` (e.g. store it within the user's session variable).
```php
$callId = $telify->call('06150-5070150', 'campaign');
```

Verify the phone number with the verification code as announced by Telify. `$result` will be true, if the verification code was correct.
```php
$result = $telify->verify($callId, $code);
```

If an error occurs, the Client throws an `Matoki\Telify\Exception`, so make sure to wrap the method calls on the Client in a `try...catch` block.