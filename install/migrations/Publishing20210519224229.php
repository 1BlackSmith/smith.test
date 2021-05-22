<?php

namespace Sprint\Migration;


class Publishing20210519224229 extends Version
{
    protected $description = "Добавление таблицы изданий";

    protected $moduleVersion = "3.28.7";

    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Sql()->query(
            "CREATE TABLE b_smith_test_publishing
            (
                ID int not null auto_increment,
                TITLE varchar(50) not null,
                CITY varchar(50) default '',
                AUTHOR_PROFIT float not null default 0,
                PRIMARY KEY (ID),
                INDEX ix_publishing_title (TITLE)
            );"
        );
    }

    public function down()
    {
        $helper = $this->getHelperManager();
        $helper->Sql()->query(
            "DROP TABLE IF EXISTS b_smith_test_publishing;"
        );
    }
}