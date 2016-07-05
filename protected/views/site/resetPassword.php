<?php
/* @var $this SiteController */
/* @var $model ResetPasswordForm */
/* @var $form TbActiveForm  */
$this->pageTitle=tt('Востановление пароля');
$this->pageHeader=tt('Востановление пароля');
?>

<div class="login-container ">
    <div class="row-fluid">
        <div class="position-relative">
            <div id="changePassword-box" class="changePassword-box visible widget-box no-border">
                <div class="widget-body">
                    <div class="widget-main">
                        <div id="replace-there">
                        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id'=>'resetPassword-form',
                            //'type' => 'horizontal',
                            )); ?>
                            <fieldset>

                                <label>
                                    <span class="block input-icon input-icon-right">
                                        <?=$form->passwordFieldRow($model, 'password', array('class' => 'span12', 'placeholder' => tt('Пароль')))?>
                                        <i class="icon-lock"></i>
                                    </span>
                                </label>

                                <label>
                                    <span class="block input-icon input-icon-right">
                                        <?=$form->passwordFieldRow($model, 'repeatPassword', array('class' => 'span12', 'placeholder' => tt('Повторите ароль')))?>
                                        <i class="icon-lock"></i>
                                    </span>
                                </label>

                                <?php if(CCaptcha::checkRequirements()): ?>
                                    <div class="form-group">
                                        <?php /*$form->labelEx($model,'verifyCode'); */?>
                                        <div>
                                            <?php $this->widget('CCaptcha'); ?>
                                            <?php echo $form->textField($model,'verifyCode'); ?>
                                        </div>
                                        <?php echo $form->error($model,'verifyCode'); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="space"></div>

                                <div class="clearfix">
                                    <button  data-loading-text="Loading..." class="width-35 pull-right btn btn-small btn-primary" type="submit">
                                        <i class="icon-ok"></i>
                                        <?=tt('Сохранить')?>
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
