<?php

namespace App\Services;

class FuzzificationHumServices {
    public function muLowHum($humidity) {
        $a = 75;
        $b = 82.5;

        if ($humidity <= $a) {
            return 1;
        } elseif ($humidity > $a && $humidity < $b) {
            return ($b - $humidity) / ($b - $a);
        } else {
            return 0;
        }
    }

    public function muMediumHum($humidity) {
        $a = 75;
        $b = 82.5;
        $c = 90;

        if ($humidity <= $a || $humidity >= $c) {
            return 0;
        } elseif ($humidity > $a && $humidity < $b) {
            return ($humidity - $a) / ($b - $a);
        } elseif ($humidity >= $b && $humidity < $c) {
            return ($c - $humidity) / ($c - $b);
        } else {
            return 0;
        }
    }

    public function muHighHum($humidity) {
        $b = 82.5;
        $c = 90;

        if ($humidity <= $b) {
            return 0;
        } elseif ($humidity > $b && $humidity < $c) {
            return ($humidity - $b) / ($c - $b);
        } else {
            return 1;
        }
    }
}
