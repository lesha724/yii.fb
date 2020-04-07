<?php
/**
 *
 * @var ProgressController $this
 * @var $model FilterForm
 */

if (!empty($model->group)) {

    list($us1,$us6) = explode("/", $model->group);
    Ustem::model()->recalculation($us1);
    Ustem::model()->addChair($us1);

    $uo4 = Ustem::model()->getDefaultChair($us1);

    $groups = Us::model()->getGroups($us1);

    $hours = Ustem::model()->getHours($us1,0);
    $urlDelete = Yii::app()->controller->createUrl("journal/deleteUstemTheme", array("ustem1" => ''));
    $urlPaste = Yii::app()->controller->createUrl("journal/pasteUstemTheme",array('us1' => $us1));
    $urlEdit   = Yii::app()->controller->createUrl("journal/renderUstemTheme", array('d1' => $model->discipline,"ustem1" =>''));
    $res = CHtml::listData(Ustem::model()->getUstem7Arr(),'rz8','rz8_');
    $selectUstem7= str_replace("\n", ' ', CHtml::dropDownList('',0,$res,array('class'=>'ustem7 select-new-ustem7')));
    $selectUstem6= str_replace("\n", ' ', CHtml::dropDownList('',0,Ustem::model()->getUstem6Arr($us1),array('class'=>'ustem6')));
    $selectUstem11= str_replace("\n", ' ', CHtml::dropDownList('',$uo4,CHtml::listData(Ustem::model()->getUstem11Arr($us1),'nr30','k2'),array('class'=>'ustem11')));
    Yii::app()->clientScript->registerScript('url_ustem6', <<<JS
        urlDelete       = "{$urlDelete}";
        urlEdit    = "{$urlEdit}";
        selectUstem7='{$selectUstem7}';
        selectUstem6='{$selectUstem6}';
        selectUstem11='{$selectUstem11}';
JS
    , CClientScript::POS_READY);
    
?>
<div class="row-fluid">
	
    <!--<h3 class="header smaller lighter blue"><?=tt('Темы занятий')?></h3>-->
	<button class="btn btn-mini btn-success" name="add-thematic-plan">
        <i class="icon-plus"></i>
        <?=tt('Добавить занятия')?>
    </button>
    <!--<button class="btn btn-mini btn-success" name="add-thematic-plan-rasp">
        <i class="icon-plus"></i>
        <?=tt('Добавить занятия c расписания')?>
    </button>-->
    <button class="btn btn-mini btn-primary" name="paste-thematic-plan" href="<?=$urlPaste?>">
        <i class="icon-arrow-right"></i>
        <?=tt('Вставить занятия')?>
    </button>
    <button class="btn btn-mini btn-info" name="copy-thematic-plan">
        <i class="icon-tags"></i>
        <?=tt('Копировать тем. план')?>
    </button>
    <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'button',
            'type'=>'primary',
            'icon'=>'print',
            'label'=>tt('Печать'),
            'htmlOptions'=>array(
                'class'=>'btn-mini',
                'data-url'=>Yii::app()->createUrl('/journal/thematicExcel'),
                'id'=>'thematic-print',
            )
        ));?>
    <?php
        $class="green";
        if($hours!=$us6)
            $class="red";
    ?>
    <h4 class="<?=$class?>"><b><i class="icon-info-sign show-info"></i><i class="icon-double-angle-right"></i><?=tt('Часы по рабочему плану - ').' '.$us6?> / </label><?=tt('Часы по тематическому плану - ').' '.$hours?></b></h4>
    <?php
        if(!empty($groups)){
            $groups_name = '';
            if(count($groups)>=3)
            {
                $group = reset($groups);
                $groups_name.=Gr::model()->getGroupName($group['sem4'], $group);
                $group = next($groups);
                $groups_name.=', '.Gr::model()->getGroupName($group['sem4'], $group);
                $group = end($groups);
                $groups_name.=', ..., '.Gr::model()->getGroupName($group['sem4'], $group);
            }else
            {
                foreach ($groups as $group)
                {
                    if($groups_name!='')
                        $groups_name.=', ';
                    $groups_name.=Gr::model()->getGroupName($group['sem4'], $group);
                }
            }
            echo '<h5 class="blue">'.tt('Группы').': '.$groups_name.'</h5>';
        }
    ?>
    <?php $urlInsert   = Yii::app()->controller->createUrl("journal/insertUstemTheme");?>
    <table id="themes" data-us1="<?=$us1?>" data-url="<?=$urlInsert?>" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="wd-20"><?=Ustem::model()->getAttributeLabel('ustem4')?></th>
            <th><?=Ustem::model()->getAttributeLabel('ustem11')?></th>
            <th class="wd-25"><?=Ustem::model()->getAttributeLabel('ustem7')?></th>
            <th><?=Ustem::model()->getAttributeLabel('ustem3')?></th>
            <th><?=Ustem::model()->getAttributeLabel('ustem5')?></th>
            <th class="wd-25"><?=Ustem::model()->getAttributeLabel('ustem6')?></th>
            <th class="wd-65"></th>
        </tr>
        </thead>
        <tbody>
            <?php
                $themes = Ustem::model()->getTheme($us1);

                $html = '';
                $i = 1;
                foreach ($themes as $theme) {

                    $tip = Ustem::model()->getUstem6($theme['ustem6']);
                    $urlDelete = Yii::app()->controller->createUrl("journal/deleteUstemTheme", array("ustem1" => $theme['ustem1']));
                    $urlEdit   = Yii::app()->controller->createUrl("journal/renderUstemTheme", array("ustem1" => $theme['ustem1'], 'd1' => $model->discipline));
                    $ustem7=round($theme['ustem7'],2);

                    $html .= <<<HTML
                        <tr>
							<td class="td-ustem4">$theme[ustem4]</td>
							<td>$theme[k2]</td>
							<td>$ustem7</td>
							<td>$theme[ustem3]</td>
                            <td>$theme[ustem5]</td>
                            <td>$tip</td>
                            <td>
                                <a href="$urlEdit" class="edit-theme btn btn-mini btn-info">
                                    <i class="icon-edit bigger-120"></i>
                                </a>
                                <a href="$urlDelete" class="delete-theme btn btn-mini btn-danger">
                                    <i class="icon-trash bigger-120"></i>
                                </a>
                            </td>
                        </tr>
HTML;
                    $i++;
                }
                echo $html;
            ?>
        </tbody>
    </table>

    <button class="btn btn-mini btn-danger" name="delete-thematic-plan">
        <i class="icon-trash"></i>
        <?=tt('Удалить тематический план')?>
    </button>
    <?php
        $accept=Ustem::model()->selectAcceptThematicPlan($us1);
        if(!$accept):
    ?>
    <button class="btn btn-mini btn-primary" name="accept-thematic-plan">
        <i class="icon-ok"></i>
        <?=tt('Подтвердить тематический план')?>
    </button>
<?php
        else:
?>
        <label class="label label-primary"><?=tt('План подтвержден')?></label>
<?php
        endif;
?>
</div>

<div id="dialog-confirm" class="hide" title="Empty the recycle bin?">
    <div class="alert alert-info bigger-110">
        <?=tt('Все темы будут удалены')?>
    </div>

    <div class="space-6"></div>

    <p class="bigger-110 bolder center grey">
        <i class="icon-hand-right blue bigger-120"></i>
        <?=tt('Вы уверены?')?>
    </p>
</div><!-- #dialog-confirm -->
<div id="dialog-confirm-accept" class="hide" title="Empty the recycle bin?">
    <div class="alert alert-info bigger-110">
        <?=tt('Подтвердить тем. план')?>
    </div>

    <div class="space-6"></div>

    <p class="bigger-110 bolder center grey">
        <i class="icon-hand-right blue bigger-120"></i>
        <?=tt('Вы уверены?')?>
    </p>
</div><!-- #dialog-confirm -->

<div id="dialog-confirm-add" data-action="<?= Yii::app()->controller->createUrl("journal/addUstemTheme")?>" class="hide" title="Empty the recycle bin?">
	<div class="control-group count-rows-group">
	  <label class="control-label" for="count-rows"><?=tt('Количество занятий')?></label>
	  <div class="controls">
		<input type="number" id="count-rows">
		<span class="help-inline" style="display:none"><?=tt('Введите коректные данные')?></span>
	  </div>
	</div>
    <?php
    $options =  array('autocomplete' => 'off'/*, 'empty' => '&nbsp;'*/);
    ?>
    <div class="control-group">
        <label class="control-label" for="us6-rows"><?=tt('Количество часов за занятие(по умолчанию)')?></label>
        <div class="controls">
            <?=CHtml::dropDownList('us6-rows',0,$res,$options)?>
            <span class="help-inline" style="display:none"><?=tt('Введите коректные данные')?></span>
        </div>
    </div>
</div><!-- #dialog-confirm-add -->

<div id="dialog-confirm-copy" class="hide" data-us1="<?=$us1?>" data-action="<?= Yii::app()->controller->createUrl("journal/copyUstemTheme")?>" title="Empty the recycle bin?">
    <span id="spinner2"></span>
    <div id="copy-theme" data-d1="<?=$model->discipline?>" data-action="<?= Yii::app()->controller->createUrl("journal/copyThemePlanSg")?>">
        <?php
            $this->renderPartial('thematicPlan/_copy', array(
                'discipline'=>$model->discipline,
                'sem' => Yii::app()->session['sem'],
                'year' => Yii::app()->session['year']
            ));
        ?>
    </div>
</div><!-- #dialog-confirm-copy -->
<?php
}
?>