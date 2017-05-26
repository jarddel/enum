<?php
namespace Robusto\Enum\Tests;

use Doctrine\DBAL\Types\Type;

class EnumTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        Type::addType('day_week', DayWeekEnum::class);
    }

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
