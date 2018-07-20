<?php

namespace MikrotikAPI\Util;

/**
 * Description of ResultUtil
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class ResultUtil {

    private $list;
    private $listAttr;
    private $itList;

    public function __construct() {
        $this->list = new \ArrayObject();
        $this->listAttr = new \ArrayObject();
    }

    public function getResult($mixed = '') {
        $value = NULL;
        if (gettype($mixed) == "string") {
            $it = $this->listAttr->getIterator();
            while ($it->valid()) {
                if ($it->current()->getName() == $mixed) {
                    $value = $it->current()->getValue();
                }
                $it->next();
            }
        } else if (gettype($mixed) == "integer") {
            $it = $this->listAttr->getIterator();
            $value = $it->offsetGet($mixed)->getValue();
        } else {
            $value = NULL;
        }
        return $value;
    }

    public function getResultArray() {
        $ar = new \ArrayObject();

        while ($this->next()) {
            $it = $this->listAttr->getIterator();
            while ($it->valid()) {
                $tmpAr[$it->current()->getName()] = $it->current()->getValue();
                $it->next();
            }
            $ar->append($tmpAr);
        }

        return $ar->getArrayCopy();
    }

    public function getResultJson() {
        return json_encode($this->getResultArray());
    }

    public function getResultXml() {
        $xml_data = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');

        $this->prepareXml($this->getResultArray(), $xml_data);

        return $xml_data->asXML();
    }

    private function prepareXml($data, &$xml_data) {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item' . $key; //dealing with <0/>..<n/> issues
            }
            if (is_array($value)) {
                $subnode = $xml_data->addChild($key);
                $this->prepareXml($value, $subnode);
            } else {
                $xml_data->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }

    private function fireOnChange() {
        $this->itList = $this->list->getIterator();
        $this->listAttr = $this->itList->current();
    }

    public function hasNext() {
        return $this->itList->valid();
    }

    public function next() {
        if(!$this->size()){
            return FALSE;
        }
        if ($this->hasNext()) {
            $this->listAttr = $this->itList->current();
            $this->itList->next();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function size() {
        return $this->list->count();
    }

    public function add(\ArrayObject $object) {
        $this->list->append($object);
        $this->fireOnChange();
    }

}
