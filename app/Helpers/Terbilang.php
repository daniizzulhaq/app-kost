<?php

namespace App\Helpers;

class Terbilang
{
    protected static $angka = [
        '', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima',
        'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh',
        'Sebelas'
    ];

    public static function make($number)
    {
        $number = (int) $number;

        if ($number < 0) {
            return 'Minus ' . self::make(abs($number));
        }

        if ($number < 12) {
            return trim(self::$angka[$number]);
        } elseif ($number < 20) {
            return trim(self::make($number - 10) . ' Belas');
        } elseif ($number < 100) {
            return trim(self::make(intval($number / 10)) . ' Puluh ' . self::make($number % 10));
        } elseif ($number < 200) {
            return trim('Seratus ' . self::make($number - 100));
        } elseif ($number < 1000) {
            return trim(self::make(intval($number / 100)) . ' Ratus ' . self::make($number % 100));
        } elseif ($number < 2000) {
            return trim('Seribu ' . self::make($number - 1000));
        } elseif ($number < 1000000) {
            return trim(self::make(intval($number / 1000)) . ' Ribu ' . self::make($number % 1000));
        } elseif ($number < 1000000000) {
            return trim(self::make(intval($number / 1000000)) . ' Juta ' . self::make($number % 1000000));
        } elseif ($number < 1000000000000) {
            return trim(self::make(intval($number / 1000000000)) . ' Milyar ' . self::make($number % 1000000000));
        } elseif ($number < 1000000000000000) {
            return trim(self::make(intval($number / 1000000000000)) . ' Triliun ' . self::make($number % 1000000000000));
        }

        return trim($number);
    }
}