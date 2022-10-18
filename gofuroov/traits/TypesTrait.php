<?php

namespace app\gofuroov\traits;

trait TypesTrait
{
    public static function getTypeList(): array
    {
        return [];
    }

    public function getTypeName(): string
    {
        if (property_exists($this, 'type')) {
            return static::getTypeList()[$this->type] ?? '';
        }
        return '';
    }
}