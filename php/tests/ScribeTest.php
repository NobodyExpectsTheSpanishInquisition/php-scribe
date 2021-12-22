<?php

declare(strict_types=1);

namespace Tests;

use App\Scribe;
use PHPUnit\Framework\TestCase;
use Tests\SourceAndTarget\SourceToTestOverwritingWithOnePropertyWithDifferentName;
use Tests\SourceAndTarget\SourceWithStringAndIntProperties;
use Tests\SourceAndTarget\TargetToTestOverwritingWithOnePropertyWithDifferentName;
use Tests\SourceAndTarget\TargetWithStringAndIntProperties;

final class ScribeTest extends TestCase
{
    private Scribe $scribe;

    public function test_ShouldOverwriteAllProperties_WhenAllPropertiesHaveTheSameNameAndType(): void
    {
        $sourceStringValue = 'value';
        $sourceIntValue = 0;
        $targetStringValue = 'overwrittenValue';
        $targetIntValue = 1;

        $source = new SourceWithStringAndIntProperties($sourceStringValue, $sourceIntValue);
        $target = new TargetWithStringAndIntProperties($targetStringValue, $targetIntValue);

        $this->scribe->overwrite($source, $target);

        self::assertNotEquals($targetStringValue, $target->getStringValue());
        self::assertEquals($source->getStringValue(), $target->getStringValue());
        self::assertEquals($source->getIntValue(), $target->getIntValue());
    }

    public function test_ShouldOverwriteOneProperty_WhenOnePropertyHasTheSameNameAndType(): void
    {
        $sourceStringValue = 'value';
        $sourceIntValue = 0;
        $targetStringValue = 'overwrittenValue';
        $targetIntValue = 1;

        $source = new SourceToTestOverwritingWithOnePropertyWithDifferentName($sourceStringValue, $sourceIntValue);
        $target = new TargetToTestOverwritingWithOnePropertyWithDifferentName($targetStringValue, $targetIntValue);

        $this->scribe->overwrite($source, $target);

        self::assertNotEquals($targetStringValue, $target->getStringValue());
        self::assertNotEquals($source->getIntValue(), $target->getDifferentIntValue());
        self::assertEquals($source->getStringValue(), $target->getStringValue());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->scribe = new Scribe();
    }
}
