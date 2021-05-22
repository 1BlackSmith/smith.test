<?php

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);

class smith_test extends CModule
{
    var $MODULE_ID = "smith.test";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $MODULE_GROUP_RIGHTS = "Y";

    function __construct()
    {
        $arModuleVersion = array();
        include(__DIR__ . "/version.php");

        $this->MODULE_ID = 'smith.test';
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = Loc::getMessage("SMITH_TEST_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("SMITH_TEST_MODULE_DESC");

        $this->MODULE_SORT = 1;
    }

    public function DoInstall()
    {
        global $APPLICATION;

        if (\CModule::IncludeModule('sprint.migration')) {
            try {
                (new Sprint\Migration\Installer(
                    [
                        'migration_dir'          => __DIR__ . '/migrations/',
                        'migration_dir_absolute' => true,
                    ]
                ))->up();
            } catch (\Exception $e) {
                global $APPLICATION;
                $APPLICATION->ThrowException($e->getMessage());
                return false;
            }
        }

        \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
        return true;
    }

    public function DoUninstall()
    {
        if (\CModule::IncludeModule('sprint.migration')) {
            try {
                (new Sprint\Migration\Installer(
                    [
                        'migration_dir'          => __DIR__ . '/migrations/',
                        'migration_dir_absolute' => true,
                    ]
                ))->down();
            } catch (\Exception $e) {
                global $APPLICATION;
                $APPLICATION->ThrowException($e->getMessage());
                return false;
            }
        }

        \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}
