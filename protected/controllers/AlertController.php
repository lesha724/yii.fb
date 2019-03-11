<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 14.12.2016
 * Time: 20:46
 */

class AlertController extends Controller
{
    public function filters() {

        return array(
            'accessControl',
            'checkPermission + send, autocomplete '
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(

                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
            ),
            array('allow',
                'actions' => array(
                    'index',
                    'send',
                    'autocomplete'
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch || Yii::app()->user->isStd',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function filterCheckPermission($filterChain)
    {
        if(!Yii::app()->user->isTch)
            if(PortalSettings::model()->getSettingFor(PortalSettings::STUDENT_SEND_IN_ALERT) != 1)
                throw new CHttpException(403, tt('Достпу запрещен'));

        $filterChain->run();
    }

    /**
     * Индесная страница
     */
    public function actionIndex()
    {
        if(Yii::app()->user->isGuest)
            throw new CHttpException(403, tt('Доступ запрещен'));

        $this->render('index', array(
            'model'   => Yii::app()->user->model
        ));
    }

    public function actionSend()
    {
        $model=new CreateMessageForm();
        $model->unsetAttributes();
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['CreateMessageForm']))
        {
            $model->attributes=$_POST['CreateMessageForm'];
            if($model->validate())
            {
                try {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', 'Сообщение успешно отправлено');
                    } else {
                        Yii::app()->user->setFlash('error', 'Ошибка отправления сообщения ');
                    }
                }catch (Exception $error){
                    Yii::app()->user->setFlash('error', 'Ошибка отправления сообщения: '.$error->getMessage());
                }
            }else{
                Yii::app()->user->setFlash('error', 'Ошибка отправления сообщения: '.implode('</br>', array_values($model->getErrors())));

            }
        }
        $this->redirect(array('index'));
        /*$this->render('create',array(
            'model'=>$model,
        ));*/
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='create-message-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAutocomplete($type, $faculty)
    {
        //if (! Yii::app()->request->isAjaxRequest)
            //throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $query = Yii::app()->request->getParam('query', null);

        $suggestions = array();

        if($type == CreateMessageForm::TYPE_TEACHER){
            $teachers = P::model()->findTeacherByName($query);

            foreach($teachers as $tch)
            {
                $t = '';
                if ($tch['pd7'] == 1)
                    $t = 'совм.';
                elseif ($tch['pd7'] == 3 || $tch['pd7'] == 5)
                    $t = 'почас.';
                elseif ($tch['pd7'] == 4)
                    $t = 'совмещ.';

                $suggestions[] = array(
                    'value' => implode(' ', array($tch['dol2'], SH::getShortName($tch['p3'], $tch['p4'], $tch['p5']))) .' '. $t,
                    'id'    => $tch['p1']
                );
            }
        }else if ($type == CreateMessageForm::TYPE_STUDENT){
            $students = St::model()->findStudentByName($query, $faculty);

            foreach($students as $st)
            {
                $suggestions[] = array(
                    'value' => strtr('{lastName} {firstName} {secondName} ({group})',
                        array(
                            '{lastName}' => $st['st2'],
                            '{firstName}' => $st['st3'],
                            '{secondName}' => $st['st4'],
                            '{group}' => Gr::model()->getGroupName($st['st20'], $st)
                        )
                    ),
                    'id'    => $st['st1']
                );
            }
        } else if($type == CreateMessageForm::TYPE_GROUP){

        }

        $res = array(
            'query'       => $query,
            'suggestions' => $suggestions,
        );

        Yii::app()->end(CJSON::encode($res));
    }
}