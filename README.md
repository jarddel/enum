Robusto Enum!
=============
A robust and simple way to define enumerative types in php.

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
           dayweek: DayweekEnum
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
    <field name="day_week" column="day_week" type="dayweek" />
</entity>
```

