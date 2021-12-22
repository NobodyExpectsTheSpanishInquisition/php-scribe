<?php

declare(strict_types=1);

namespace App;

use ReflectionClass;
use ReflectionProperty;

final class Scribe
{
    public function overwrite(object $source, object $target): void
    {
        $reflectedSource = new ReflectionClass($source);
        $reflectedTarget = new ReflectionClass($target);

        $reflectedSourceProperties = $reflectedSource->getProperties();
        $reflectedTargetProperties = $reflectedTarget->getProperties();

        $this->makeAllPropertiesPublic($reflectedSourceProperties);
        $this->makeAllPropertiesPublic($reflectedTargetProperties);

        $reflectedSourcePropertiesMap = $this->mapPropertiesIntoMap($reflectedSourceProperties);
        $reflectedTargetPropertiesMap = $this->mapPropertiesIntoMap($reflectedTargetProperties);

        foreach ($reflectedSourcePropertiesMap as $reflectedSourceProperty) {
            if (array_key_exists($reflectedSourceProperty->getName(), $reflectedTargetPropertiesMap)) {
                $reflectedTargetPropertiesMap[$reflectedSourceProperty->getName()]->setValue(
                    $target,
                    $reflectedSourceProperty->getValue($source)
                );
            }
        }
    }

    /**
     * @param ReflectionProperty[] $reflectedProperties
     */
    private function makeAllPropertiesPublic(array $reflectedProperties): void
    {
        foreach ($reflectedProperties as $reflectedProperty) {
            $reflectedProperty->setAccessible(true);
        }
    }

    /**
     * @param ReflectionProperty[] $reflectedProperties
     * @return array<string, ReflectionProperty>
     */
    private function mapPropertiesIntoMap(array $reflectedProperties): array
    {
        $map = [];

        foreach ($reflectedProperties as $reflectedProperty) {
            $map[$reflectedProperty->getName()] = $reflectedProperty;
        }

        return $map;
    }

    /**
     * @param array<string, string> $reflectedSourcePropertiesMap
     * @param array<string, string> $reflectedTargetPropertiesMap
     * @return array<string, string>
     */
    private function overwritePropertiesInMap(
        array $reflectedSourcePropertiesMap,
        array $reflectedTargetPropertiesMap
    ): array {
        foreach ($reflectedSourcePropertiesMap as $key => $value) {
            $reflectedTargetPropertiesMap[$key] = $value;
        }

        return $reflectedTargetPropertiesMap;
    }
}
