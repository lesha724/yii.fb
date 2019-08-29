<?php
/**
 * Created by PhpStorm.
 * User: Lesha
 * Date: 29.08.2019
 * Time: 10:49
 */

/**
 * @var $st St
 * @var $gr1 int
 */

$opprezList = Oprrez::model()->getByStudent($st->st1);
$oprList = Opr::model()->findAll();

if(count($opprezList) == 0):
     $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'quiz-form',
            )); ?>
            <fieldset>

                <?php
                    foreach ($oprList as $opr){

                    }
                ?>

                <div class="space"></div>

                <div class="clearfix">
                    <button  data-loading-text="Loading..." class="pull-left btn btn-small btn-primary" type="submit">
                        <i class="icon-ok"></i>
                        <?=tt('Сохранить')?>
                    </button>
                </div>
            </fieldset>
        <?php $this->endWidget();
else:

endif;


