<?php

namespace Core\Util;

class Binder
{
    public function bindData(array $array, $object): void
    {
        foreach ($array as $name => $value) {
            $methodName = 'set' . implode('', array_map('ucfirst', explode("_", $name)));

            if(method_exists($object, $methodName)) {
                $object->$methodName($value);
            }
        }
    }
}