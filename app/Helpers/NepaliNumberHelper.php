<?php

namespace App\Helpers;

class NepaliNumberHelper
{
    public static function currencyToWords($amount)
    {
        $amount = (string) $amount;
        $number = explode('.', $amount);
        $integerPart = $number[0];

        // Remove commas if any
        $integerPart = str_replace(',', '', $integerPart);

        if (!is_numeric($integerPart)) {
            return $amount;
        }

        $integerPart = (int) $integerPart;

        if ($integerPart == 0) {
            return 'शून्य';
        }

        $digits = [
            0 => 'शून्य',
            1 => 'एक',
            2 => 'दुई',
            3 => 'तीन',
            4 => 'चार',
            5 => 'पाँच',
            6 => 'छ',
            7 => 'सात',
            8 => 'आठ',
            9 => 'नौ',
            10 => 'दश',
            11 => 'एघार',
            12 => 'बाह्र',
            13 => 'तेह्र',
            14 => 'चौध',
            15 => 'पन्ध्र',
            16 => 'सोह्र',
            17 => 'सत्र',
            18 => 'अठार',
            19 => 'उन्नाइस',
            20 => 'बीस',
            21 => 'एक्काइस',
            22 => 'बाइस',
            23 => 'तेइस',
            24 => 'चौबीस',
            25 => 'पच्चीस',
            26 => 'छब्बीस',
            27 => 'सत्ताइस',
            28 => 'अट्ठाइस',
            29 => 'उनन्तीस',
            30 => 'तीस',
            31 => 'एकतीस',
            32 => 'बत्तीस',
            33 => 'तेत्तीस',
            34 => 'चौंतीस',
            35 => 'पैंतीस',
            36 => 'छत्तीस',
            37 => 'सैंतीस',
            38 => 'अड्तीस',
            39 => 'उनन्चालीस',
            40 => 'चालीस',
            41 => 'एकचालीस',
            42 => 'बयालीस',
            43 => 'त्रियालीस',
            44 => 'चवालिस',
            45 => 'पैंतालीस',
            46 => 'छयालीस',
            47 => 'सरचालीस',
            48 => 'अडचालीस',
            49 => 'उनन्चास',
            50 => 'पचास',
            51 => 'एकाउन्न',
            52 => 'बाउन्न',
            53 => 'त्रिपन्न',
            54 => 'चवन्न',
            55 => 'पचपन्न',
            56 => 'छपन्न',
            57 => 'सन्ताउन्न',
            58 => 'अन्ठाउन्न',
            59 => 'उनन्साठ्ठी',
            60 => 'साठी',
            61 => 'एक्साठ्ठी',
            62 => 'बसाठ्ठी',
            63 => 'त्रिसाठ्ठी',
            64 => 'चौंसठ्ठी',
            65 => 'पैंसठ्ठी',
            66 => 'छैसठ्ठी',
            67 => 'सड्सठ्ठी',
            68 => 'अड्सठ्ठी',
            69 => 'उनन्सत्तरी',
            70 => 'सत्तरी',
            71 => 'एहत्तर',
            72 => 'बहत्तर',
            73 => 'त्रिहत्तर',
            74 => 'चौहत्तर',
            75 => 'पचहत्तर',
            76 => 'छहत्तर',
            77 => 'सत्हत्तर',
            78 => 'अठहत्तर',
            79 => 'उनासी',
            80 => 'अस्सी',
            81 => 'एकासी',
            82 => 'बयासी',
            83 => 'त्रियासी',
            84 => 'चौरासी',
            85 => 'पचासी',
            86 => 'छयासी',
            87 => 'सतासी',
            88 => 'अठासी',
            89 => 'उनान्नब्बे',
            90 => 'नब्बे',
            91 => 'एकान्नब्बे',
            92 => 'बयानब्बे',
            93 => 'त्रियान्नब्बे',
            94 => 'चौरान्नब्बे',
            95 => 'पन्चान्नब्बे',
            96 => 'छयान्नब्बे',
            97 => 'सन्तान्नब्बे',
            98 => 'अन्ठान्नब्बे',
            99 => 'उनान्सय'
        ];

        // This is a simplified version. A full converter is complex.
        // For amounts entered in the rates, they are likely integers or decimals.
        // Let's implement a basic structure for likely ranges (thousands, lakhs).

        // Given the complexity of full number to word conversation in Nepali from scratch without a library,
        // I will implement a robust enough version for typical prices (up to crores).

        $words = [];

        $crore = floor($integerPart / 10000000);
        $integerPart %= 10000000;

        $lakh = floor($integerPart / 100000);
        $integerPart %= 100000;

        $thousand = floor($integerPart / 1000);
        $integerPart %= 1000;

        $hundred = floor($integerPart / 100);
        $remainder = $integerPart % 100;

        if ($crore > 0) {
            $words[] = self::convertTwoDigits($crore, $digits) . ' करोड';
        }

        if ($lakh > 0) {
            $words[] = self::convertTwoDigits($lakh, $digits) . ' लाख';
        }

        if ($thousand > 0) {
            $words[] = self::convertTwoDigits($thousand, $digits) . ' हजार';
        }

        if ($hundred > 0) {
            $words[] = $digits[$hundred] . ' सय';
        }

        if ($remainder > 0) {
            $words[] = self::convertTwoDigits($remainder, $digits);
        }

        return implode(' ', $words) . ' रुपैयाँ';
    }

    private static function convertTwoDigits($number, $digits)
    {
        return $digits[(int) $number];
    }
}
