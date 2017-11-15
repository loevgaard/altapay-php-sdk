<?php
namespace Loevgaard\AltaPay;

use Alcohol\ISO4217;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

/**
 * Creates a Money object
 *
 * @param string $currency
 * @param int $amount
 * @return Money|null
 */
function createMoney(string $currency, int $amount = 0) : ?Money
{
    if (!$currency) {
        return null;
    }

    return new Money($amount, new Currency($currency));
}

/**
 * Takes a Money object and returns a float
 *
 * @param Money $money
 * @return float
 */
function floatFromMoney(Money $money = null) : ?float
{
    if (is_null($money)) {
        return null;
    }

    $currencies = new ISOCurrencies();
    $moneyFormatter = new DecimalMoneyFormatter($currencies);

    return $moneyFormatter->format($money);
}

/**
 * Creates a Money object from a float/string
 *
 * @param string $currency
 * @param float|string $amount
 * @return Money|null
 */
function createMoneyFromFloat(string $currency, $amount = 0.0) : ?Money
{
    return createMoney($currency, intval(100 * $amount));
}

function alphaCurrencyFromNumeric(int $numericCurrency) : string
{
    try {
        $iso4217 = new ISO4217();
        return $iso4217->getByNumeric($numericCurrency)['alpha3'];
    } catch (\OutOfBoundsException $e) {
        return '';
    }
}
