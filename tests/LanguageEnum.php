<?php
namespace Robusto\Enum\Tests;

use Robusto\Enum\EnumType;

class LanguageEnum extends EnumType
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