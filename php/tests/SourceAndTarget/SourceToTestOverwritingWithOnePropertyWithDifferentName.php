<?php

declare(strict_types=1);

namespace Tests\SourceAndTarget;

final class SourceToTestOverwritingWithOnePropertyWithDifferentName
{
    public function __construct(private string $stringValue, private int $intValue)
    {
    }

    public function getIntValue(): int
    {
        return $this->intValue;
    }

    public function getStringValue(): string
    {
        return $this->stringValue;
    }
}
