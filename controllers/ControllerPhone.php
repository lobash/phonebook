<?php

namespace controllers;

use components\Uploader;
use components\Validator;
use Exception;
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

    /**
     * используется по ajax
     * @throws Exception
     */
    public function actionDelete()
    {
        Validator::checkCsrf();
        $iId = (int)Validator::clearValue($_POST['id']);
        $bRes = Phone::deleteOnId($iId);
        echo json_encode(['result' => $bRes]);
        exit;
    }

    /**
     * используется по ajax
     * @throws Exception
     */
    public function actionAdd()
    {
        Validator::checkCsrf();

        $aPost = $_POST;
        $sFileName = '';

        if (empty($aFile = $_FILES['image']) === false) {
            $sFileName = Uploader::uploadFileImage($aFile);
        }
        $aPost['image'] = $sFileName;

        foreach ($aPost as &$sInputValue) {
            $sInputValue = Validator::clearValue($sInputValue);
        }

        if (Phone::addNew($aPost) !== true) {
            throw new Exception('error with add new phone');
        }

        $oView = new View('_item');
        $oView->assign('aItem', $aPost);
        $oView->assign('sCsrf', Validator::getCsrf());
        return $oView->render();
    }

}