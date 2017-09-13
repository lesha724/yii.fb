<?php

/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 13.09.2017
 * Time: 11:45
 */
class EAuthController extends Controller
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
                    'index'
                ),
                'expression' => 'Yii::app()->user->isAdmin',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex(){
        $file = YiiBase::getPathOfAlias('application.config').'/paramsEAuth.inc';
        $arr = array();
        if(file_exists($file)) {
            $content = file_get_contents($file);
            $arr = unserialize(base64_decode($content));
        }
        $model = new ConfigEAuthForm();
        $model->setAttributes($arr);
        $model->setAttributesByServicesArr(isset($arr['services'])? $arr['services'] : array());

        if (isset($_POST['ConfigEAuthForm']))
        {
            $model->unsetAttributes();
            $model->setAttributes($_POST['ConfigEAuthForm']);
            if($model->validate()) {

                $services = $model->getServicesArr();

                $config = array(
                    'enable' => $model->enable == 1,
                    'popup' => $model->popup == 1,
                    'services' => $services
                );

                $str = base64_encode(serialize($config));
                $errors = !file_put_contents($file, $str);
                if (!$errors)
                    Yii::app()->user->setFlash('success', tt('Новые настройки сохранены!'));
                else
                    Yii::app()->user->setFlash('error', tt('Ошибка! Новые настройки не сохранены!'));
                $model->setAttributes($config);
            }
        }
        $this->render('index',array('model'=>$model));
    }
}