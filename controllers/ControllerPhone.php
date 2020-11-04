<?php

namespace controllers;

use models\Phone;
use views\View;

/**
 * Class ControllerPhone
 * @package controllers
 */
class ControllerPhone
{
    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $aListPhone = Phone::getList();
        $oView = new View('list');
        $oView->assign('aList', $aListPhone);
        return $oView->render();
    }
}