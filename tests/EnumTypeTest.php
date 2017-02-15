<?php
namespace Robusto\Enum\Tests;

use Doctrine\DBAL\Types\Type;

class EnumTypeTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        Type::addType('language', LanguageTypeEnum::class);
    }

    public function testIdentity()
    {
        $this->assertEquals(1, LanguageTypeEnum::JAVA);
    }

    public function testDescription()
    {
        $this->assertEquals('Javascript', (string) LanguageTypeEnum::JS());
    }

    public function testMatchDescriptions()
    {
        $this->assertSameSize(LanguageTypeEnum::getValues(), LanguageTypeEnum::getDescriptions());
    }

    public function testInstance()
    {
        $this->assertInstanceOf(LanguageTypeEnum::class, LanguageTypeEnum::PHP());
    }

    public function testValue()
    {
        $this->assertEquals(3, LanguageTypeEnum::PYTHON()->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidValue()
    {
        LanguageTypeEnum::DELPHI();
    }
}
