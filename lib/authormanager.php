<?php

namespace Smith\Test;

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ORM\Fields\ExpressionField;

Loc::loadMessages(__FILE__);

class AuthorManager
{
    /**
     * @param string $authorLastName
     * @param string $publishingTitle
     *
     * @return int
     */
    public function getBooksAmount(string $authorLastName, string $publishingTitle): int
    {
        return Internals\BookTable::getRow([
            'select' => [new ExpressionField('COUNT', 'COUNT(*)')],
            'filter' => [
                '%AUTHORS.LAST_NAME' => $authorLastName,
                '%PUBLISHING.TITLE' => $publishingTitle
            ]
        ])['COUNT'];
    }

    /**
     * @param array $authorsLastName
     * @param string $bookTitle
     *
     * @return float
     */
    public function getSoAuthorsFee(array $authorsLastName, string $bookTitle): float
    {
        if (!count($authorsLastName))
            throw new \LogicException(Loc::getMessage('EMPTY_AUTHOR_LIST'));

        $arAuthors = Internals\AuthorTable::getList([
            'select' => ['LAST_NAME'],
            'filter' => ['%BOOKS.TITLE' => $bookTitle]
        ])->fetchCollection()->getLastNameList();

        if (count(array_diff($authorsLastName, $arAuthors)))
            throw new \LogicException(loc::getMessage('INVALID_AUTHORS_LIST'));

        return Internals\BookTable::getRow([
            'select' => [
                'AUTHOR_PROFIT' => 'PUBLISHING.AUTHOR_PROFIT',
                new ExpressionField('SOAUTHORS_FEE', 'COPIES_CNT * AUTHOR_PROFIT * ' . count($authorsLastName) . ' /' . count($arAuthors))
            ],
            'filter' => [
                '%TITLE' => $bookTitle
            ]
        ])['SOAUTHORS_FEE'];
    }
}