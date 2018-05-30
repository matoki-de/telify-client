<?php

/**
 * Telify - A Closed Loop Telephone Number Verification Service
 * Exception thrown by the TelifyClient
 *
 * @author Christian Schätzlein <c.schaetzlein@bequadrat.de>
 * @see https://www.bequadrat.de/systeme-loesungen/telify-telefonverifizierung.html
 */

namespace Matoki\Telify;

use Exception as GenericException;

class Exception extends GenericException
{

    const ERROR_INTERNAL = 10;
    const ERROR_ALREADY_AUTHENTICATED = 20;
    const ERROR_UNAUTHENTICATED = 21;
    const ERROR_COUNTRYCODE_MISSING = 22;
    const ERROR_UNSUPPORTED_DESTINATION_COUNTRY = 23;
    const ERROR_PHONE_NUMBER_MISSING = 24;
    const ERROR_CAMPAIGN_OR_COUNTRYCODE_MISSING = 25;
    const ERROR_AUTHENTICATION_FAILED = 30;
    const ERROR_DESTINATION_COUNTRY_NOT_FOUND = 31;
    const ERROR_PHONENUMBER_NOT_ALLOWED = 32;
    const ERROR_DESTINATION_COUNTRY_NOT_ALLOWED = 33;
    const ERROR_CAMPAIGN_MISSING_OR_DISABLED = 34;
    const ERROR_COUNTRYCODE_INVALID = 35;
    const ERROR_CODE_INVALID = 36;

    const MESSAGES = [
        self::ERROR_INTERNAL => 'Internal error of Telify service unavailable',
        self::ERROR_ALREADY_AUTHENTICATED => 'Already authenticated',
        self::ERROR_UNAUTHENTICATED => 'Unauthenticated',
        self::ERROR_COUNTRYCODE_MISSING => 'Country code missing (possibly campaign configuration is missing default country code)',
        self::ERROR_UNSUPPORTED_DESTINATION_COUNTRY => 'Unsupported destination country',
        self::ERROR_PHONE_NUMBER_MISSING => 'Destination phone number is required',
        self::ERROR_CAMPAIGN_OR_COUNTRYCODE_MISSING => 'Campaign is required',
        self::ERROR_AUTHENTICATION_FAILED => 'Authentication failed',
        self::ERROR_DESTINATION_COUNTRY_NOT_FOUND => 'Unable to resolve destination country',
        self::ERROR_CAMPAIGN_MISSING_OR_DISABLED => 'Campaign not exists or disabled',
        self::ERROR_COUNTRYCODE_INVALID => 'Invalid country code',
        self::ERROR_CODE_INVALID => 'Verification code is invalid'
    ];

    public function __construct(int $code)
    {
        $this->code = $code;
        if (array_key_exists($code, self::MESSAGES)) {
            $this->message = self::MESSAGES[$code];
        }
    }
}