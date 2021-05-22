<?php

namespace Smith\Test\Internals;

use \Bitrix\Main\ORM\Data\DataManager;
use \Bitrix\Main\ORM\Fields;

class AuthorTable extends DataManager
{
    public static function getTableName()
    {
        return "b_smith_test_author";
    }

    public static function getUFId()
    {
        return "B_SMITH_TEST_AUTHOR";
    }

    public static function getMap()
    {
        return array(
            new Fields\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            (new Fields\Relations\ManyToMany(
                'BOOKS',
                BookTable::class
            ))
                ->configureTableName('b_smith_test_author_book')
                ->configureJoinType('inner'),
            new Fields\StringField('FIRST_NAME', array(
                'required' => true,
                'size' => 50
            )),
            new Fields\StringField('LAST_NAME', array(
                'size' => 50,
                'default' => ''
            )),
            new Fields\StringField('SECOND_NAME', array(
                'size' => 50,
                'default' => ''
            )),
            new Fields\StringField('CITY', array(
                'size' => 50,
                'default' => ''
            )),
        );
    }
}