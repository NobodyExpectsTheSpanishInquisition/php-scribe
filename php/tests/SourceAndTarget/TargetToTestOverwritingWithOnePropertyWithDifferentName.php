<?php

declare(strict_types=1);

namespace Tests\SourceAndTarget;

final class TargetToTestOverwritingWithOnePropertyWithDifferentName
{
    public function __construct(private string $stringValue, private int $differentIntValue)
    {
    }

    public function getStringValue(): string
    {
        return $this->stringValue;
    }

    public function getDifferentIntValue(): int
    {
        return $this->differentIntValue;
    }
}
