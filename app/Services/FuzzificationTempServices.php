<?php

namespace App\Services;

class FuzzificationTempServices {
    public function muLowTemp($temperature) {
        $a = 25;
        $b = 28;

        if ($temperature <= $a) {
            return 1;
        } elseif ($temperature > $a && $temperature < $b) {
            return ($b - $temperature) / ($b - $a);
        } else {
            return 0;
        }
    }

    public function muMediumTemp($temperature) {
        $a = 25;
        $b = 28;
        $c = 31;

        if ($temperature <= $a || $temperature >= $c) {
            return 0;
        } elseif ($temperature > $a && $temperature < $b) {
            return ($temperature - $a) / ($b - $a);
        } elseif ($temperature >= $b && $temperature < $c) {
            return ($c - $temperature) / ($c - $b);
        } else {
            return 0;
        }
    }

    public function muHighTemp($temperature) {
        $b = 28;
        $c = 31;

        if ($temperature <= $b) {
            return 0;
        } elseif ($temperature > $b && $temperature < $c) {
            return ($temperature - $b) / ($c - $b);
        } else {
            return 1;
        }
    }
}
