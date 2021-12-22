<?php

declare(strict_types=1);

namespace Tests\SourceAndTarget;

final class SourceWithStringAndIntProperties
{
    public function __construct(private string $stringValue, private int $intValue)
    {
    }

    public function getStringValue(): string
    {
        return $this->stringValue;
    }

    public function getIntValue(): int
    {
        return $this->intValue;
    }
}
