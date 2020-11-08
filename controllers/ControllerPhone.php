<?php

namespace controllers;

use components\CurrentUser;
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
        if (CurrentUser::isLoggedIn() === false) {
            return $this->showAuthForm();
        }

        Validator::generateCsrf();

        $aListPhone = Phone::getList();
        $oView = new View('phone/list');
        $oView->assign('aList', $aListPhone);
        return $oView->render();
    }

    /**
     * используется по ajax
     * @throws Exception
     * @return string
     */
    public function actionDelete(): string
    {
        Validator::checkCsrf();
        $iId = (int)Validator::clearString($_POST['id']);
        $bRes = Phone::deleteOnId($iId);
        return json_encode(['result' => $bRes]);
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
        $aPost = Validator::clearArray($aPost);

        $iLastId = (int)Phone::addNew($aPost);
        if ($iLastId === 0) {
            throw new Exception('error with add new phone');
        }
        $aPost['id'] = $iLastId;

        $oView = new View('phone/_item_full');
        $oView->assign('aItem', $aPost);
        $oView->assign('sCsrf', Validator::getCsrf());
        return $oView->render();
    }

    /**
     * используется для ajax
     * @return string
     * @throws Exception
     */
    public function actionView(): string
    {
        Validator::checkCsrf();

        $iId = $_POST['id'];
        $iId = (int)Validator::clearString($iId);
        $aData = Phone::getOnId($iId);

        $oView = new View('phone/_item_view');
        $oView->assign('aItem', $aData);
        $oView->assign('sCsrf', Validator::getCsrf());
        return json_encode($oView->render());
    }

    /**
     * @return string
     */
    private function showAuthForm(): string
    {
        $oController = new ControllerAuth();
        return $oController->actionShowFormAuth();
    }

}