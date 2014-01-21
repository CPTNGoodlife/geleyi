<?php

/*
 * SplitTest 
 * Helper class for split testing functionality
 */

class SplitTest {

    /**
     * @assert(3000, 165, 2000, 134) == -17.91
     * @assert(1995, 134, 2000, 134) == 0.29
     * @assert(3000, 165, 2000, 134) == -17.91
     * @assert(1995, 134, 2000, 134) == 0.29
     * @assert(1996, 124, 2000, 134) == -19.7
     * @assert(251, 21, 221, 10) == 85
     * @assert(300, 21, 221, 10) == 54.87
     * @assert(5598, 13, 6123, 10) == 43.75
     * @assert(6003, 15, 6123, 10) == 56.25
     * @assert(5598, 3, 6123, 10) == -62.81
     */
    function percentageImproovement($impressions, $conversions, $c_impressions, $c_conversions) {
        
        $conversionsRate = $this->conversionRate($impressions, $conversions);
        $c_conversionsRate = $this->conversionRate($c_impressions, $c_conversions);
        
        if ($c_conversionsRate == 0 || $conversionsRate == 0) {
            return 0;
        } 
        

        $pi = ($conversionsRate / $c_conversionsRate * 100);

        if ($conversionsRate < $c_conversionsRate) {
            $pi = - (100 - $pi );
        } else {
            $pi = $pi - 100;
        }
        
        return $pi;
    }

    /**
     * @assert(3000, 165, 2000, 134) == 4.26
     * @assert(1995, 134, 2000, 134) == 50.85
     * @assert(3000, 165, 2000, 134) == 4.26
     * @assert(1995, 134, 2000, 134) == 50.85
     * @assert(1996, 124, 2000, 134) == 26.53
     * @assert(251, 21, 221, 10) == 95.70
     * @assert(300, 21, 221, 10) == 88.85
     * @assert(5598, 13, 6123, 10) == 79.83
     * @assert(6003, 15, 6123, 10) == 85.28
     * @assert(5598, 3, 6123, 10) == 3.41
     */
    function getConfidenceLevel($impressions, $conversions, $c_impressions, $c_conversions) {
        $conversionsRate = $this->conversionRate($impressions, $conversions);
        $c_conversionsRate = $this->conversionRate($c_impressions, $c_conversions);
        
        if ($c_conversionsRate == 0 || $conversionsRate == 0) {
            return 0;
        } 

        $zscore = $this->zscore($impressions, $conversionsRate, $c_impressions, $c_conversionsRate);

        $confidence = $this->cumnormdist($zscore) * 100;

        return number_format($confidence, 2);
    }

    function conversionRate($impressions, $conversions) {
        $impressions = (int) $impressions;
        $conversions = (int) $conversions;
        
        if ($impressions == 0)
            return 0;

        $conversionRate = ($conversions / $impressions);

        return $conversionRate;
    }

    function zscore($impressions, $conversionsRate, $c_impressions, $c_conversionsRate) {
        $vsdeviation = ($impressions == 0) ? 0 : ($conversionsRate * (1 - $conversionsRate) / $impressions);
        $csdeviation = ($c_impressions == 0) ? 0 : ($c_conversionsRate * (1 - $c_conversionsRate) / $c_impressions);
        $z = $conversionsRate - $c_conversionsRate;
        $s = $vsdeviation + $csdeviation;
        if ($s == 0) 
            return 0;
        return $z / sqrt($s);
    }

    function cumnormdist($x) {
        $b1 = 0.319381530;
        $b2 = -0.356563782;
        $b3 = 1.781477937;
        $b4 = -1.821255978;
        $b5 = 1.330274429;
        $p = 0.2316419;
        $c = 0.39894228;

        if ($x >= 0.0) {
            $t = 1.0 / ( 1.0 + $p * $x );
            return (1.0 - $c * exp(-$x * $x / 2.0) * $t *
                    ( $t * ( $t * ( $t * ( $t * $b5 + $b4 ) + $b3 ) + $b2 ) + $b1 ));
        } else {
            $t = 1.0 / ( 1.0 - $p * $x );
            return ( $c * exp(-$x * $x / 2.0) * $t *
                    ( $t * ( $t * ( $t * ( $t * $b5 + $b4 ) + $b3 ) + $b2 ) + $b1 ));
        }
    }

}

?>
