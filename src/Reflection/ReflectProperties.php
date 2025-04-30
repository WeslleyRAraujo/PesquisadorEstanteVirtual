<?php

namespace WeslleyRAraujo\EstanteVirtual\Reflection;

use WeslleyRAraujo\EstanteVirtual\Reflection\Reflect;

class ReflectProperties
{
    public static function reflect(object $classFrom, object $classTo, ?string $objectTypeValidator = null): void
    {
        $ReflectionClass = new \ReflectionClass($classFrom::class);
        foreach ($ReflectionClass->getProperties() as $prop) {
            $ReflectionProperty = new \ReflectionProperty($classFrom::class, $prop->getName());
            $reflect = self::hasObject($ReflectionProperty->getAttributes(), Reflect::class);
            if ($reflect) {
                $canSet = (
                    $objectTypeValidator === null 
                    || self::hasObject($ReflectionProperty->getAttributes(), $objectTypeValidator)
                );
                if($canSet) {
                    call_user_func(
                        [$classTo, 'set' . ucfirst($prop->getName())],
                        $prop->getValue($classFrom)
                    );
                }
            }
        }
    }

    private static function hasObject(array $attributes, ?string $objectTypeValidator): bool
    {
        if ($objectTypeValidator === null) {
            return false;
        }
        return count(
            array_filter($attributes, fn ($attr) => $attr->getName() == $objectTypeValidator)
        ) > 0;
    }
}
