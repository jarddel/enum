<?php
namespace Robusto\Enum\Tests;

use Robusto\Enum\EnumFactory;

class EnumFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateEnumByConstant()
    {
       $languageEnum = EnumFactory::createEnumByConstant('JAVA', LanguageEnum::class);

       $this->assertInstanceOf(LanguageEnum::class, $languageEnum);
       $this->assertEquals(1, $languageEnum->getValue());
       $this->assertEquals('Java', (string) $languageEnum);
    }
}
