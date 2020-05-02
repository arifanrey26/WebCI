<?php

class Lingkaran
{
    
    function keliling($jari)
    {
        $keliling = 2 * 3.14 * $jari;
        echo "Keliling lingkaran dengan jari-jari : ".$jari." , adalah = ".$keliling;
    }

    function luas($jari)
    {
        $luas = 3.14 * $jari * $jari;
        echo "Luas lingkaran dengan jari-jari : ".$jari." , adalah = ".$luas;
    }
}
