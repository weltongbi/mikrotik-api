<?php

/*
 * Este codigo foi desenvolvidor por welton castro.
 * Email: weltongbi@gmail.com.
 */

namespace MikrotikAPI\Util;

/**
 * Description of Debug
 *
 * @author welton
 */
class Debug {

    /**
     * 
     * @param mixed $cmd
     */
    public function cmd($cmd) {
        if (defined('MK_DEBUG') && constant('MK_DEBUG') == true && !empty($cmd)) {
            \print_r($cmd . PHP_EOL);
        }
    }

    public function error($text) {
        \print_r($text . PHP_EOL);
    }

}
