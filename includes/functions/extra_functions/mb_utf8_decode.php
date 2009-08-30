<?php
function mb_utf8_decode ($str, $enc) {

        $enc = strtoupper($enc);

        if ($enc == "UTF-8") return $str;

        if ($enc == "ISO-8859-1") return utf8_decode($str);

        if (function_exists("mb_convert_encoding"))
                return mb_convert_encoding($str, $enc, "UTF-8");

        if (function_exists("iconv")) return iconv("UTF-8", $enc, $str);

        return FALSE;
}
?>
