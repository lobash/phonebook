<?php

namespace controllers;

use application\Request;
use components\CurrentUser;
use components\Uploader;
use components\Validator;
use Exception;
use models\Phone;
use services\Phone as ServicePhone;
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

        $sCsrf = Validator::generateCsrf();
        $aListPhone = Phone::getListOnUserId(CurrentUser::getId());
        $oView = new View('phone/list');
        $oView->assign('aList', $aListPhone);
        $oView->assign('sCsrf', $sCsrf);
        $oView->assign('iUserId', CurrentUser::getId());
        return $oView->render();
    }

    /**
     * используется по ajax
     * @return string
     * @throws Exception
     */
    public function actionDelete(): string
    {
        Validator::checkCsrf();
        $iId = (int)Request::get('id');
        $bRes = Phone::delete($iId);
        return json_encode(['result' => $bRes]);
    }

    /**
     * используется по ajax
     * @return string
     * @throws Exception
     */
    public function actionAdd(): string
    {
        Validator::checkCsrf();

        $aFile = $_FILES['image'];

        $aPost = $_POST;
        $aPost['image'] = Uploader::uploadFileImage($aFile);
        $aPost['id'] = ServicePhone::add($aPost);

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

        $iId = Request::get('id');
        $aData = ServicePhone::get($iId);

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