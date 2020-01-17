<?php
/* @var $this SiteController */
/* @var $model CancelRegistrationForm */
/* @var $form TbActiveForm  */

$this->pageTitle = tt('Отмена регистрации');
$this->pageHeader=$this->pageTitle;
?>

<div class="login-container ">
    <div class="row-fluid">
        <div class="position-relative">
            <div id="login-box" class="login-box visible widget-box no-border">
                <div class="widget-body">
                    <div class="widget-main">
                        <h5 class="header blue lighter bigger">
                            <i class="icon-coffee green"></i>
                            <?=tt('Укажите необходимую информацию')?>
                        </h5>

                        <div class="space-6"></div>
                        <div id="replace-there">
                        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id'=>'cancel-registration-form',
                            'type' => 'horizontal',
                        )); ?>
                            <fieldset>
                                <?=$form->textFieldRow($model, 'inn')?>
                                <?=$form->textFieldRow($model, 'lastName')?>
                                <?=$form->textFieldRow($model, 'firstName')?>
                                <?=$form->textFieldRow($model, 'secondName')?>
                                <?=$form->textFieldRow($model, 'passportNumber')?>

                                <?php
                                if(CCaptcha::checkRequirements()): ?>
                                    <div class="form-group">
                                        <div>
                                            <?php $this->widget('CCaptcha'); ?>
                                            <?php echo $form->textField($model,'verifyCode'); ?>
                                        </div>
                                        <?php echo $form->error($model,'verifyCode'); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="space"></div>

                                <div class="clearfix">
                                    <button class="btn btn-small btn-warning" type="submit">
                                        <?=tt('Отменить регистрацию')?>
                                    </button>
                                </div>

                                <div class="space-4"></div>
                            </fieldset>
                        <?php $this->endWidget(); ?>
                        </div>
                    </div><!-- /widget-main -->

                </div><!-- /widget-body -->
            </div><!-- /login-box -->
        </div><!-- /position-relative -->
    </div>
</div>
<?php
