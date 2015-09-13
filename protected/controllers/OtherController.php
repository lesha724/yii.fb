<?php


// Grab the Apostle namespace
use Apostle\Mail;

class OtherController extends Controller
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
                    'orderLesson', 'freeRooms', 'saveLessonOrder', 'deleteComment',
                ),
                'expression' => 'Yii::app()->user->isTch',
            ),
            array('allow',
                'actions' => array(
                    'gostem',
                    'deleteGostem',
                    'subscription',
                    'saveCiklVBloke',
                    'saveDisciplines',
                    'cancelSubscription',
                ),
                'expression' => 'Yii::app()->user->isStd',
            ),
            array('allow',
                'actions' => array(
                    'phones',
                    'employment',
                    'studentInfo',
                    'studentInfoExcel',
                    'studentPassport',
                    'deletePassport',
                    'showPassport',
                    'uploadPassport',
                    'changePassport',
                    'autocompleteTeachers',
                    'updateNkrs',
                    'searchStudent'
                ),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }



    public function actionPhones()
    {
        $department = Yii::app()->request->getParam('department', null);

        $phones = Tso::model()->getAllPhonesInArray($department);

        $this->render('phones', array(
            'phones' => $phones,
            'department' => $department
        ));
    }

    public function actionGostem()
    {
        $model = new FilterForm;
        $model->scenario = 'gostem';

        if (isset($_REQUEST['FilterForm'])) {
            $model->attributes=$_REQUEST['FilterForm'];

            if (isset($_REQUEST['subscribe'])) {
                $nrst = new Nrst;
                $nrst->nrst1 = $model->nr1;
                $nrst->nrst2 = Yii::app()->user->dbModel->st1;
                $nrst->nrst3 = $model->gostem1;
                $nrst->save();
                $this->redirect('/other/gostem');
            }
        }


        $this->render('gostem', array(
            'model' => $model,
        ));
    }

    public function actionDeleteGostem()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $nrst1 = Yii::app()->request->getParam('nrst1', null);
        $nrst3 = Yii::app()->request->getParam('nrst3', null);

        if (empty($nrst1) || empty($nrst3))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $deleted = (bool)Nrst::model()->deleteAllByAttributes(array(
            'nrst1' => $nrst1,
            'nrst2' => Yii::app()->user->dbModel->st1,
            'nrst3' => $nrst3,
        ));

        $res = array(
            'deleted' => $deleted
        );

        Yii::app()->end(CJSON::encode($res));
    }

    public function actionOrderLesson()
    {
        $model = new TimeTableForm;
        $model->scenario = 'group';
        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];
        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

        $timeTable = $minMax = $maxLessons = array();
        if (! empty($model->group))
        {
            list($minMax, $timeTable, $maxLessons) = $model->generateGroupTimeTable();;
        }


        $this->render('orderLesson', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'minMax'     => $minMax,
            'maxLessons' => $maxLessons,
            'rz'         => Rz::model()->getRzArray($model->filial),
            'type'=>-1
        ));
    }

    public function actionFreeRooms()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $zpz6   = Yii::app()->request->getParam('zpz6', null);
        $zpz7   = Yii::app()->request->getParam('zpz7', null);
        $filial = Yii::app()->request->getParam('filial', null);

        if (empty($zpz6) || empty($zpz7))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $rooms = CHtml::listData(A::model()->getFreeRooms($filial, $zpz6, $zpz7), 'a1', 'a2', 'ka2');

        $html = CHtml::dropDownList('ZPZ[zpz8]', null, $rooms, array('style'=>'width:155px'));

        Yii::app()->end(
            CJSON::encode(array('html' => $html))
        );
    }

    public function actionSaveLessonOrder()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $res = null;

        $params = Yii::app()->request->getParam('params');
        $params = explode('/',$params);

        if (isset($_POST['ZPZ'])) {

            $model = new Zpz;
            $model->attributes = $_POST['ZPZ'];
            $model->zpz1 = new CDbExpression('GEN_ID(GEN_ZPZ, 1)');
            $model->zpz2 = $params[0];
            $model->zpz3 = $params[1];
            $model->zpz4 = $params[2];
            $model->zpz5 = $params[3];
            $model->zpz9 = Yii::app()->user->dbModel->p1;
            $model->zpz10 = new CDbExpression('CURRENT_TIMESTAMP');
            $res = $model->save();
        }

        Yii::app()->end(
            CJSON::encode(array(
                'res'    => $res,
                'errors' => isset($model)?$model->getErrors():null
            ))
        );
    }

    public function actionEmployment()
    {
        $st1 = Yii::app()->request->getParam('id', null);

        if (empty($st1)) {

            $model = new FilterForm;
            $model->scenario = 'employment';

            if (isset($_REQUEST['FilterForm']))
                $model->attributes=$_REQUEST['FilterForm'];

            $this->render('employment', array(
                'model' => $model,
            ));

        } else {

            $student = St::model()->findByPk($st1);

            $model = Sdp::model()->loadModel($st1);

            $user = Yii::app()->user;
            $isEditable = $user->isAdmin ||
                          ($user->isStd && $user->dbModel->st1 == $st1);

            if ($isEditable && isset($_REQUEST['Sdp'])) {

                $model->attributes = $_REQUEST['Sdp'];

                if ($model->validate()) {
                    $model->save();
                } else
                    Yii::app()->user->setFlash('error', tt('Пожалуйста, исправьте возникшие ошибки!'));

            }

            if ($user->isTch) {
                $message = Yii::app()->request->getParam('message', null);
                if (! empty($message)) {
                    $comment = new Psto;
                    $comment->psto1 = $user->dbModel->p1;
                    $comment->psto2 = $st1;
                    $comment->psto3 = $message;
                    $comment->psto4 = new CDbExpression('current_timestamp');
                    $comment->save();
                    $this->redirect($this->createUrl('/other/employment', array('id' => $st1)));
                }

            }

            $criteria = new CDbCriteria;
            $criteria->compare('psto2', $st1);
            $criteria->order = 'psto4 DESC';
            $comments = Psto::model()->findAll($criteria);


            $this->render('employment/_st_info', array(
                'model'      => $model,
                'student'    => $student,
                'isEditable' => $isEditable,
                'comments'   => $comments,
            ));

        }
    }

    public function actionDeleteComment()
    {
        //if (! Yii::app()->request->isAjaxRequest)
        //    throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $user = Yii::app()->user;

        if (! $user->isTch)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $psto1 = Yii::app()->request->getParam('psto1', null);
        $psto2 = Yii::app()->request->getParam('psto2', null);
        $psto4 = Yii::app()->request->getParam('psto4', null);


        if (empty($psto1) || empty($psto2) || empty($psto4))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        if ($psto1 != $user->dbModel->p1)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $sql = <<<SQL
            DELETE
            FROM psto
            WHERE psto1 = :PSTO1 and psto2 = :PSTO2 and psto4 >= :PSTO4
            ROWS 1
SQL;


        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':PSTO1', $psto1);
        $command->bindValue(':PSTO2', $psto2);
        $command->bindValue(':PSTO4', $psto4);
        $res = $command->execute();

        Yii::app()->end(
            CJSON::encode(array('res' => $res))
        );
    }

    public function actionSubscription()
    {
        $model = Yii::app()->user->dbModel;

        $this->render('subscription', array(
            'model' => $model,
        ));
    }

    public function actionSaveCiklVBloke()
    {
        $u1_cikl = Yii::app()->request->getParam('u1_cikl', null);

        $res = false;
        if (! empty($u1_cikl)) {

            $_SESSION['u1_vib'] .= ','.$u1_cikl;
            $_SESSION['u1_vib_disc'] = $u1_cikl;

            $_SESSION['min_block']++;
            $_SESSION['func'] = 'PROCEDURA_VIBOR_DISCIPLIN';

            $res = true;
        }

        Yii::app()->end(CJSON::encode(array('res' => $res)));
    }

    public function actionSaveDisciplines()
    {
        $disciplines = Yii::app()->request->getParam('disciplines', null);

        $res = false;
        if (! empty($disciplines)) {

            foreach ($disciplines as $ucg1_kod) {
                U::model()->doUpdates($ucg1_kod);
            }

            $_SESSION['min_block']++;
            $_SESSION['func'] = 'PROCEDURA_CIKL_PO_BLOKAM';

            $res = true;
        }

        Yii::app()->end(CJSON::encode(array('res' => $res)));
    }

    public function actionCancelSubscription()
    {
        U::model()->cancelSubscription();
        unset($_SESSION['u1_vib'], $_SESSION['u1_vib_disc'], $_SESSION['func'], $_SESSION['min_block']);

        Yii::app()->end(CJSON::encode(array('res' => true)));
    }
    
    private function checkAccessPasport($psp1)
    {
        if (Yii::app()->user->isTch) {

            $grants = Yii::app()->user->dbModel->grants;

            if (empty($grants))
                throw new CHttpException(403, 'You don\'t have an access to this service');

            $type = $grants->getGrantsFor(Grants::STUDENT_INFO);

            if ($type == 0)
                throw new CHttpException(403, 'You don\'t have an access to this service');

        } elseif (Yii::app()->user->isStd) {
             if(Yii::app()->user->dbModel->st1!=$psp1)   
                 throw new CHttpException(403, 'You don\'t have an access to this service');
        } else
            throw new CHttpException(403, 'You don\'t have an access to this service');
    }
    
    public function actionStudentPassport($type,$psp1)
    {
        $this->checkAccessPasport($psp1);
        $stInfoForm= new StInfoForm;
        $stInfoForm->getPassport($psp1,$type);
    }
    
    public function actionDeletePassport()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        
        $error=false;
        
        $psp1 = Yii::app()->request->getParam('psp1', null);
        $type = Yii::app()->request->getParam('type', null);
        
        if($psp1!=null && $type!=null)
        {
            $this->checkAccessPasport($psp1);
            $stInfoForm= new StInfoForm;
            $stInfoForm->deletePassport($psp1,$type); 
        }else
           $error=true;  

        $res = array(
            'error'       => $error,
        );
        
        Yii::app()->end(CJSON::encode($res));
    }
    
    public function actionShowPassport()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        
        $error=false;
        $html='';
        
        $psp1 = Yii::app()->request->getParam('psp1', null);
        $type = Yii::app()->request->getParam('type', null);
        
        if($psp1!=null && $type!=null)
        {
            $this->checkAccessPasport($psp1);
            $stInfoForm= new StInfoForm;
            $html = $this->renderPartial('studentInfo/_show',array(
                'psp1'=>$psp1,
                'type'=>$type
            ), true);
        }else
           $error=true;  

        $res = array(
            'error'       => $error,
            'html'=>$html,
            'title'=>tt('Просмотр')
        );
        
        Yii::app()->end(CJSON::encode($res));
    }
    
     public function actionChangePassport()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        
        $error=false;
        $html='';
        
        $psp1 = Yii::app()->request->getParam('psp1', null);
        $type = Yii::app()->request->getParam('type', null);
        
        if($psp1!=null && $type!=null)
        {
            $this->checkAccessPasport($psp1);
            $stInfoForm= new StInfoForm;
            $html = $this->renderPartial('studentInfo/_change',array(
                'psp1'=>$psp1,
                'type'=>$type
            ), true);
        }else
           $error=true;  

        $res = array(
            'error'       => $error,
            'html'=>$html,
            'title'=>tt('Изменить')
        );
        
        Yii::app()->end(CJSON::encode($res));
    }
    
     public function actionUploadPassport()
    {
        if (! Yii::app()->request->isPostRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        
        $html='';
        
        $psp1 = Yii::app()->request->getParam('psp1', null);
        $type = Yii::app()->request->getParam('type', null);
        
        $error = "";
        $msg = "";
        $result = "";
        $fileElementName = 'document_psp';
        
        if($psp1!=null && $type!=null)
        {
            $this->checkAccessPasport($psp1);
            $stInfoForm= new StInfoForm;
            $files_count = (isset($_FILES[$fileElementName]["name"])) ? count($_FILES[$fileElementName]["name"]) : 0;
            for ($i = 0; $i < $files_count; $i++) {
		if($i > 0) break;

		$_FILES[$fileElementName]['name'][$i] = mb_strtolower($_FILES[$fileElementName]['name'][$i]);
		$_FILES[$fileElementName]['name'][$i] = str_replace(" ","_",$_FILES[$fileElementName]['name'][$i]);		
			
			$res=1;
                        if(!empty($_FILES[$fileElementName]['error'][$i]))
			{
				switch($_FILES[$fileElementName]['error'][$i])
				{
					case '1':
						$error = 'размер загруженного файла превышает размер установленный параметром upload_max_filesize  в php.ini ';
						break;
					case '2':
						$error = 'размер загруженного файла превышает размер установленный параметром MAX_FILE_SIZE в HTML форме. ';
						break;
					case '3':
						$error = 'загружена только часть файла ';
						break;
					case '4':
						$error = 'файл не был загружен (Пользователь в форме указал неверный путь к файлу). ';					
						break;
					case '6':
						$error = 'неверная временная дирректория';
						break;
					case '7':
						$error = 'ошибка записи файла на диск';
						break;
					case '8':
						$error = 'загрузка файла прервана';
						break;
					case '999':
					default:
						$error = 'No error code avaiable';
				}
			}elseif(empty($_FILES[$fileElementName]['tmp_name'][$i]) || $_FILES[$fileElementName]['tmp_name'][$i] == 'none')
			{
				$error = 'No file was uploaded..';
                                echo $error;
			}else 
			{				
                            $res=$stInfoForm->setPassport($psp1,$type);
                                
                        }   
                        if(empty($error)&&$res>-1)
                        {
                            Yii::app()->user->setFlash("upload_passport_success", tt('Загрузка успешна!'));
                        }else
                        {
                            if(!empty($error))
                            {
                                Yii::app()->user->setFlash("upload_passport_error", $error);
                            }else
                            {
                                Yii::app()->user->setFlash("upload_passport_error", tt('Ошибка сохранения'));
                            }
                        }
			unset($error);
		}
		echo $result;
            
            $this->redirect(array('/other/studentinfo'));
            
        }else
        {
            throw new CHttpException(404, '');
        }
        
    }
    
    public function actionSearchStudent()
    {
        $model = new St;
        $model->unsetAttributes();
        if (isset($_REQUEST['St']))
            $model->attributes = $_REQUEST['St'];
		
        $this->render('/timeTable/search_student', array(
            'model' => $model,
            'url'=>array('other/studentInfo')
        ));
    }
    
    public function actionStudentInfo()
    {
        $model = new TimeTableForm;
        $model->scenario = 'student';
        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $canSelectSt = false;
        if (Yii::app()->user->isTch) {

            $grants = Yii::app()->user->dbModel->grants;

            if (empty($grants))
                throw new CHttpException(404, 'You don\'t have an access to this service');

            $type = $grants->getGrantsFor(Grants::STUDENT_INFO);

            if ($type == 0)
                throw new CHttpException(404, 'You don\'t have an access to this service');

            $canSelectSt = true;

        } elseif (Yii::app()->user->isStd) {

            $model->student = Yii::app()->user->dbModel->st1;

        } else
            throw new CHttpException(404, 'You don\'t have an access to this service');


        if (! empty($_FILES)) {

            $nkrs1 = Yii::app()->request->getParam('nkrs1', null);
            $nkrs6 = Yii::app()->request->getParam('nkrs6', null);

            $document = CUploadedFile::getInstanceByName('document');
            $tmpName = tempnam(sys_get_temp_dir(), '_');
            $saved = $document->saveAs($tmpName);


            if ($saved) {
                list($id, $url) = $this->sendToAntiPlagiarism($document, $tmpName);
                if ($nkrs1)
                    D::model()->updateNkrs($nkrs1, 'nkrs8', $id);
                Yii::app()->user->setFlash('success', tt('Документ был отправлен на проверку в Антиплагиат'));
                Yii::app()->user->setFlash('info', tt('Результат можно посмотреть здесь:') .' '. CHtml::link(tt('Отчет'), $url, array('target' => '_blank')));
                $this->sendEmails($model->student, $nkrs6, $url);
            }
        }

        $stInfoForm = new StInfoForm();
        $stInfoForm->fillData($model);
        if (isset($_REQUEST['StInfoForm'])) {
            $stInfoForm->attributes=$_REQUEST['StInfoForm'];
            if ($stInfoForm->validate())
                $stInfoForm->customSave($model);
        }
        $student = new St;
        $student->unsetAttributes();
        
        $this->render('studentInfo', array(
            'canSelectSt' => $canSelectSt,
            'stInfoForm'  => $stInfoForm,
            'model' => $model,
            'student'=>$student
        ));
    }

    public function actionStudentInfoExcel()
    {
        $model = new TimeTableForm;
        if (Yii::app()->user->isStd) {

            $model->student = Yii::app()->user->dbModel->st1;

        } else
            throw new CHttpException(404, '1You don\'t have an access to this service');

        $stInfoForm = new StInfoForm();
        $stInfoForm->fillData($model);

        if(empty($model->student))
            throw new CHttpException(404, '2You don\'t have an access to this service');
        else
        {
            $student=St::model()->findByPk($model->student);
            if(empty($student))
                throw new CHttpException(404, '3You don\'t have an access to this service');
            else
            {
                $discipline = D::model()->getDisciplineForCourseWork($model->student);
                if ($discipline) {
                    $courseWork = D::model()->getFirstCourseWork($model->student, $discipline['us1']);
                    //list($rus, $eng) = Spkr::model()->findAllInArray();
                    $nkrs1 = $courseWork['nkrs1'];
                    $p1    = $courseWork['nkrs6'];
                    $nkrs6 = P::model()->getTeacherNameWithDol($courseWork['nkrs6']);
                    $nkrs7 = $courseWork['nkrs7'];
                    $nkrs4 = $courseWork['nkrs4'];
                    $nkrs5 = $courseWork['nkrs5'];
                    list($zav, $kav) = P::model()->getZavKavByTeacher($p1);
                    $k2=$kav['k3'];
                    $st_info=St::model()->getInfoForStudentInfoExcel($model->student);
                    $zav_name=Sh::getShortName($zav['p3'],$zav['p4'],$zav['p5']);
                    if(empty($nkrs4))
                    {
                        $spkr=Spkr::model()->findByPk($nkrs7);
                        if(!empty($spkr))
                        {
                            $nkrs4=$spkr->spkr2;
                            $nkrs5=$spkr->spkr3;
                        }
                    }
                    $pattern='студента %s курса %s группы';
                    Yii::import('ext.phpexcel.XPHPExcel');
                    $objPHPExcel= XPHPExcel::createPHPExcel();
                    $objPHPExcel->getProperties()->setCreator("ACY")
                        ->setLastModifiedBy("ACY ".date('Y-m-d H-i'))
                        ->setTitle("Jornal ".date('Y-m-d H-i'))
                        ->setSubject("Jornal ".date('Y-m-d H-i'))
                        ->setDescription("Jornal document, generated using ACY Portal. ".date('Y-m-d H:i:'))
                        ->setKeywords("")
                        ->setCategory("Result file");
                    $objPHPExcel->setActiveSheetIndex(0);
                    $sheet=$objPHPExcel->getActiveSheet();
                    $sheet->getColumnDimension('A')->setWidth(30);
                    $sheet->getColumnDimension('B')->setWidth(20);
                    $sheet->getColumnDimension('C')->setWidth(20);
                    $sheet->getColumnDimension('D')->setWidth(20);
                    $sheet->mergeCells('C1:D1')
                        ->setCellValue('C1', "На кафедру");
                    $sheet->mergeCells('C2:D2')
                        ->setCellValue('C2', $k2);
                    $sheet->getRowDimension(2)->setRowHeight(40);
                    $sheet->mergeCells('C3:D3')
                        ->setCellValue('C3',  '(заведующий - профессор '.SH::getShortName($zav['p3'],$zav['p4'],$zav['p5']).')');
                    $sheet->mergeCells('C4:D4')
                        ->setCellValue('C4', sprintf($pattern,$st_info['sem4'],$st_info['name']));
                    $sheet->mergeCells('C5:D5')
                        ->setCellValue('C5', 'Форма обучения: '.SH::convertEducationType($st_info['sg4']));
                    $sheet->mergeCells('C6:D6')
                        ->setCellValue('C6', SH::getShortName($student->st2,$student->st3,$student->st4));
                    $sheet->getStyleByColumnAndRow(0,1,3,6)->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                    $sheet->mergeCells('A7:D7')
                        ->setCellValue('A7', 'Заявление')->getStyle('A7')->getFont()->setSize(18);
                    $sheet->getStyle('A7')->getAlignment()-> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $sheet->getRowDimension(7)->setRowHeight(40);
                    $sheet->mergeCells('A8:D8')
                        ->setCellValue('A8', '   Прошу утвердить тему моей курсовой/дипломной работы');
                    $sheet->setCellValue('A9', 'Название на русском языке')->getStyle('A9')->getAlignment()-> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $sheet->setCellValue('A10', 'Название на английском языке')->getStyle('A10')->getAlignment()-> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $sheet->mergeCells('B9:D9')
                        ->setCellValue('B9', $nkrs4)->getStyle('B9')->getAlignment()->setWrapText(true)-> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $sheet->mergeCells('B10:D10')
                        ->setCellValue('B10', $nkrs5)->getStyle('B10')->getAlignment()->setWrapText(true)-> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $sheet->getStyleByColumnAndRow(0,9,3,10)->getBorders()->getAllBorders()->applyFromArray(array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000000')));
                    $sheet->getRowDimension(9)->setRowHeight(50);
                    $sheet->getRowDimension(10)->setRowHeight(50);
                    $sheet->mergeCells('A11:D11')->setCellValue('A11', 'Научный руководитель '.$nkrs6);
                    $sheet->setCellValue('A13','« ___ » __________ 20__г.');
                    $sheet->setCellValue('D13','__________');
                    $sheet->setCellValue('A15','«не возражаю»');
                    $sheet->setCellValue('D15','Научный руководитель');
                    $sheet->mergeCells('B15:C15')->setCellValue('B15', '____________________');
                    $sheet->setCellValue('A17','«не возражаю»');
                    $sheet->mergeCells('B17:C17')->setCellValue('B17', '____________________');
                    $sheet->setCellValue('D17','Заведующий кафедрой');
                    $sheet->setCellValue('A18','(только для дипломных работ)')->getStyle('A18')->getAlignment()->setWrapText(true)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                    $sheet->getRowDimension(18)->setRowHeight(30);

                    $data=St::model()->getShortCodesImage($model->student);
                    if($data!=null)
                    {
                        $sheet->setCellValue('A19','Штрихкод');
                        $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
                        $objDrawing->setName('logo');
                        $objDrawing->setImageResource( imagecreatefromstring($data));
                        $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_DEFAULT);
                        $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
                        $objDrawing->setHeight(100);
                        $objDrawing->setCoordinates('A20');
                        $objDrawing->setOffsetX(10);
                        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                    }

                    $sheet->setTitle('Заявление '.date('Y-m-d H-i'));
                    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                    $objPHPExcel->setActiveSheetIndex(0);

                    // Redirect output to a clientâ€™s web browser (Excel5)
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="ACY_'.date('Y-m-d H-i').'.xls"');
                    header('Cache-Control: max-age=0');
                    // If you're serving to IE 9, then the following may be needed
                    header('Cache-Control: max-age=1');
                    // If you're serving to IE over SSL, then the following may be needed
                    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header ('Pragma: public'); // HTTP/1.0

                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                    $objWriter->save('php://output');
                    Yii::app()->end();
                }
                else
                    throw new CHttpException(404, '4You don\'t have an access to this service');
            }
        }
        /*$this->render('studentInfo', array(
            'stInfoForm'  => $stInfoForm,
        ));*/
    }

    public function sendToAntiPlagiarism($document, $tmpName)
    {
        $ANTIPLAGIAT_URI = Yii::app()->params['antiPlagiarism']['antiplagiat_uri'];

        // Создать клиента сервиса(http, unsecured)
        $COMPANY_NAME = Yii::app()->params['antiPlagiarism']['company_name'];
        $APICORP_ADDRESS = Yii::app()->params['antiPlagiarism']['apicorp_address'];
        $client = new SoapClient("http://$APICORP_ADDRESS/apiCorp/$COMPANY_NAME?singleWsdl",
            array("trace"=>1,
                "soap_version" => SOAP_1_1,
                "features" => SOAP_SINGLE_ELEMENT_ARRAYS));

        // Описание загружаемого файла
        $data = array(
            "Data"     => file_get_contents($tmpName),
            "FileName" => $document->name,
            "FileType" => '.'.$document->extensionName
        );

        // Загрузка файла
        $uploadResult = $client->UploadDocument(array("data"=>$data));

        // Идентификатор документа. Если загружается не архив, то список загруженных документов будет состоять из одного элемента.
        $id = $uploadResult->UploadDocumentResult->Uploaded[0]->Id;

        // Иницировать проверку с использованием собственного модуля поиска и модуля поиска "wikipedia"
        $client->CheckDocument(array("docId" => $id, "checkServicesList" => array($COMPANY_NAME, "internet", "disser.rsl", "lexpro")));

        // Получить текущий статус последней проверки
        $status = $client->GetCheckStatus(array("docId" => $id));

        // Цикл ожидания окончания проверки
        while ($status->GetCheckStatusResult->Status === "InProgress")
        {
            sleep($status->GetCheckStatusResult->EstimatedWaitTime * 0.1);
            $status = $client->GetCheckStatus(array("docId" => $id));
        }

        // Проверка закончилась неудачно.
        if ($status->GetCheckStatusResult->Status === "Failed")
        {
            echo("При проверке документа произошла ошибка:" + $status->GetCheckStatusResult->FailDetails);
            return;
        }

        $url = $ANTIPLAGIAT_URI.$status->GetCheckStatusResult->Summary->ReportWebId;
        return array($id->Id, $url);
    }

    public function actionAutocompleteTeachers()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $query = Yii::app()->request->getParam('query', null);

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
                'p1'    => $tch['p1']
            );
        }

        $res = array(
            'query'       => $query,
            'suggestions' => $suggestions,
        );

        Yii::app()->end(CJSON::encode($res));
    }

    public function actionUpdateNkrs()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $field = Yii::app()->request->getParam('field', null);
        $value = Yii::app()->request->getParam('value', null);
        $nkrs1 = Yii::app()->request->getParam('nkrs1', null);

        if (! in_array($field, array('nkrs6', 'nkrs7')))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $res = D::model()->updateNkrs($nkrs1, $field, $value);

        Yii::app()->end(CJSON::encode(array('res' => $res)));
    }

    public function sendEmails($st1, $p1, $url)
    {
        $student = Users::model()->find('u5 = 0 and u6 = '.$st1);

        if (! empty($student)) {

            if ($student->u4) {
                $st = St::model()->findByPk($st1);

                Apostle::setup("a596c9f9cb4066dd716911ef92be9bd040b0664d");
                $mail = new Mail( "antiplagiat-notification", array( "email" => $student->u4 ) );
                $mail->url  = $url;
                $mail->textFrom = implode(' ', array($st->st2, $st->st3, $st->st4));
                $mail->deliver();
            }

        }

        if ($p1) {
            $teacher = Users::model()->find('u5 = 1 and u6 = '.$p1);

            if ($teacher->u4) {

                $st = St::model()->findByPk($st1);

                Apostle::setup("a596c9f9cb4066dd716911ef92be9bd040b0664d");
                $mail = new Mail( "antiplagiat-notification", array( "email" => $teacher->u4 ) );
                $mail->url  = $url;
                $mail->textFrom = implode(' ', array($st->st2, $st->st3, $st->st4));
                $mail->deliver();
            }
        }

    }
}
