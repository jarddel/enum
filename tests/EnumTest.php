<?php
namespace Robusto\Enum\Tests;

class EnumTest extends \PHPUnit_Framework_TestCase
{

    public function testIdentity()
    {
        $this->assertEquals(1, DayWeekEnum::SUNDAY);
    }

    public function testDescription()
    {
        $this->assertEquals('Monday', (string) DayWeekEnum::MONDAY());
    }

    public function testMatchDescriptions()
    {
        $this->assertSameSize(DayWeekEnum::getValues(), DayWeekEnum::getDescriptions());
    }

    public function testInstance()
    {
        $this->assertInstanceOf(DayWeekEnum::class, DayWeekEnum::TUESDAY());
    }

    public function testValue()
    {
        $this->assertEquals(4, DayWeekEnum::WEDNESDAY()->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidValue()
    {
        DayWeekEnum::XDAY();
    }
}
