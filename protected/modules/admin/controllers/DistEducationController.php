<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 11.12.2017
 * Time: 18:57
 */

class DistEducationController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('index'),
                'expression' => 'Yii::app()->user->isAdmin',
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
}