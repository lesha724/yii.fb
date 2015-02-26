<?php
/**
 * @var Aap $model
 */
?>

<div class="widget-box">
    <div class="widget-header widget-header-blue widget-header-flat">
        <h4 class="lighter"><?=tt('Регистрация абитуриента в приемной комиссии')?></h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <div class="row-fluid">
                <div id="fuelux-wizard" class="row-fluid" data-target="#step-container">
                    <?php
                        $this->renderPartial('registration/_steps', array(
                            'steps' => array(
                                'Личные данные',
                                'Данные абитуриента',
                                'Документ, подтверждающий личность',
                                'Адрес',
                                'Документ об образовании'
                            ))
                        );
                    ?>
                </div>
                <hr />
                <div class="step-content row-fluid position-relative" id="step-container">
                    <?php
                        $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'validation-form',
                            'htmlOptions' => array('class' => 'form-horizontal')
                        ));
                        $pattern = <<<HTML
    <div class="control-group">
        %s
        <div class="controls">
            <div class="span12">
                %s
            </div>
        </div>
    </div>
HTML;
                        $labelOptions = array(
                            'class' => 'control-label'
                        );
                        $inputOptions = array(
                        'class' => 'span6'
                    );

                        $stepVariables =  array(
                            'form'         => $form,
                            'model'        => $model,
                            'pattern'      => $pattern,
                            'labelOptions' => $labelOptions,
                            'inputOptions' => $inputOptions,
                        );
                    ?>

                        <?php $this->renderPartial('registration/_step_1', $stepVariables)?>

                        <?php $this->renderPartial('registration/_step_2', $stepVariables)?>

                        <?php $this->renderPartial('registration/_step_3', $stepVariables)?>

                        <?php $this->renderPartial('registration/_step_4', $stepVariables)?>

                        <?php $this->renderPartial('registration/_step_5', $stepVariables)?>

                    <?php $this->endWidget(); ?>
                </div>
                <hr />
                <div class="row-fluid wizard-actions">
                    <button class="btn btn-prev">
                        <i class="icon-arrow-left"></i>
                        <?=tt('Пред.')?>
                    </button>

                    <button class="btn btn-success btn-next" data-last="Finish ">
                        <?=tt('След.')?>
                        <i class="icon-arrow-right icon-on-right"></i>
                    </button>
                </div>
            </div>
        </div><!-- /widget-main -->
    </div><!-- /widget-body -->
</div>
