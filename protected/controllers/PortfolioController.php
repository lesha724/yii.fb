<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 16.05.2018
 * Time: 10:33
 */

/**
 * Class PortfolioController
 */
class PortfolioController extends Controller
{
    public function filters() {
        return array(
            'accessControl',
            'checkPermission'
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    'teacher'
                ),
                'expression' => 'Yii::app()->user->isTch || Yii::app()->user->isAdmin',
            ),
            array('allow',
                'actions' => array(
                    'statistic'
                ),
                'expression' => 'Yii::app()->user->isAdmin',
            ),
            array('allow',
                'actions' => array(
                    'student',
                ),
                'expression' => 'Yii::app()->user->isStd || Yii::app()->user->isAdmin',
            ),
            array('allow',
                'actions' => array(
                    'uploadFile',
                    'showFile',
                    'removeFile'
                ),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Дополнительная проверка
     * @param $filterChain
     * @throws CHttpException
     */
    public function filterCheckPermission($filterChain)
    {
        if(PortalSettings::model()->getSettingFor(PortalSettings::USE_PORTFOLIO)==0)
            throw new CHttpException(403, tt('Данный сервис не активный, обратитесь к администратору.'));

        $parh = PortalSettings::model()->getSettingFor(PortalSettings::PORTFOLIO_PATH);
        if(empty($parh))
            throw new CHttpException(403, tt('Не заданы необходимые настройки, обратитесь к администратору.'));

        if(!$this->_checkPath())
            throw new CHttpException(403, tt('Неверные настройки, обратитесь к администратору.'));

        $filterChain->run();
    }

    /**
     *
     */
    public function actionStatistic(){
        $objPHPExcel= new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("ACY")
            ->setLastModifiedBy("ACY ".date('Y-m-d H-i'))
            ->setTitle("Portfolio ".date('Y-m-d H-i'))
            ->setSubject("Portfolio ".date('Y-m-d H-i'))
            ->setDescription("Portfolio statistic, generated using ACY Portal. ".date('Y-m-d H:i:'))
            ->setKeywords("")
            ->setCategory("Portfolio statistic");
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet=$objPHPExcel->getActiveSheet();
        $sheet->setTitle('statistic '.date('Y-m-d H-i'));

        $statistic = Zrst::model()->getListFilesForStatistic();
        $sheet->getColumnDimensionByColumn(0)->setWidth(6);
        $sheet->getColumnDimensionByColumn(1)->setWidth(40);
        $sheet->getColumnDimensionByColumn(2)->setWidth(30);
        $sheet->getColumnDimensionByColumn(3)->setWidth(6);
        $sheet->getColumnDimensionByColumn(4)->setWidth(15);
        $sheet->getColumnDimensionByColumn(5)->setWidth(40);
        $sheet->getColumnDimensionByColumn(6)->setWidth(80);
        $sheet->getColumnDimensionByColumn(7)->setWidth(30);

        $sheet->setCellValueByColumnAndRow(0,2, '№ п/п');
        $sheet->setCellValueByColumnAndRow(1,2,tt('ФИО'));
        $sheet->setCellValueByColumnAndRow(2,2,tt('Факультет'));
        $sheet->setCellValueByColumnAndRow(3,2,tt('Курс'));
        $sheet->setCellValueByColumnAndRow(4,2,tt('Группа'));
        $sheet->setCellValueByColumnAndRow(5,2,tt('Файл'));
        $sheet->setCellValueByColumnAndRow(6,2,tt('Тип'));
        $sheet->setCellValueByColumnAndRow(7,2,tt('Пояснение'));

        $i=3;
        foreach ($statistic as $file) {
            $sheet->setCellValueByColumnAndRow(0,$i, $i-2);
            $sheet->setCellValueByColumnAndRow(1,$i, $file['pe2'] .' '. $file['pe3'] . ' '. $file['pe4']);
            $sheet->setCellValueByColumnAndRow(2,$i,$file['f3']);
            $sheet->setCellValueByColumnAndRow(3,$i,$file['std20']);
            $sheet->setCellValueByColumnAndRow(4,$i,$file['gr3']);
            $sheet->setCellValueByColumnAndRow(5,$i,Yii::app()->createAbsoluteUrl('/portfolio/showFile/'.$file['zrst1']));
            $sheet->setCellValueByColumnAndRow(6,$i,$file['zrst4'] == 4 ? 'Участие в спортивных, творческих и культурно-массовых мероприятиях' : 'Документы, подтверждающие участие в научно-исследовательской деятельности');
            $sheet->setCellValueByColumnAndRow(7,$i,$file['zrst7']);
            $i++;
        }

        $sheet->getStyleByColumnAndRow(0,2,8,$i-1)->getBorders()->getAllBorders()->applyFromArray(array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000000')));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a clientâ€™s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="ACY_PORTFOLIO_STATISTIC_'.date('Y-m-d H-i').'.xls"');
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

    /**
     *
     * @throws CHttpException
     */
    public function actionStudent()
    {
        $model = new TimeTableForm;
        $model->scenario = 'student';

        if (Yii::app()->user->isAdmin) {
            $params = array();
            if (!isset($_REQUEST['TimeTableForm'])) {
                if (isset(Yii::app()->session['portfolio-filter'])){
                    $params=Yii::app()->session['portfolio-filter'];
                }
            }
            else{
                $params = $_REQUEST['TimeTableForm'];
            }
            $model->attributes = $params;
            Yii::app()->session['portfolio-filter']=$params;

        } elseif (Yii::app()->user->isStd) {

            $model->student = Yii::app()->user->dbModel->st1;
        } else
            throw new CHttpException(404, 'You don\'t have an access to this service');

        $this->render('student', array(
            'model'=>$model,
        ));
    }

    /**
     * @throws CHttpException
     */
    public function actionTeacher()
    {
        $model = new FilterForm();
        $model->scenario = 'portfolio-teacher';

        $params = array();
        if (!isset($_REQUEST['FilterForm'])) {
            if (isset(Yii::app()->session['portfolio-teacher-filter'])){
                $params=Yii::app()->session['portfolio-teacher-filter'];
            }
        }
        else{
            $params = $_REQUEST['FilterForm'];
        }
        $model->attributes = $params;
        Yii::app()->session['portfolio-teacher-filter']=$params;

        if (Yii::app()->user->isAdmin) {


        } elseif (Yii::app()->user->isTch) {

            $model->teacher = Yii::app()->user->dbModel->p1;
        } else
            throw new CHttpException(404, 'You don\'t have an access to this service');

        $this->render('teacher', array(
            'model'=>$model
        ));
    }

    /**
     * Проыерка существования директории
     * @return bool
     */
    private function _checkPath(){
        $path = PortalSettings::model()->getSettingFor(PortalSettings::PORTFOLIO_PATH);

        if(empty($path))
            return false;

        return is_dir($path);
    }

    /**
     * Проверка доступа к файлу для
     * @param Zrst $zrst
     * @param int $accessLevel 0 - чтение, 1 - редактирование
     * @return bool
     */
    private function _checkPermissionUserForFile($zrst, $accessLevel = 0){
        if(Yii::app()->user->isAdmin)
            return true;

        if(Yii::app()->user->isStd) {
            if($accessLevel == 0)
                return $zrst->zrst2 == Yii::app()->user->dbModel->st1;
            else
                return $zrst->zrst2 == Yii::app()->user->dbModel->st1 && $zrst->zrst6 == 0;
        }

        if(Yii::app()->user->isTch){
            if($accessLevel == 0)
                return true;
            else

                return $zrst->checkAccessForTeacher(Yii::app()->user->dbModel->p1);
        }

        return false;
    }

    /**
     * Удаление файла
     * @param $id
     * @throws CDbException
     * @throws CHttpException
     */
    public function actionRemoveFile($id){
        $model=$this->_loadModel($id);

        if(!$this->_checkPermissionUserForFile($model, 1))
            throw new CHttpException(403,'You don\'t have an access to this service.');

        $fileName = PortalSettings::model()->getSettingFor(PortalSettings::PORTFOLIO_PATH).'/'.$id.'.'.$model->zrst8;

        if(!file_exists($fileName))
            throw new CHttpException(400,tt('Файл не существует или удален.'));

        try {
            if ($model->delete()) {
                unlink($fileName);
            } else {
                throw  new Exception('Ошибка');
            }

            Yii::app()->user->setFlash('success', 'Файл успешно удален');

        }catch (Exception $error){
            Yii::app()->user->setFlash('error', 'Ошибка удаления файла '. $error);
        }

        $this->_redirect($model->zrst6 == 0 ? 'student' : 'teacher');
    }

    private function _redirect($actionForAdmin = ''){
        $url = !Yii::app()->user->isAdmin ?
            (

                Yii::app()->user->isStd ? 'student' : 'teacher'
            ) :
            (
                empty($actionForAdmin) ? 'teacher': $actionForAdmin
            );

        $this->redirect('/portfolio/'.$url);
    }

    /**
     * Экшен отображения файла
     * @param $id
     * @throws CHttpException
     */
    public function actionShowFile($id){
        $model=$this->_loadModel($id);

        if(!$this->_checkPermissionUserForFile($model, 0))
            throw new CHttpException(403,'You don\'t have an access to this service.');

        $fileName = PortalSettings::model()->getSettingFor(PortalSettings::PORTFOLIO_PATH).'/'.$id.'.'.$model->zrst8;

        if(!file_exists($fileName))
            throw new CHttpException(400,tt('Файл не существует или удален.'));

        header('Content-Type: application/'.$model->zrst8);
        header('Content-Disposition: inline; filename="'.basename($fileName).'"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        header('Content-Length: ' . filesize($fileName));
        @readfile($fileName);
        exit;
    }

    /**
     * @param $id
     * @return Zrst|null
     * @throws CHttpException
     */
    private function _loadModel($id)
    {
        $model=Zrst::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Загрузка файла
     * @param $type
     * @param $id
     * @param int $us1
     * @throws CHttpException
     */
    public function actionUploadFile($type, $id, $us1 = 0){
        if(!in_array($type, array(
            CreateZrstForm::TYPE_TABLE1,
            CreateZrstForm::TYPE_TABLE2,
            CreateZrstForm::TYPE_TABLE3,
            CreateZrstForm::TYPE_TABLE4,
            CreateZrstForm::TYPE_TABLE5,
            CreateZrstForm::TYPE_TEACHER
        )))
            throw new CHttpException(400, 'Bad request');

        if(in_array($type, array(
            CreateZrstForm::TYPE_TABLE2,
            CreateZrstForm::TYPE_TABLE3,
            CreateZrstForm::TYPE_TABLE4,
            CreateZrstForm::TYPE_TABLE5
        )))
            $us1 = 0;

        $model = new CreateZrstForm($type);

        if(isset($_POST['CreateZrstForm']))
        {
            $model->attributes=$_POST['CreateZrstForm'];
            $model->st1 = $id;
            $model->us1 = $us1;
            $model->file=CUploadedFile::getInstance($model,'file');

            if ($model->validate()) {

                try {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', 'Файл успешно добавлен');
                    } else {
                        Yii::app()->user->setFlash('error', 'Ошибка добавления файла1');
                    }
                }catch (CException $error){
                    Yii::app()->user->setFlash('error', 'Ошибка добавления файла '. $error);
                }
                $this->_redirect($model->scenario == CreateZrstForm::TYPE_TEACHER ? 'teacher' : 'student');
            }
        }

        $this->render('upload',array('model'=>$model));
    }
}