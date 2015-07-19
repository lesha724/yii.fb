<?php
/* @var $this ProgressController
 * @var $model FilterForm
 */
    $this->pageHeader=tt('Тестирование');
    $this->breadcrumbs=array(
        tt('Успеваемость'),
    );
?>

<?php
     Yii::app()->clientScript->registerScript('translations', <<<JS
       initPopovers();
JS
    , CClientScript::POS_READY);
    
    $this->renderPartial('test/index', array('model' => $model));
