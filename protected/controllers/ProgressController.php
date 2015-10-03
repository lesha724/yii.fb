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
                    'insertVmp',
                    'omissions',
                    'searchStudent',
                    'filterStudent',
                    'insertOmissionsStegMark',
                    'updateOmissionsStegMark',
                    'retake',
                    'searchRetake',
                    'addRetake',
                    'saveRetake',
                    'showRetake',
                    'deleteRetake',
                    'checkCountRetake',
                    'journalExcel'
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
            ),
            array('allow',
                'actions' => array(
                    'test',
                ),
                'expression' => 'Yii::app()->user->isStd',
            ),
            array('allow',
                'actions' => array('attendanceStatistic','rating')
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
    
    public function actionTest()
    {
        $model = new Test('search');
        $model->unsetAttributes();
        $model->test4=Yii::app()->user->DbModel->st1;
        $this->render('test', array(
            'model' => $model,
        )); 
    }
    
    public function actionSearchRetake($us1)
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        $model = new Stegn('search');
        $model->unsetAttributes();
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);  // сбросим, чтобы не пересекалось с настройками пейджера
        }
        $model->stegn2=$us1;
        if (isset($_REQUEST['Stegn']))
            $model->attributes = $_REQUEST['Stegn'];


        $this->render('retake/_grid', array(
            'model' => $model,
        )); 
    }
    
    public function actionRetake()
    {
        $model = new FilterForm();
        $model->scenario = 'retake';
        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];
        $retake = new Stegn;
        $retake->unsetAttributes();
        $student = new St;
        $student->unsetAttributes();
        $this->render('retake', array(
            'model'      => $model,
            'retake'      => $retake,
            'student'	 =>$student,
        ));
    }
    
    public function actionOmissions()
    {
        $model = new TimeTableForm;
        $model->scenario = 'omissions';
		
        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];
        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];
        $student = new St;
        $student->unsetAttributes();
        $this->render('omissions', array(
            'model'      => $model,
            'student'	 =>$student,
        ));
    }
    
    public function actionUpdateOmissionsStegMark()
    {
        /*if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');*/

        $stegn1 = Yii::app()->request->getParam('stegn1', null);
        $date1 = Yii::app()->request->getParam('date1', null);
        $date2 = Yii::app()->request->getParam('date2', null);
        //$check = Yii::app()->request->getParam('check', null);
        $number = Yii::app()->request->getParam('number', null);
        $type = Yii::app()->request->getParam('type_omissions', null);
        $stegnp4= Yii::app()->request->getParam('stegnp4', null);
        $stegnp5 = Yii::app()->request->getParam('stegnp5', null);

        if($stegn1==null || $date1==null || $date2==null /*|| $check==null*/ || $type==null)
            $error = true;
        else {
            $check=1;
            if($type<4)
            {
                $check=2;
            }
            $attr = array(
                'stegn4' => $check,
                //'stegn10' => $type,
                //'stegn11' => $number,
                'stegn8' =>  Yii::app()->user->dbModel->p1,
                'stegn7' =>  date('Y-m-d H:i:s'),
            );
            $criteria = new CDbCriteria();
            $criteria->compare('stegn1', $stegn1);
            $criteria->compare('stegn4','>=1');
            $criteria->compare('stegn9','>='.$date1);
            $criteria->compare('stegn9', '<='.$date2);
            //редактируем стегн (все записи которые в это интревале, уваж или не уваж)
            $count = Stegn::model()->updateAll($attr,$criteria);

            if ($count==-1)
            {
                $error = true;
            }
            else
            {
                $error = false;

                $criteria->select='stegn0';
                //находим все стегн в этом интервале
                $models=Stegn::model()->findAll($criteria);
                if(!empty($models)){
                    $arr_id=array();
                    foreach($models as $model)
                    {
                        //array_push($arr_id,$model->stegn0);
                    }
                    $new_attr=array(
                        'stegnp2' => $type,
                        'stegnp3' => $number,
                        'stegnp4' => $stegnp4,
                        'stegnp5' => $stegnp5,
                        'stegnp7' =>  Yii::app()->user->dbModel->p1,
                        'stegnp6' =>  date('Y-m-d H:i:s'),
                    );
                    $new_criteria = new CDbCriteria();
                    $new_criteria->compare('stegnp1', $arr_id);
                    //редактируем все стегнп коротые связы с этими стегн
                    $count = Stegnp::model()->updateAll($new_attr,$new_criteria);
                    if ($count==-1)
                    {
                        $error = true;
                    }
                }
            }
        }
        Yii::app()->end(CJSON::encode(array('error' => $error)));
    }
    
    public function actionInsertOmissionsStegMark()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $stegn1 = Yii::app()->request->getParam('stegn1', null);
        $stegn2 = Yii::app()->request->getParam('stegn2', null);
        $stegn3 = Yii::app()->request->getParam('stegn3', null);
        $field = Yii::app()->request->getParam('field', null);
        $value = Yii::app()->request->getParam('value', null);

        if($stegn1==null || $stegn2==null || $stegn3==null || $field==null || ($value==null &&$field!='stegn11'))
            $error = true;
        else {
            $whiteList = array(
                'stegn10','stegn11','stegnp4','stegnp5'
            );
            $arr=array();
            if($field=='stegn10')
            {
                $check=1;
                if($value<4)
                {
                    $check=2;
                }
                $arr=array('stegn4'=>$check);
            }
            if (in_array($field, $whiteList))
                $attr = array_merge(array(
                    $field => $value,
                    'stegn8' =>  Yii::app()->user->dbModel->p1,
                    'stegn7' =>  date('Y-m-d H:i:s'),
                ),$arr);
            else
               throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.'); 

            $criteria = new CDbCriteria();
            $criteria->compare('stegn1', $stegn1);
            $criteria->compare('stegn2', $stegn2);
            $criteria->compare('stegn3', $stegn3);

            $model = Stegn::model()->find($criteria);
            if (empty($model))
                $error = true;
            else
            {
                $error = !$model->saveAttributes($attr);
                if(!$error)
                {
                    $stegnp=Stegnp::model()->findByAttributes(array('stegnp1'=>$model->stegn0));
                    switch ($field)
                    {
                        case 'stegn10':
                            $field='stegnp2';
                            break;
                        case 'stegn11':
                            $field='stegnp3';
                            break;
                    }
                    $error = !$stegnp->saveAttributes(
                        array(
                            $field => $value,
                            'stegnp7' =>  Yii::app()->user->dbModel->p1,
                            'stegnp6' =>  date('Y-m-d H:i:s')
                        )
                    );
                }
            }
        }
        Yii::app()->end(CJSON::encode(array('error' => $error)));
    }
    
    public function actionFilterStudent()
    {
        $model = new St;
        $model->unsetAttributes();
        if (isset($_REQUEST['St']))
            $model->attributes = $_REQUEST['St'];
		
        $this->render('retake/filter_student', array(
            'model' => $model,
        ));
    }
    
    public function actionSearchStudent()
    {
        $model = new St;
        $model->unsetAttributes();
        if (isset($_REQUEST['St']))
            $model->attributes = $_REQUEST['St'];
		
        $this->render('omissions/search_student', array(
            'model' => $model,
        ));
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

        $read_only=false;
        if(!empty($model->group))
        {
            $arr = explode("/", $model->group);
            $us1=$arr[0];
            $gr1=$arr[1];
            $sql = <<<SQL
                     SELECT * FROM  EL_GURN_LIST_DISC(:P1,:YEAR,:SEM,0,2,:US1,0);
SQL;
            $command = Yii::app()->db->createCommand($sql);

            $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
            $command->bindValue(':US1', $us1);
            $command->bindValue(':YEAR', Yii::app()->session['year']);
            $command->bindValue(':SEM', Yii::app()->session['sem']);
            $res = $command->queryRow();
            if(empty($res)||$res['dostup']==0)
            {
                $read_only=true;
            }
        }

        $this->render('journal', array(
            'model' => $model,
            'type' => $type,
            'read_only' => $read_only,
        ));
    }
    
    public function actionJournalExcel()
    {
        $type = 0; // own disciplines

        $grants = Yii::app()->user->dbModel->grants;
        if (! empty($grants))
            $type = $grants->getGrantsFor(Grants::EL_JOURNAL);

        $model = new FilterForm;
        $model->scenario = 'journal';
        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];
        if(!empty($model->group))
        {
            $arr = explode("/", $model->group);
            $us1=$arr[0];
            $gr1=$arr[1];
            $sql = <<<SQL
                    
                select sem4,gr19,gr20,gr21,gr22,gr23,gr24,gr28,gr3,f3,f2
                from sem
                  inner join sg on (sem2 = sg1)
                  inner join gr on (sg1 = gr2)
                  inner join sp on (sg2 = sp1)
                  inner join f on (sp5 = f1)
                where gr1=:gr1 and sem3=:YEAR and sem5=:SEM
SQL;
            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':gr1', $gr1);
            $command->bindValue(':YEAR', Yii::app()->session['year']);
            $command->bindValue(':SEM', Yii::app()->session['sem']);
            $res = $command->queryRow();
            $course='-';
            $group='-';
            $faculty='-';
            if($res!=null)
            {
                $course=$res['sem4'];
                $group=Gr::model()->getGroupName($res['sem4'], $res);
                $faculty=$res['f3'];
            }
            
            $students = St::model()->getStudentsForJournal($gr1, $us1);
            $dates = R::model()->getDatesForJournal(
                    $us1,
                    $gr1
            );
            $year=(int)Yii::app()->session['year'];
            $first_title='%s семестр %s - %s навчальний рік %s курс';
            $second_title='%s факультет %s група';
            
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
            $sheet->mergeCells('A1:J1');
            $sheet->setCellValue('A1', sprintf($first_title,SH::convertSem5(Yii::app()->session['sem']),$year,($year+1),$course));
            $sheet->mergeCells('K1:Z1');
            $sheet->setCellValue('K1', sprintf($second_title,$faculty,$group));
            //таблица
            $sheet->getColumnDimension('A')->setWidth(4);
            $sheet->mergeCells('A2:A3')->setCellValue('A2','№ з/п')->getStyle('A2')->getAlignment()->setTextRotation(90)-> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $sheet->getColumnDimension('B')->setWidth(30);
            $sheet->mergeCells('B2:B3')->setCellValue('B2','Прізвище, ім`я, по батькові')->getStyle('B2')->getAlignment()-> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $sheet->getRowDimension(2)->setRowHeight(26);
            $sheet->getRowDimension(3)->setRowHeight(93);
            //колонка с фио студентов
            $i=0;
            $count_st=0;
            foreach ($students as $key => $student)
            {
                //$name = ShortCodes::getShortName($student['st2'], $student['st3'], $student['st4']);
                $name = $student['st2'].' '.$student['st3'].' '.$student['st4'];
                $num  = $key+1;
                $sheet->mergeCellsByColumnAndRow(0, $i+ 4, 0, $i+5);
                $sheet->mergeCellsByColumnAndRow(1, $i+ 4, 1, $i+5);
                $sheet->setCellValueByColumnAndRow(0,$i + 4,$num);
                $sheet->setCellValueByColumnAndRow(1,$i + 4,$name)->getStyleByColumnAndRow(1,$i + 4)->getAlignment()->setWrapText(true);
                $i++;
                $i++;
                $count_st++;
            }
            $count_st_column=$i;
            //верх таблицы с датами
            $i=0;
            foreach($dates as $date) {
                $type='';
                switch ($date['priz']) {
                    case 1:
                        $type=tt('Субмодуль');
                        break;
                    case 2:
                        $type=tt('Модуль');
                        break;
                    default:
                        $type=tt('Занятие');
                        break;
                }
                $title='№'.$date['nom'].' '.$date['formatted_date'].' '.$type;
                $sheet->setCellValueByColumnAndRow($i+2,3,$title);
                $sheet->setCellValueByColumnAndRow($i+2,4+$count_st_column,$date['tema']);
                $i++;
            }
            $sheet->mergeCellsByColumnAndRow(2, 2, 1+$i, 2)->setCellValueByColumnAndRow(2, 2,'Дата')->getStyleByColumnAndRow(2, 2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $sheet->getStyleByColumnAndRow(2, 3, 1+$i, 3)->getAlignment()->setWrapText(true)->setTextRotation(90)-> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $sheet->setCellValueByColumnAndRow(1,4+$count_st_column,'Тема')->getStyleByColumnAndRow(1,4+$count_st_column)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $sheet->getStyleByColumnAndRow(2, 4+$count_st_column, 1+$i, 4+$count_st_column)->getAlignment()->setWrapText(true)->setTextRotation(90)-> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $sheet->getRowDimension(4+$count_st_column)->setRowHeight(93);
            $sheet->setCellValueByColumnAndRow(1,5+$count_st_column,'Підпис викладача')->getStyleByColumnAndRow(1,5+$count_st_column)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $sheet->getRowDimension(5+$count_st_column)->setRowHeight(93);
            $i=0;
            $k=0;
            foreach($students as $st) {
                $st1 = $st['st1'];
                $marks = Stegn::model()->getMarksForStudent($st1, $us1);
                $k=0;
                foreach($dates as $key => $date) {
                    $key = $us1.'/'.$date['nom']; // 0 - r3
                    $stegn4 = isset($marks[$key]) && $marks[$key]['stegn4'] != 0
                                ? 'нб'
                                : '';
                    $stegn5 = isset($marks[$key]) && $marks[$key]['stegn5'] != 0
                                ? round($marks[$key]['stegn5'], 1)
                                : '';
                    $stegn6 = isset($marks[$key]) && $marks[$key]['stegn6'] != 0
                                ? round($marks[$key]['stegn6'], 1)
                                : '';
                    if(($stegn6!='')||($stegn4!=''))
                    {
                        if($stegn4!='')
                        {
                            $sheet->setCellValueByColumnAndRow($k+2,$i*2 + 4,$stegn4);
                            $sheet->setCellValueByColumnAndRow($k+2,$i*2 + 5,$stegn6);
                        }else
                        {
                            $sheet->setCellValueByColumnAndRow($k+2,$i*2 + 4,$stegn5);
                            $sheet->setCellValueByColumnAndRow($k+2,$i*2 + 5,$stegn6);
                        }
                    }else
                    {
                        $sheet->mergeCellsByColumnAndRow($k+2, $i*2+ 4, $k+2, $i*2+5);
                        $sheet->setCellValueByColumnAndRow($k+2,$i*2 + 4,$stegn5);
                    }
                    $k++;
                }
                $i++;
            }
            $sheet->getStyleByColumnAndRow(0,1,$k+1,5+$count_st_column)->getBorders()->getAllBorders()->applyFromArray(array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000000')));
            $sheet->setTitle('Jornal '.date('Y-m-d H-i'));

            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);

            // Redirect output to a clientâ€™s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="ACY_JORNAL_'.date('Y-m-d H-i').'.xls"');
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
        }
        Yii::app()->end();
    }
    
    public function actionDeleteRetake()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        $stego1 = Yii::app()->request->getParam('stego1', null);
        $stego2 = Yii::app()->request->getParam('value', null);
        $stego3 = Yii::app()->request->getParam('date', null);
        $stego4 = Yii::app()->request->getParam('p1', null);
        $error=false;
        if(empty($stego1)||empty($stego2)||empty($stego3)||empty($stego4))
            $error=true;
        if(!$error)
        {
            $stegn=Stegn::model()->findByPk($stego1);
            //Stego::model()->deleteAllByAttributes(array('stego1'=>$stego1,'stego2'=>$stego2,'stego3'=>$stego3,'stego4'=>$stego4));
            $command = Yii::app()->db->createCommand();
            $command->delete(Stego::model()->tableName(), 'stego1=:stego1 AND stego2=:stego2 AND stego3=:stego3 AND stego4=:stego4' ,array(':stego1'=>$stego1,':stego2'=>$stego2,':stego3'=>$stego3,':stego4'=>$stego4));
            if(!$error)
            {
                $last_model=Stego::model()->findByAttributes(array('stego1'=>$stego1),array('order'=>'stego3 DESC,stego2 DESC'));
                if($last_model!=null)
                {
                    $stego2=$last_model->stego2;
                }
                else {
                    $stego2=0;
                }
                $stegn->stegn6=$stego2;
                $stegn->save();
            }
            
        }
        $res = array(
            'errors' => $error,
        );
        

        Yii::app()->end(CJSON::encode($res));
    }
    
    public function actionSaveRetake()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        $stego1 = Yii::app()->request->getParam('stego1', null);
        $stego2 = Yii::app()->request->getParam('value', null);
        $stego3 = Yii::app()->request->getParam('date', null);
        $stego4 = Yii::app()->request->getParam('p1', null);
        $error=false;
        if(empty($stego1)||empty($stego2)||empty($stego3)||empty($stego4))
            $error=true;
        if(!$error)
        {

            $stegn=Stegn::model()->findByPk($stego1);
            $ps40=PortalSettings::model()->findByPk(40)->ps2;
            if(! empty($ps40)){
                $date1  = new DateTime(date('Y-m-d H:i:s'));
                $date2  = new DateTime($stegn->stegn9);
                $diff = $date1->diff($date2)->days;
                if ($diff > $ps40)
                {
                    //throw new CHttpException(404, '4Invalid request. Please do not repeat this request again.');
                    $error=true;
                }
            }
            if($stegn->stegn6<=$stegn->getMin()&&!$error)
            {
                $model=new Stego;
                $model->stego1=$stego1;
                $model->stego2=$stego2;
                $model->stego3=$stego3;
                $model->stego4=$stego4;
                $model->stego6=Yii::app()->user->dbModel->p1;
                $model->stego5=date('Y-m-d H:i:s');
                $error=!$model->save();
                if(!$error)
                {
                    $stegn->stegn6=$stego2;
                    $stegn->save();
                }
            }  else {
                $error= true;
            }
            
        }
        $res = array(
            'error' => $error,
        );
        

        Yii::app()->end(CJSON::encode($res));
    }
    
    public function actionAddRetake()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        $stegn0 = Yii::app()->request->getParam('stegn0', null);
        $stegn2 = Yii::app()->request->getParam('disp', null);
        if(empty($stegn0)||empty($stegn2))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        $error=false;
        $stegn=Stegn::model()->findByAttributes(array('stegn0'=>$stegn0));
        $model=new Stego;
        $model->unsetAttributes();
        $model->stego1=$stegn0;
        $html = $this->renderPartial('retake/_add_retake', array(
            'model' => $model,
            'stegn'=>$stegn
        ), true);
        /*$html = $this->render('retake/_add_retake', array(
            'model' => $model,
            'us1'=>$stegn2
        ));*/

        $res = array(
            'title'=>tt('Отработка1'),
            'html' => $html,
            'errors' => $error,
            'show'=>true,
        );

        Yii::app()->end(CJSON::encode($res));
    }
    
    public function actionShowRetake()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        $stegn0 = Yii::app()->request->getParam('stegn0', null);
        $stegn2 = Yii::app()->request->getParam('disp', null);
        if(empty($stegn0)||empty($stegn2))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        $error=false;
        $models=Stego::model()->findAllByAttributes(array('stego1'=>$stegn0));
        
        $html = $this->renderPartial('retake/_show_retake', array(
            'models' => $models,
        ), true);
        $res = array(
            'html'=>$html,
            'errors' => $error,
            'show'=>false,
        );

        Yii::app()->end(CJSON::encode($res));
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
    
    public function actionCheckCountRetake()
    {
        /* if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');*/
        $stegn1 = Yii::app()->request->getParam('st1', null);
        $stegn2 = Yii::app()->request->getParam('us1', null);
        $stegn3 = Yii::app()->request->getParam('nom', null);
        $count=0;
        $error = false;
        if($stegn1==null || $stegn2==null || $stegn3==null)
            $error = true;
        if(!$error)
        {
            $stegn=  Stegn::model()->findByAttributes(array('stegn1'=>$stegn1,'stegn2'=>$stegn2,'stegn3'=>$stegn3)); 
            if($stegn!=null)
            $count=Stego::model()->countByAttributes(array('stego1'=>$stegn->stegn0));
        }
        $count_result=false;
        if($count>0)
            $count_result=true;
        Yii::app()->end(CJSON::encode(array('error' => $error,'count'=>$count_result)));
    }
    
    public function actionInsertStegMark()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        $error=false;
        $stegn1 = Yii::app()->request->getParam('st1', null);
        $r1 = Yii::app()->request->getParam('r1', null);
        $stegn2 = Yii::app()->request->getParam('us1', null);
        $stegn3 = Yii::app()->request->getParam('nom', null);
        $stegn9 = Yii::app()->request->getParam('date', null);
        $field = Yii::app()->request->getParam('field', null);
        $gr1 = Yii::app()->request->getParam('gr1', null);
        $value = Yii::app()->request->getParam('value', null);

        if($stegn1==null || $stegn2==null || $stegn3==null || $field==null || $value==null|| $stegn9==null)
            $error = true;
        else {
            //проверка на достап к процедуре
            $sql = <<<SQL
             SELECT * FROM  EL_GURN_LIST_DISC(:P1,:YEAR,:SEM,0,3,:US1,:R1);
SQL;
            $command = Yii::app()->db->createCommand($sql);

            $command->bindValue(':P1', Yii::app()->user->dbModel->p1);
            $command->bindValue(':US1', $stegn2);
            $command->bindValue(':R1', $r1);
            $command->bindValue(':YEAR', Yii::app()->session['year']);
            $command->bindValue(':SEM', Yii::app()->session['sem']);
            $res = $command->queryRow();
            if(count($res)==0 || empty($res)||$res['dostup']==0)
            {
                //throw new CHttpException(404, '1Invalid request. Please do not repeat this request again.');
                $error=true;
            }

            $whiteList = array(
                'stegn4', 'stegn5','stegn6',
            );
            if (!in_array($field, $whiteList))
               throw new CHttpException(404, '2Invalid request. Please do not repeat this request again.');
            $ps2 = PortalSettings::model()->getSettingFor(27);
            //если тип лекция не можем ничего менять кроме пропусков
            $us=Us::model()->findByPk($stegn2);
            if($us->us4==1&&$field!='stegn4')
                throw new CHttpException(404, '3Invalid request. Please do not repeat this request again.');
            //проверка на разрешение изменения оценок по этому занятию
            $stegr=Stegr::model()->findByAttributes(array('stegr1'=>$gr1,'stegr2'=>$stegn2,'stegr3'=>$stegn9));
            $perm_enable=false;
            if(!empty($stegr))
            {
                if(strtotime($stegr->stegr4)<=strtotime('yesterday'))
                {
                    throw new CHttpException(404, '5Invalid request. Please do not repeat this request again.');
                }else
                {
                    $perm_enable=true;
                }
            }
            //проверка на количество дней после занятия, если прошло больше денй чем указано в настрйоках запрещаем вносить
            if(! empty($ps2) &&!$perm_enable){
                $date1  = new DateTime(date('Y-m-d H:i:s'));
                $date2  = new DateTime($stegn9);
                $diff = $date1->diff($date2)->days;
                if ($diff > $ps2)
                {
                    throw new CHttpException(404, '4Invalid request. Please do not repeat this request again.');
                } 
            }
            $arr=array();
            if ($field == 'stegn4')
            {
                if($value==0)
                {
                    $value=1;
                }
                else {
                    $value=0;
                    $arr=array('stegn6'=>'0');
                } 
            }

            //проверка на макимальный и минимальный бал
            if ($field == 'stegn6'||$field == 'stegn5')
            {
                $min=PortalSettings::model()->findByPk(37)->ps2;
                $bal=PortalSettings::model()->findByPk(36)->ps2;
                if($bal!=0)
                {
                    if($value>$bal||$value<$min)
                        //throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
                        $error=true;
                }
            }
            $errors=array();
            $stegn=  Stegn::model()->findByAttributes(array('stegn1'=>$stegn1,'stegn2'=>$stegn2,'stegn3'=>$stegn3));
            if(!$error)
                if($field=='stegn6' && PortalSettings::model()->findByPk(29)->ps2==1)
                {
                    $error=true;
                }else
                {
                    $isset=false;
                    if($stegn!=null)
                    {
                        $isset=true;
                        //редактируем существующую запись по текущему занятию
                        $attr = array_merge(array(
                            $field => $value,
                            'stegn8' =>  Yii::app()->user->dbModel->p1,
                            'stegn7' =>  date('Y-m-d H:i:s'),
                        ),$arr);
                        $error =!$stegn->saveAttributes($attr);
                    }else
                    {
                        //если нет записи в стегн по этому занятию создаем новую
                        $stegn= new Stegn();
                        $stegn->stegn0=new CDbExpression('GEN_ID(GEN_STEGN, 1)');
                        $stegn->stegn1=$stegn1;
                        $stegn->stegn2=$stegn2;
                        $stegn->stegn3=$stegn3;
                        $stegn->stegn9=$stegn9;
                        $stegn->stegn10=0;
                        $stegn->stegn11='';
                        $stegn->stegn8=Yii::app()->user->dbModel->p1;
                        $stegn->stegn7=date('Y-m-d H:i:s');
                        $stegn->stegn5=0;
                        $stegn->stegn6=0;
                        $stegn->stegn4=0;
                        $stegn->$field=$value;

                        $error =!$stegn->save();
                        if(!$error)
                            $stegn=  Stegn::model()->findByAttributes(array('stegn1'=>$stegn1,'stegn2'=>$stegn2,'stegn3'=>$stegn3));
                    }
                    if(!$error)
                        if($field == 'stegn4'&&$value==0)
                        {
                            //если убираем пропуск удалем все записи с регитрацией пропусвов и отработок по этому занятию

                            Stego::model()->deleteAllByAttributes(array('stego1'=>$stegn->stegn0));
                            Stegnp::model()->deleteAllByAttributes(array('stegnp1'=>$stegn->stegn0));
                        }elseif($field == 'stegn4')
                        {
                            //если ставим пропуск ищем есть ли у нас запись в таблице Stegnp ,если нет создаем
                            $stegnp=Stegnp::model()->findByAttributes(array('stegnp1'=>$stegn->stegn0));
                            if(empty($stegnp))
                            {
                                $stegnp= new Stegnp();
                                $stegnp->stegnp0=new CDbExpression('GEN_ID(GEN_STEGNP, 1)');
                                $stegnp->stegnp1=$stegn->stegn0;
                                $stegnp->stegnp2=0;
                                $stegnp->stegnp7=Yii::app()->user->dbModel->p1;
                                $stegnp->stegnp6=date('Y-m-d H:i:s');
                                $error =!$stegnp->save();
                            }
                        }
                    $errors=$stegn->getErrors();
                }
            
            
            
            //Stegn::model()->insertMark($stegn1,$stegn2,$stegn3,$field,$value,$stegn9);
        }
        Yii::app()->end(CJSON::encode(array('error' => $error, 'errors' => $errors)));
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
            $model->ustem9=Yii::app()->user->dbModel->p1;
            $model->ustem8=date('Y-m-d H:i:s');
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
        $model->ustem9=Yii::app()->user->dbModel->p1;
        $model->ustem8=date('Y-m-d H:i:s');
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
        
        $ustem=Ustem::model()->findByPk($ustem1);
        $ustem2='';
        $ustem3='';
        $ustem4='';
        $ustem5='';
        $ustem6='';
        if(!empty($ustem))
        {
            $ustem2=$ustem->ustem2;
            $ustem3=$ustem->ustem3;
            $ustem4=$ustem->ustem4;
            $ustem5=$ustem->ustem5;
            $ustem6=$ustem->ustem6;
        }

        $deleted = (bool)Ustem::model()->deleteByPk($ustem1);

        $res = array(
            'deleted' => $deleted
        );

        if($deleted)
        {
            $text=P::model()->getTeacherNameBy(Yii::app()->user->dbModel->p1,false);
            $text.=' Ustem1-'.$ustem1.' Ustem2-'.$ustem2.' Ustem3-'.$ustem3.' Ustem4-'.$ustem4.' Ustem5-'.$ustem5.' Ustem6-'.$ustem6;
            $sql = <<<SQL
              INSERT into adz (adz1,adz2,adz3,adz4,adz5,adz6) VALUES (:adz1,:adz2,:adz3,:adz4,:adz5,:adz6);
SQL;
            $command=Yii::app()->db->createCommand($sql);
            $command->bindValue(':adz1', 0);
            $command->bindValue(':adz2', 999);
            $command->bindValue(':adz3', 1);
            $command->bindValue(':adz4', date('Y-m-d H:i:s'));
            $command->bindValue(':adz5', 0);
            $command->bindValue(':adz6', $text);
            $command->execute();

        }

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