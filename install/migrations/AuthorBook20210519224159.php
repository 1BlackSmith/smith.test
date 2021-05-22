<?php

namespace Sprint\Migration;


class AuthorBook20210519224159 extends Version
{
    protected $description = "Добавление связующей таблицы авторов и книг";

    protected $moduleVersion = "3.28.7";

    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Sql()->query(
            "CREATE TABLE b_smith_test_author_book
            (
                AUTHOR_ID int not null,
                BOOK_ID int not null,
                UNIQUE ix_author_book (AUTHOR_ID, BOOK_ID)
            );"
        );
    }

    public function down()
    {
        $helper = $this->getHelperManager();
        $helper->Sql()->query(
            "DROP TABLE IF EXISTS b_smith_test_author_book;"
        );
    }
}