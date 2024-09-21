<?php
namespace Utils;
trait StringConverter{
    public function camelise(string $value) {
        return lcfirst(str_replace('_', '', ucwords($value, '_')));
    }
}