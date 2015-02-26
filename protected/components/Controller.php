<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public $pageHeader = '';

    public function init()
    {
        ELangPick::setLanguage();
        parent::init();
    }


    public function beforeAction($action)
    {
        $this->processAccess($action);

        $this->processYearAndSem();

        $this->processDate1AndDate2();

        return parent::beforeAction($action);
    }

    private function processAccess($action)
    {
        if (! SH::checkServiceFor(MENU_ELEMENT_VISIBLE, Yii::app()->controller->id, $action->id, true))
            throw new CHttpException(500, tt('Сервис временно недоступен!'));

        if (! SH::checkServiceFor(MENU_ELEMENT_NEED_AUTH, Yii::app()->controller->id, $action->id, true))
            if (Yii::app()->user->isGuest)
                throw new CHttpException(500, tt('Сервис доступен только для авторизированных пользователей!'));

        if (! SH::checkServiceFor(MENU_ELEMENT_VISIBLE, Yii::app()->controller->id, 'main', true))
            throw new CHttpException(404, tt('Сервис закрыт!'));
    }

    private function processYearAndSem()
    {
        $year = Yii::app()->request->getParam('year', null);
        if ($year === null)
            $year = Yii::app()->session['year'];
        if ($year === null)
            $year = date('Y');

        Yii::app()->session['year'] = $year;

        $sem = Yii::app()->request->getParam('sem', null);

        if ($sem === null)
            $sem = Yii::app()->session['sem'];
        if ($sem === null)
            $sem = date('n')>=8 ? 0 : 1;

        Yii::app()->session['sem']  = $sem;
    }

    private function processDate1AndDate2()
    {
        $date1 = isset($_REQUEST['TimeTableForm']['date1']) ? $_REQUEST['TimeTableForm']['date1'] : null;
        if ($date1 === null)
            $date1 = Yii::app()->session['date1'];
        if ($date1 === null)
            $date1 = date('d.m.Y');

        Yii::app()->session['date1'] = $date1;


        $date2 = isset($_REQUEST['TimeTableForm']['date2']) ? $_REQUEST['TimeTableForm']['date2'] : null;
        if ($date2 === null)
            $date2 = Yii::app()->session['date2'];
        if ($date2 === null)
            $date2 = date('d.m.Y', strtotime('+7 week', strtotime($date1)));


        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);
        $interval = $datetime1->diff($datetime2);

        if ($interval->days >= 100)
            $date2 = date('d.m.Y', strtotime('+7 week', strtotime($date1)));

        Yii::app()->session['date2'] = $date2;
    }
}