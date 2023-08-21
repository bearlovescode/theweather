<?php
    namespace Bearlovescode\Theweather\Helpers;


    class Temperature
    {
        public static function C2F (float $c = 0.0) : float
        {
            return ($c * 1.8) + 32;
        }

        public function F2C (float $f = 32.0) : float
        {
            return ($f - 32) / 1.8;
        }
    }