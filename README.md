Robusto Enum!
=============
A robust and simple way to define enumerative types in php.

<table width="890"><tr>
    <td width="116" align="center"><b>Scrutinizer</b></td>
    <td width="122" align="center"><b>Latest</b></td>
    <td width="108" align="center"><b>PHP</b></td>
    <td width="150" align="center"><b>Usage</b></td>
    <td width="142" align="center"><b>Development</b></td>
    <td width="142" align="center"><b>Code Quality</b></td>
    <td width="110" align="center"><b>License</b></td>
</tr>
<tr>
    <td valign="top" width="116" align="center">
        <a href="https://scrutinizer-ci.com/g/jarddel/enum/build-status/master">
        <img src="https://scrutinizer-ci.com/g/jarddel/enum/badges/build.png?b=master"></a></td>
    <td valign="top" width="122" align="center">
        <a href="https://packagist.org/packages/robusto/enum">
        <img src="https://poser.pugx.org/robusto/enum/v/stable"></a></td>
    <td valign="top" width="108" align="center">
        <a href="https://php.net/">
        <img src="https://img.shields.io/badge/PHP-%3E%3D%207.0-8892BF.svg"></a></td>
    <td valign="top" width="150" align="center">
        <a href="https://packagist.org/packages/robusto/enum">
        <img src="https://poser.pugx.org/robusto/enum/downloads"></a></td>
    <td valign="top" width="142" align="center">
        <a href="https://packagist.org/packages/robusto/enum">
        <img src="https://poser.pugx.org/robusto/enum/v/unstable"></a></td>
    <td valign="top" width="142" align="center">
        <a href="https://scrutinizer-ci.com/g/jarddel/enum/?branch=master">
        <img src="https://scrutinizer-ci.com/g/jarddel/enum/badges/quality-score.png?b=master"></a></td>
    <td valign="top" width="110" align="center">
        <a href="https://packagist.org/packages/robusto/enum">
        <img src="https://poser.pugx.org/robusto/enum/license"></a></td>
</tr></table>

##### Requirements:
- PHP 7.0+
- [DBAL](https://github.com/doctrine/dbal) ***(only for use EnumType)***

<br />
Simple Example:
```php
class DayWeekEnum extends Enum
{
	const SUNDAY    = 1,
	      MONDAY    = 2,
	      TUESDAY   = 3,
	      WEDNESDAY = 4,
	      THURSDAY  = 5,
	      FRIDAY    = 6,
	      SATURDAY  = 7
    ;
}
```

Example using descriptions for the enumerative values:
```php
class LanguageEnum extends Enum
{
    const JAVA   = 1,
	      PHP    = 2,
	      PYTHON = 3,
	      RUBY   = 4,
	      JS     = 5
    ;

    protected static $descriptions = [
    	'Java',
    	'PHP',
    	'Python',
    	'Ruby',
    	'Javascript'
    ];
}
```

Possibility of using enum with php typehint, restricting their value according to their respective values of type:
```php
public function setLanguage(LanguageEnum $language) 
{
    $this->language = $language;
}

$language = LanguageEnum::JAVA();

$foo->setLanguage($language);
```


Printing description of its enum value:
```php
public function getLanguage(): LanguageEnum 
{
    return $this->language;
}


$foo->setLanguage(LanguageEnum::JS());

echo $foo->getLanguage(); // Javascript

echo LanguageEnum::JS;    // 5

echo get_class($foo->getLanguage()); // LanguageEnum
```
=============
#### Can be used along with [DBAL](https://github.com/doctrine/dbal) (Database Abstraction Layer). To work on the concept of types:
=============
```php
class DayWeekEnum extends EnumType
{
	const SUNDAY    = 1,
	      MONDAY    = 2,
	      TUESDAY   = 3,
	      WEDNESDAY = 4,
	      THURSDAY  = 5,
	      FRIDAY    = 6,
	      SATURDAY  = 7
    ;
}
```

Adding types to configurations:

```yml
doctrine:
   dbal:
       types:
           day_week: DayweekEnum
```
Using types with annotation:

```php

/** @Entity */
class Foo
{
    /** @Column(type="integer") */
    private $id;

    /** @Column(type="day_week", name="day_week") */
    private $day;
}
```

Using types with XML:
```xml
<entity name="Foo" table="foo">
    <id name="id" column="id" type="integer" />
    <field name="day" column="day_week" type="day_week" />
</entity>
```

