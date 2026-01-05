<?php

namespace App\Helpers;

class PriceHelper
{
    protected static $numbers = [
        '0' => '०',
        '1' => '१',
        '2' => '२',
        '3' => '३',
        '4' => '४',
        '5' => '५',
        '6' => '६',
        '7' => '७',
        '8' => '८',
        '9' => '९'
    ];

    public static function toNepaliNumerals($number)
    {
        $number = (string) $number;
        return strtr($number, self::$numbers);
    }

    public static function format($amount, $unit = null)
    {
        $nepaliAmount = self::toNepaliNumerals(number_format($amount, 2));
        $suffix = '';

        if ($unit) {
            $unitMap = [
                'Litre' => 'प्रति लिटर',
                'KG' => 'प्रति केजी',
                'Gram' => 'प्रति ग्राम',
                'Tola' => 'प्रति तोला',
                'Unit' => 'प्रति युनिट',
                'Ltr' => 'प्रति लिटर',
                'Cylinder' => 'प्रति सिलिन्डर',
                'Cyl' => 'प्रति सिलिन्डर',
            ];
            $suffix = ' ' . ($unitMap[$unit] ?? $unit);
        }

        return 'रु ' . $nepaliAmount . $suffix;
    }

    public static function getFlag($currency)
    {
        $map = [
            'USD' => 'us',
            'EUR' => 'eu',
            'GBP' => 'gb',
            'INR' => 'in',
            'AUD' => 'au',
            'CAD' => 'ca',
            'JPY' => 'jp',
            'CNY' => 'cn',
            'NPR' => 'np',
            'SAR' => 'sa',
            'AED' => 'ae',
            'MYR' => 'my',
            'KRW' => 'kr',
            'SGD' => 'sg'
        ];
        $code = $map[$currency] ?? strtolower(substr($currency, 0, 2));
        return "https://flagcdn.com/w40/{$code}.png";
    }

    public static function getCurrencySymbol($currency)
    {
        $symbols = [
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'INR' => '₹',
            'JPY' => '¥',
            'CNY' => '¥',
            'AUD' => 'A$',
            'CAD' => 'C$'
        ];
        return $symbols[$currency] ?? $currency;
    }
}
