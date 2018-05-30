# Telify Client

This is a PSR-4 compliant PHP class for using the Telify Closed-Loop Telephone Number Verification Service. 
If a user enters his/her phone number on your website (e.g. in a sign-up form), you can easily use the Telify service
to verify, that the provided phone number actually belongs to the person who gave it to you. This is how it works:

*  Send the user provided phone number to the Telify service.
*  Telify calls the phone number and announces a randomly generated verification code. Telify returns a unique call ID you need to make your website "remember". 
*  Present the user an input field for entering his verification code.
*  Send the given code along with the call ID back to the Telify service to check if it's correct.
*  If it's correct, save the user's ip address and timestamp to prove that the phone number has been successfully verified.

See the [Telify Website](https://www.bequadrat.de/systeme-loesungen/telify-telefonverifizierung.html) for further information
on pricing, how it works and a live demo.

## Installation via Composer

You'll need PHP 7.0 with the SOAP extension enabled. No other dependencies required.

Simply add the Telify Client to your Composer-managed project by requiring it:

```
composer require matoki/telify-client
```

## Usage

1.  Instantiate the Client using your credentials:
```php
$telify = new Matoki\Telify\Client('username', 'password');
```
2.  Trigger a call to a phone number using the configuration of a given campaign:
```php
$response = $telify->call('06150-5070150', 'campaign');
$callId = $response['callId']; // You'll need this to verify the phone number
$codeLength = $response['codeLength']; // Tells you the length of the verification code generated for this call
```
3.  Verify the phone number with the verification code as announced by Telify
```php
$result = $telify->verify($callId, $code); // $result is true if the verification code was correct
```

If an error occurs, the `Matoki\Telify\Client` will throw an `Matoki\Telify\Exception`, so be sure to wrap the method calls on the Client in a `try...catch` block.
