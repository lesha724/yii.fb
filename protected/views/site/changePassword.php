<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form TbActiveForm  */

?>

<div class="login-container ">
    <div class="row-fluid">
        <div class="position-relative">
            <div id="changePassword-box" class="changePassword-box visible widget-box no-border">
                <div class="widget-body">
                    <div class="widget-main">
                        <div id="replace-there">
                        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id'=>'changePassword-form',
                            'type' => 'horizontal',
                            'action' => Yii::app()->createUrl("site/changePassword")
                        )); ?>
                            <fieldset>
                                <label>
                                    <span class="block input-icon input-icon-right">
                                        <?=$form->textFieldRow($model, 'u2', array('class' => 'span12', 'placeholder' => tt('Login')))?>
                                        <i class="icon-user"></i>
                                    </span>
                                </label>

                                <label>
                                    <span class="block input-icon input-icon-right">
                                        <?=$form->textFieldRow($model, 'u4', array('class' => 'span12', 'placeholder' => tt('Email')))?>
                                        <i class="icon-envelope"></i>
                                    </span>
                                </label>

                                <label>
                                    <span class="block input-icon input-icon-right">
                                        <?=$form->passwordFieldRow($model, 'u3', array('class' => 'span12', 'placeholder' => tt('Пароль')))?>
                                        <i class="icon-lock"></i>
                                    </span>
                                </label>

                                <label>
                                    <span class="block input-icon input-icon-right">
                                        <?=$form->passwordFieldRow($model, 'password', array('class' => 'span12', 'placeholder' => tt('Повторите пароль')))?>
                                        <i class="icon-lock"></i>
                                    </span>
                                </label>

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
