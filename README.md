Robusto Enum!
=====
A robust and simple way to define enumerative types in php.
Robusto Enum for PHP 7.0+

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

    protected $descriptions = [
    	'Java',
    	'PHP',
    	'Python',
    	'Ruby',
    	'Javascript'
    ];
}
```

Possibility of using enum with php typehint, restricting their value according to their respective type:
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
