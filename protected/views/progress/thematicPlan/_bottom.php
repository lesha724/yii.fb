<?php
/**
 *
 * @var ProgressController $this
 * @var $model FilterForm
 */

if (!empty($model->group)) {
    $us1=$model->group;
    $urlDelete = Yii::app()->controller->createAbsoluteUrl("progress/deleteUstemTheme", array("ustem1" => ''));
    $urlEdit   = Yii::app()->controller->createAbsoluteUrl("progress/renderUstemTheme", array('d1' => $model->discipline,"ustem1" =>''));
    $type0=('Занятие');
    $type1=('Субмодуль');
     Yii::app()->clientScript->registerScript('url_ustem6', <<<JS
        urlDelete       = "{$urlDelete}"
        urlEdit    = "{$urlEdit}"
        type0="{$type0}"
        type1="{$type1}"
JS
    , CClientScript::POS_READY);
    
?>
<div class="row-fluid" >
	
    <h3 class="header smaller lighter blue"><?=tt('Темы занятий')?></h3>
	<button class="btn btn-mini btn-success" name="add-thematic-plan">
        <i class="icon-plus"></i>
        <?=tt('Добавить тематический план')?>
    </button>
<?php $urlInsert   = Yii::app()->controller->createAbsoluteUrl("progress/insertUstemTheme");?>
    <table id="themes" data-us1="<?=$us1?>" data-url="<?=$urlInsert?>" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th><?=tt('№ занятия')?></th>
            <th><?=tt('№ темы')?></th>
            <th><?=tt('Тема')?></th>
            <th><?=tt('Тип')?></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php
                $themes = Ustem::model()->getTheme($us1);

                $html = '';
                $i = 1;
                foreach ($themes as $theme) {

                    $tip = $theme['ustem6'] == 0 ? tt('Занятие') : tt('Субмодуль');
                    $urlDelete = Yii::app()->controller->createAbsoluteUrl("progress/deleteUstemTheme", array("ustem1" => $theme['ustem1']));
                    $urlEdit   = Yii::app()->controller->createAbsoluteUrl("progress/renderUstemTheme", array("ustem1" => $theme['ustem1'], 'd1' => $model->discipline));

                    $html .= <<<HTML
                        <tr>
							<td>$theme[ustem4]</td>
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
<div id="dialog-confirm-add" data-action="<?= Yii::app()->controller->createAbsoluteUrl("progress/addUstemTheme")?>" class="hide" title="Empty the recycle bin?">
	<div class="control-group">
	  <label class="control-label" for="count-rows"><?=tt('Количество занятий')?></label>
	  <div class="controls">
		<input type="number" id="count-rows">
		<span class="help-inline" style="display:none"><?=tt('Введите коректные данные')?></span>
	  </div>
	</div>
</div><!-- #dialog-confirm -->
<?php } ?>