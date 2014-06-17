<?php
/**
 *
 * @var DefaultController $this
 */

    $this->pageHeader=tt('Отображение пунктов меню');
    $this->breadcrumbs=array(
        tt('Админ. панель'),
    );

    Yii::app()->clientScript->registerPackage('nestable');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/menu.js');

?>

<button type="button" class="btn btn-info btn-small save-form">
    <i class="icon-ok bigger-110"></i>
    <?=tt('Сохранить')?>
</button>

<form id="menu" method="post">
    <?php
        $this->renderPartial('menu/_block', array(
            'name'       => 'Абитуриент',
            'controller' => 'entrance',
            'items' => array(
                'documentReception' => 'Ход приема документов',
                'rating'            => 'Рейтинговый список',
            ),
            'settings' => $settings
        ));
    ?>
</form>
