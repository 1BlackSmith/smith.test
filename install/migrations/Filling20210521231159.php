<?php

namespace Sprint\Migration;


class Filling20210521231159 extends Version
{
    protected $description = "Заполнение таблиц тестовыми данными";

    protected $moduleVersion = "3.28.7";

    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Sql()->transaction(function() use ($helper) {
            $helper->Sql()->query(
                "INSERT INTO b_smith_test_author (FIRST_NAME, LAST_NAME, SECOND_NAME, CITY)
            VALUES ('Михаил', 'Булгаков', 'Афанасьевич', 'Киев'),
                   ('Николай', 'Гоголь', 'Васильевич', 'Москва'),
                   ('Илья', 'Ильф', 'Арнольдович', 'Москва'),
                   ('Евгений', 'Петров', 'Петрович', 'Москва');"
            );
            $helper->Sql()->query(
                "INSERT INTO b_smith_test_publishing (TITLE, CITY, AUTHOR_PROFIT)
            VALUES ('Эксмо', 'Санкт-Петербург', 550),
                   ('АСТ', 'Москва', 380),
                   ('МИФ', 'Нижний Новгород', 230);"
            );
            $helper->Sql()->query(
                "INSERT INTO b_smith_test_book (PUBLISHING_ID, TITLE, YEAR, COPIES_CNT)
            VALUES (1, 'Мастер и Маргарита', 1940, 170148),
                   (3, 'Мертвые души', 1842, 64740),
                   (1, 'Двенадцать стульев', 1928, 67212);"
            );
            $helper->Sql()->query(
                "INSERT INTO b_smith_test_author_book (AUTHOR_ID, BOOK_ID)
            VALUES (1,1),
                   (2, 1),
                   (3, 3),
                   (4,3),
                   (1,3),
                   (2,2);"
            );
        });
    }

    public function down()
    {

    }
}