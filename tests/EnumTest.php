<?php
namespace Robusto\Enum\Tests;

class EnumTest extends \PHPUnit_Framework_TestCase
{
    public function testIdentity()
    {
        $this->assertEquals(1, LanguageEnum::JAVA);
    }

    public function testDescription()
    {
        $this->assertEquals('Javascript', (string) LanguageEnum::JS());
    }

    public function testInstance()
    {
        $this->assertInstanceOf(LanguageEnum::class, LanguageEnum::PHP());
    }

    public function testValue()
    {
        $this->assertEquals(3, LanguageEnum::PYTHON()->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidValue()
    {
        LanguageEnum::DELPHI();
    }
}
