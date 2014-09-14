<?php
/* @var $this SiteController */
/* @var $model ForgotPasswordForm */
/* @var $form CActiveForm  */

?>

<div class="login-container ">
    <div class="row-fluid">
        <div class="position-relative">
            <div class="forgot-box widget-box no-border visible" id="forgot-box">
                <div class="widget-body">
                    <div class="widget-main">
                        <h4 class="header red lighter bigger">
                            <i class="icon-key"></i>
                            <?=tt('Восстановление пароля')?>
                        </h4>

                        <div class="space-6"></div>
                        <p>
                            <?=tt('Введите свой email')?>
                        </p>

                        <div id="replace-there">
                            <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'forgot-password-form',
                                'action' => Yii::app()->createUrl("site/forgotPassword")
                            )); ?>
                            <fieldset>
                                <label>
                                    <span class="block input-icon input-icon-right">
                                        <?=$form->textField($model, 'email', array('class' => 'span12', 'placeholder' => 'Email'))?>
                                        <?=$form->error($model, 'email')?>
                                        <i class="icon-envelope"></i>
                                    </span>
                                </label>

                                <div class="clearfix">
                                    <button data-loading-text="Loading..." class="width-35 pull-right btn btn-small btn-danger" type="submit">
                                        <i class="icon-lightbulb"></i>
                                        <?=tt('Отправить')?>
                                    </button>
                                </div>
                            </fieldset>
                            <?php $this->endWidget(); ?>
                        </div>
                    </div><!-- /widget-main -->

                </div><!-- /widget-body -->
            </div>
        </div><!-- /position-relative -->
    </div>
</div>
