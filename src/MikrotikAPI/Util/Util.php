<?php

namespace MikrotikAPI\Util;

class Util {

    public static function contains($mixed, $needle) {
        switch (\gettype($mixed)) {
            case "array":
                return \in_array($needle, $mixed) ? \TRUE : \FALSE;
            case "string":
                return \strpos($mixed, $needle) ? \FALSE : \TRUE;
            default:
                return \FALSE;
        }
    }

}
