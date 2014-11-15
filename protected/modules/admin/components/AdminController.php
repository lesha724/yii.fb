<?php

class AdminController extends Controller
{
    public function filters() {

        return array(
            'accessControl',
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    'teachers',
                    'students',
                    'parents',
                    'stGrants',
                    'pGrants',
                    'prntGrants',
                    'journal',
                    'modules',
                    'entrance',
                    'menu',
                    'employment',
                ),
                'expression' => 'Yii::app()->user->isAdmin',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
}
