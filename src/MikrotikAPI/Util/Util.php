<?php

namespace MikrotikAPI\Util;

class Util {

    public static function contains($mixed, $needle) {
        switch (gettype($mixed)) {
            case "array":
                return \in_array($needle, $mixed) ? \TRUE : \FALSE;
            case "string":
                $pos = strpos($mixed, $needle);
                if (!($pos === FALSE)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            default:
                return \FALSE;
        }
    }

}
