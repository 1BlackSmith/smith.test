<?php

namespace Sprint\Migration;


class Book20210519224129 extends Version
{
    protected $description = "Добавление таблицы книг";

    protected $moduleVersion = "3.28.7";

    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Sql()->query(
            "CREATE TABLE b_smith_test_book
            (
                ID int not null auto_increment,
                PUBLISHING_ID int not null,
                TITLE varchar(50) not null,
                YEAR int(4) not null,
                COPIES_CNT int not null default 0,
                PRIMARY KEY (ID),
                INDEX ix_book_title (TITLE),
                INDEX ix_book_publishing (PUBLISHING_ID)
            );"
        );
    }

    public function down()
    {
        $helper = $this->getHelperManager();
        $helper->Sql()->query(
            "DROP TABLE IF EXISTS b_smith_test_book;"
        );
    }
}