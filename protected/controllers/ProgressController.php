<?php

class ProgressController extends Controller
{
    const SPECIALITY = 1;
    const GROUP = 2;
	
	public function filters() {

        return array(
            'accessControl',
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    'journal',
                    'getGroups',
                    'insertStegMark',
                    'insertDsejMark',
                    'insertMmbjMark',
                    'insertMejModule',
                    'deleteMejModule',
                    'modules',
                    'module',
                    'updateVvmp',
                    'insertVmpMark',
                    'updateStus',
                    'closeModule',
                    'renderExtendedModule',
                    'thematicPlan',
                    'renderUstemTheme',
                    'insertUstemTheme',
                    'deleteUstemTheme',
                    'examSession',
                    'insertStus',
                    'insertVmp'
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
            ),
            array('allow',
                'actions' => array('attendanceStatistic','rating')
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
	
    public function actionRating()
    {
        $model = new FilterForm();
        $model->scenario = 'rating-group';
        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];
        $this->render('rating', array(
            'model' => $model,
        ));
    }
	
    public function actionJournal()
    {
        $type = 0; // own disciplines

        $grants = Yii::app()->user->dbModel->grants;
        if (! empty($grants))
            $type = $grants->getGrantsFor(Grants::EL_JOURNAL);

        $model = new FilterForm;
        $model->scenario = 'journal';
        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];

        $this->render('journal', array(
            'model' => $model,
            'type' => $type,
        ));
    }

    public function actionGetGroups()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $type = Yii::app()->request->getParam('type', 0);
        $discipline = Yii::app()->request->getParam('discipline', 0);

        $groups = CHtml::listData(Gr::model()->getGroupsFor($discipline, $type), 'gr1', 'name');

        echo CHtml::dropDownList('FilterForm[group]', '',$groups, array('id'=>'FilterForm_group', 'class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;'));
    }

    public function actionInsertStegMark()
    {
        /*if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');*/

        $stegn1 = Yii::app()->request->getParam('st1', null);
        $stegn2 = Yii::app()->request->getParam('us1', null);
        $stegn3 = Yii::app()->request->getParam('nom', null);
		$stegn9 = Yii::app()->request->getParam('date', null);
        $field = Yii::app()->request->getParam('field', null);
        $value = Yii::app()->request->getParam('value', null);

        if($stegn1==null || $stegn2==null || $stegn3==null || $field==null || $value==null|| $stegn9==null)
            $error = true;
        else {
            Stegn::model()->insertMark($stegn1,$stegn2,$stegn3,$field,$value,$stegn9);
            $error = false;
        }
        Yii::app()->end(CJSON::encode(array('error' => $error)));
    }

    public function actionInsertDsejMark()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $dsej2 = Yii::app()->request->getParam('st1', null);
        $dsej3 = Yii::app()->request->getParam('us1', null);
        $field = Yii::app()->request->getParam('field', null);
        $value = Yii::app()->request->getParam('value', null);
        
       if($dsej2==null || $dsej3==null || $field==null || $value==null)
            $error = true;
        else {
            Dsej::model()->insertMark($dsej2,$dsej3,$field,$value);
            $error = false;
        } 

        Yii::app()->end(CJSON::encode(array('error' => $error)));
    }

    public function actionInsertMmbjMark()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $mmbj2 = Yii::app()->request->getParam('mmbj2', null);
        $mmbj3 = Yii::app()->request->getParam('mmbj3', null);
        $field = Yii::app()->request->getParam('field', null);
        $value = Yii::app()->request->getParam('value', null);
        if($mmbj2==null || $mmbj3==null || $field==null || $value==null)
            $error = true;
        else {
            Mmbj::model()->insertMark($mmbj2,$mmbj3,$field,$value);
            $error = false;
        }
        Yii::app()->end(CJSON::encode(array('error' => $error)));
    }

    public function actionInsertMejModule()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $mej3  = Yii::app()->request->getParam('mej3', null);
        $mej4  = Yii::app()->request->getParam('mej4', null);
        $mej5  = Yii::app()->request->getParam('mej5', null);
        $vvmp1 = Yii::app()->request->getParam('vvmp1', null);

        $model = new Mej();
        $model->mej1 = new CDbExpression('GEN_ID(GEN_MEJ, 1)');
        $model->mej3 = $mej3;
        $model->mej4 = $mej4;
        $model->mej5 = $mej5;

        $error = !$model->save();

        if (! $error)
            Vmp::model()->recalculateModulesFor($vvmp1, $mej3);

        Yii::app()->end(CJSON::encode(array('error' => $error, 'errors' => $model->getErrors())));
    }

    public function actionDeleteMejModule()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $mej1  = Yii::app()->request->getParam('mej1', null);
        $nr1   = Yii::app()->request->getParam('nr1', null);
        $vvmp1 = Yii::app()->request->getParam('vvmp1', null);

        $deleted = Mej::model()->deleteByPk($mej1);

        if ($deleted)
            Vmp::model()->recalculateModulesFor($vvmp1, $nr1);
    }

    public function actionModules()
    {
        $type = 0; // own modules

        $grants = Yii::app()->user->dbModel->grants;
        if (! empty($grants))
            $type = $grants->getGrantsFor(Grants::MODULES);

        $model = new FilterForm;
        $model->scenario = 'modules';
        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];


        $moduleInfo = null;
        if (! empty($model->group)) {
            $moduleInfo = $this->fillModulesFor($model);
        }

        $this->render('modules', array(
            'model'      => $model,
            'type'       => $type,
            'moduleInfo' => $moduleInfo,
        ));
    }
	
	public function actionModule()
    {
        $type = 0; // own modules

		$type = P::getPermition(Yii::app()->user->dbModel->p1);	
        $model = new FilterForm;
        $model->scenario = 'module';
        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];

        $this->render('module', array(
            'model'      => $model,
            'type'       => $type,
        ));
    }

    private function fillModulesFor($model)
    {
        $gr1  = $model->group;
        $d1   = $model->discipline;
        $year = Yii::app()->session['year'];
        $sem  = Yii::app()->session['sem'];
        $res = Vvmp::model()->fillDataForGroup($gr1, $d1, $year, $sem);
        return $res;
    }

    public function actionUpdateVvmp()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $value = Yii::app()->request->getParam('value', null);
        $field = Yii::app()->request->getParam('field', null);
        $vvmp1 = Yii::app()->request->getParam('vvmp1', null);

        $whiteList = array(
            'vvmp10', 'vvmp11', 'vvmp12', 'vvmp13', 'vvmp14', 'vvmp15', 'vvmp16',
            'vvmp17', 'vvmp18', 'vvmp19', 'vvmp20', 'vvmp21', 'vvmp22', 'vvmp23',
        );
        if (in_array($field, $whiteList))
            $attr = array(
                $field => $value
            );

        $criteria = new CDbCriteria();
        $criteria->compare('vvmp1', $vvmp1);

        $model = Vvmp::model()->find($criteria);
        if (empty($model))
            $error = true;
        else
            $error = !$model->saveAttributes($attr);

        Yii::app()->end(CJSON::encode(array('error' => $error, 'errors' => $model->getErrors())));
    }

    public function actionInsertVmpMark()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $vmp1  = Yii::app()->request->getParam('vvmp1', null);
        $vmp2  = Yii::app()->request->getParam('st1', null);
        $vmp3  = Yii::app()->request->getParam('module', null);
        $field = Yii::app()->request->getParam('field', null);
        $value = Yii::app()->request->getParam('value', null);

        $whiteList = array('vmp4', 'vmp5', 'vmp6', 'vmp7');
        if (in_array($field, $whiteList))
            $attr = array(
                $field => $value
            );


        $criteria = new CDbCriteria();
        $criteria->compare('vmp1', $vmp1);
        $criteria->compare('vmp2', $vmp2);
        $criteria->compare('vmp3', $vmp3);

        $model = Vmp::model()->find($criteria);
        if (empty($model))
            $error = true;
        else
            $error = !$model->saveAttributes($attr);

        // recalculate vmp4 if vmp5, vmp6 or vmp7 were changed
        if (! $error && in_array($field, array('vmp5', 'vmp6', 'vmp7')))
            $model->recalculateVmp4();

        Yii::app()->end(CJSON::encode(array('error' => $error, 'errors' => $model->getErrors())));
    }
	
	public function actionInsertVmp()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $vmp1  = Yii::app()->request->getParam('vmpv1', null);
        $vmp2  = Yii::app()->request->getParam('st1', null);
        $value = (int)Yii::app()->request->getParam('value', null);
		
		$criteria = new CDbCriteria();
		$criteria->compare('vmp1', $vmp1);
		$criteria->compare('vmp2', $vmp2);
		$sql=<<<SQL
			select * from vmpp where vmpp1=:vmpv1 and vmpp2=:p1 and vmpp4=1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':vmpv1', $vmp1);
		$command->bindValue(':p1', Yii::app()->user->dbModel->p1);
        
		$model = Vmp::model()->find($criteria);
		if (empty($model))
			$error = true;
		else
		{
			$permition = $command->queryAll();
			if($permition==null)
				$error = true;
			else
			{
				if($value>=0&&$value<=5)
				{
					$model->vmp4=$value;
					$error = !$model->save();
				}else
				{
					$error = true;
				}
			}
		}
		
        Yii::app()->end(CJSON::encode(array('error' => $error, 'errors' => $model->getErrors())));
    }

    public function actionUpdateStus()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $value = Yii::app()->request->getParam('value', null);
        $field = Yii::app()->request->getParam('field', null);
        $vvmp1 = Yii::app()->request->getParam('vvmp1', null);
        $st1   = Yii::app()->request->getParam('st1', null);

        $whiteList = array(
            'stus3'
        );
        if (in_array($field, $whiteList))
            $attr = array(
                $field => $value
            );

        $vvmp = Vvmp::model()->findByPk($vvmp1);

        $criteria = new CDbCriteria();
        $criteria->compare('stus1',  $st1);
        $criteria->compare('stus18', $vvmp->vvmp3);
        $criteria->compare('stus19', 8);
        $criteria->compare('stus20', $vvmp->vvmp4);
        $criteria->compare('stus21', $vvmp->vvmp5);

        $model = Stus::model()->find($criteria);
        if (empty($model))
            $error = true;
        else
            $error = !$model->saveAttributes($attr);

        $res = array(
            'error' => $error
        );

        if (! empty($model))
            $res += array('errors' => $model->getErrors());

        Yii::app()->end(CJSON::encode($res));
    }

    public function actionCloseModule()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $vvmp1 = Yii::app()->request->getParam('vvmp1', null);

        if (empty($vvmp1))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $vvmp = Vvmp::model()->findByPk($vvmp1);

        $res = $vvmp->saveAttributes(array(
            'vvmp7' => date('Y-m-d H:i:s')
        ));

        Yii::app()->end(CJSON::encode(array('res' => $res)));
    }

    public function actionRenderExtendedModule()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $uo1  = Yii::app()->request->getParam('uo1', null);
        $gr1  = Yii::app()->request->getParam('gr1', null);
        $d1   = Yii::app()->request->getParam('d1', null);
        $module_num = Yii::app()->request->getParam('module_num', null);


        $model = new FilterForm;
        $model->scenario = 'modules';
        $model->group = $gr1;
        $model->discipline = $d1;
        $moduleInfo = $this->fillModulesFor($model);


        if (empty($uo1) || empty($gr1) || empty($d1) || empty($module_num))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $students = St::model()->getStudentsForJournal($gr1, $uo1);

        $this->renderPartial('modules/_extended_module', array(
            'students'   => $students,
            'moduleInfo' => $moduleInfo,
            'module_num' => $module_num
        ));
    }

    public function actionThematicPlan()
    {
        $model = new FilterForm();
        $model->scenario = 'thematicPlan';
        
        if (isset($_REQUEST['FilterForm'])) {
            $model->attributes=$_REQUEST['FilterForm'];

            $deleteThematicPlan = Yii::app()->request->getParam('delete-thematic-plan', null);
            if ($deleteThematicPlan)
                Ustem::model()->deleteThematicPlan($model);
        }
        if(!empty($model->type_lesson))
            Ustem::model()->recalculation($model->type_lesson);
        $this->render('thematicPlan', array(
            'model' => $model
        ));
    }

    public function actionRenderUstemTheme()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $ustem1 = Yii::app()->request->getParam('ustem1', null);
        $d1     = Yii::app()->request->getParam('d1', null);

        if (empty($ustem1) || empty($d1))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');


        $model = Ustem::model()->findByAttributes(array('ustem1' => $ustem1));

        if (isset($_REQUEST['Ustem'])) {

            $model->attributes = $_REQUEST['Ustem'];
            $model->save();

        }

        $html = $this->renderPartial('thematicPlan/_theme', array(
            'model' => $model,
            'd1'    => $d1
        ), true);

        $res = array(
            'html' => $html,
            'errors' => $model->getErrors(),
        );

        Yii::app()->end(CJSON::encode($res));
		/*if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $ustem1 = Yii::app()->request->getParam('ustem1', null);
        $d1     = Yii::app()->request->getParam('d1', null);
        $sem4   = Yii::app()->request->getParam('sem4', null);

        if (empty($ustem1) || empty($d1) || empty($sem4))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');


        $model = Ustem::model()->findByAttributes(array('ustem1' => $ustem1));

        if (isset($_REQUEST['Ustem'])) {

            $model->attributes = $_REQUEST['Ustem'];
            $model->save();

            if (isset($_REQUEST['Nr'])) {
                foreach ($_REQUEST['Nr'] as $key => $nr6) {
                    Nr::model()
                        ->findByPk($key)
                        ->saveAttributes(array(
                            'nr6' => $nr6,
                            'nr18' => $model->nr18
                        ));
                }

            }
        }

        $html = $this->renderPartial('thematicPlan/_theme', array(
            'model' => $model,
            'd1'    => $d1,
            'sem4'  => $sem4,
        ), true);

        $res = array(
            'html' => $html,
            'errors' => $model->getErrors(),
        );

        Yii::app()->end(CJSON::encode($res));*/
    }
    
    public function actionInsertUstemTheme()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $ustem2 = Yii::app()->request->getParam('us1', null);
        $ustem3 = Yii::app()->request->getParam('ustem3', null);
        $ustem4 = Yii::app()->request->getParam('ustem4', null);
        $ustem5 = Yii::app()->request->getParam('ustem5', null);
        $ustem6 = Yii::app()->request->getParam('ustem6', null);

        if (empty($ustem2))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $sql=<<<SQL
                SELECT MAX(USTEM1) FROM USTEM
SQL;
        $command = Yii::app()->db->createCommand($sql);
        //$command->bindValue(':us1', $ustem2);
        $ustem1 = (int)$command->queryScalar();
        
        $model = new Ustem;
        $model->ustem1=$ustem1+1;
        $model->ustem2=$ustem2;
        $model->ustem3=$ustem3;
        $model->ustem4=$ustem4;
        $model->ustem5=$ustem5;
        $model->ustem6=$ustem6;
        $error=!$model->save();
        
        $res = array(
            'error'=>$error,
            'errors' => $model->getErrors(),
            'ustem1'=>$model->ustem1
        );

        Yii::app()->end(CJSON::encode($res));
    }

    public function actionDeleteUstemTheme()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $ustem1 = Yii::app()->request->getParam('ustem1', null);
        
        $deleted = (bool)Ustem::model()->deleteByPk($ustem1);

        $res = array(
            'deleted' => $deleted
        );

        Yii::app()->end(CJSON::encode($res));
    }

    public function actionAttendanceStatistic()
    {
        $model = new FilterForm();
        $model->scenario = 'attendanceStatistic';

        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];
			$this->render('attendanceStatistic', array(
				'model' => $model,
				'type_statistic'=>Yii::app()->params['attendanceStatistic']
			));
    }

    public function actionExamSession()
    {
        $type = 0; // own disciplines

        $grants = Yii::app()->user->dbModel->grants;
        if (! empty($grants))
            $type = $grants->getGrantsFor(Grants::EXAM_SESSION);

        $model = new FilterForm;
        $model->scenario = 'exam-session';
        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];

        $this->render('examSession', array(
            'model' => $model,
            'type' => $type,
        ));

    }

    public function actionInsertStus()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $st1    = Yii::app()->request->getParam('st1', null);
        $stus0  = Yii::app()->request->getParam('stus0', null);
        $stusp5 = Yii::app()->request->getParam('stusp5', null);
        $k1     = Yii::app()->request->getParam('k1', null);
        $field  = Yii::app()->request->getParam('field', null);
        $value  = Yii::app()->request->getParam('value', null);
        $stus6  = Yii::app()->request->getParam('stus6', null);
        $stus7  = Yii::app()->request->getParam('stus7', null);
        $cxmb0  = Yii::app()->request->getParam('cxmb0', null);

        $stus  = array('stus8', 'stus6', 'stus7', 'stus3');
        $stusp = array('stusp8', 'stusp6', 'stusp7', 'stusp3');
        $whiteList = array_merge($stus, $stusp);

        if (in_array($field, $whiteList))
            $attr = array(
                $field => $value
            );

        $error = true;

        $criteria = new CDbCriteria();
        $criteria->compare('stus0', $stus0);
        $modelS = Stus::model()->find($criteria);
        $modelS->saveAttributes(array('stus4' => Yii::app()->user->dbModel->getPd1ByK1($k1)));

        if (in_array($field, $stus)) {

            if (! empty($modelS)) {
                if ($field == 'stus3') {
                    $cxmb = Cxmb::model()->getExtraMarks($cxmb0, $value);
                    if (! empty($cxmb)) {
                        $attr['stus11'] = $cxmb['cxmb3'];
                        $attr['stus8']  = $cxmb['cxmb2'];
                    }
                }
                $error = ! $modelS->saveAttributes($attr + array('stus6'=>$stus6, 'stus7'=>$stus7));
            }

        } elseif (in_array($field, $stusp)) {

                $criteria = new CDbCriteria();
                $criteria->compare('stusp0', $stus0);
                $criteria->compare('stusp5', $stusp5);

                if ($field == 'stusp3') {
                    $cxmb = Cxmb::model()->getExtraMarks($cxmb0, $value);
                    if (! empty($cxmb)) {
                        $attr['stusp11'] = $cxmb['cxmb3'];
                        $attr['stusp8']  = $cxmb['cxmb2'];
                    }
                }

                $model = Stusp::model()->find($criteria);
                if (empty($model)) {
                    $model = new Stusp();
                    $model->stusp0 = $stus0;
                    $model->stusp2 = 0;
                    $model->stusp5 = $stusp5;
                    $model->stusp6 = $stus6;
                    $model->stusp7 = $stus7;
                    $model->stusp12 = '';

                    $model->$field = $value;
                    if (isset($attr['stusp11'])) {
                        $model->stusp11 = $attr['stusp11'];
                        $model->stusp8  = $attr['stusp8'];
                    }

                    $error = ! $model->save();
                } else
                    $error = ! $model->customSave($attr + array('stusp6'=>$stus6, 'stusp7'=>$stus7));
            }

        Yii::app()->end(CJSON::encode(array('error' => $error)));
    }
}