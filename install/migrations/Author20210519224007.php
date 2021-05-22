<?php

namespace Sprint\Migration;


class Author20210519224007 extends Version
{
    protected $description = "Добавление таблицы авторов";

    protected $moduleVersion = "3.28.7";

    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Sql()->query(
            "CREATE TABLE b_smith_test_author
            (
                ID int not null auto_increment,
                FIRST_NAME varchar(50) not null,
                LAST_NAME varchar(50) default '',
                SECOND_NAME varchar(50) default '',
                CITY varchar(50) default '',
                PRIMARY KEY (ID),
                INDEX ix_author_last_name (LAST_NAME)
            );"
        );
    }

    public function down()
    {
        $helper = $this->getHelperManager();
        $helper->Sql()->query(
            "DROP TABLE IF EXISTS b_smith_test_author;"
        );
    }
}