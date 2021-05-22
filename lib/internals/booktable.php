<?php

namespace Smith\Test\Internals;

use \Bitrix\Main\ORM\Data\DataManager;
use \Bitrix\Main\ORM\Fields;
use \Bitrix\Main\ORM\Query\Join;

class BookTable extends DataManager
{
    public static function getTableName()
    {
        return "b_smith_test_book";
    }

    public static function getUFId()
    {
        return "B_SMITH_TEST_BOOK";
    }

    public static function getMap()
    {
        return array(
            new Fields\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            (new Fields\Relations\ManyToMany(
                'AUTHORS',
                AuthorTable::class
            ))
                ->configureTableName('b_smith_test_author_book')
                ->configureJoinType('inner'),
            new Fields\IntegerField('PUBLISHING_ID'),
            (new Fields\Relations\Reference(
                'PUBLISHING',
                PublishingTable::class,
                Join::on('this.PUBLISHING_ID', 'ref.ID')
            ))
                ->configureJoinType('inner'),
            new Fields\StringField('TITLE', array(
                'required' => true,
                'size' => 50
            )),
            new Fields\IntegerField('YEAR', array(
                'required' => true,
                'size' => 4,
            )),
            new Fields\IntegerField('COPIES_CNT', array(
                'default' => 0
            )),
        );
    }
}