<?php

namespace Smith\Test\Internals;

use \Bitrix\Main\ORM\Data\DataManager;
use \Bitrix\Main\ORM\Fields;
use \Bitrix\Main\ORM\Query\Join;

class PublishingTable extends DataManager
{
    public static function getTableName()
    {
        return "b_smith_test_publishing";
    }

    public static function getUFId()
    {
        return "B_SMITH_TEST_PUBLISHING";
    }

    public static function getMap()
    {
        return array(
            new Fields\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            (new Fields\Relations\Reference(
                'BOOK',
                BookTable::class,
                Join::on('this.ID', 'ref.ID')
            ))
                ->configureJoinType('inner'),
            new Fields\StringField('TITLE', array(
                'required' => true,
                'size' => 50
            )),
            new Fields\StringField('CITY', array(
                'size' => 50,
                'default' => ''
            )),
            new Fields\FloatField('AUTHOR_PROFIT', array(
                'required' => true,
                'default' => 0
            )),
        );
    }
}