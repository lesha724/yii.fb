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
        if (! SH::checkServiceFor(MENU_ELEMENT_VISIBLE, Yii::app()->controller->id, $action->id, true))
            throw new CHttpException(500, tt('Сервис временно недоступен!'));

        if (! SH::checkServiceFor(MENU_ELEMENT_NEED_AUTH, Yii::app()->controller->id, $action->id, true))
            throw new CHttpException(500, tt('Сервис доступен только для авторизированных пользователей!'));

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

        return parent::beforeAction($action);
    }
}