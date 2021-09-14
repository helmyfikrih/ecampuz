<?php
function divFunc($num, $divBy) {
    if($num >= $divBy) {
        while($num >= $divBy) {
            $hasil[] = ($num-$divBy);
            $num = $num - $divBy;
        }
        return count($hasil);
    } else {
        return "invalid input";
    }
}

echo divFunc(7,2);
