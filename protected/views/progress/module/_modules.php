<?php
/**
 * @var ProgressController $this
 * @var ModuleForm $model
 * @var $modules Modgr[]
 */

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => new CArrayDataProvider($modules, array(
        'keyField' => 'modgr1'
    )),
    'rowHtmlOptionsExpression' => 'array("data-id"=>$data->modgr1, "data-module"=>$data->modgr2)',
    'type' => 'striped bordered',
    'columns' => array(
        array(
            'header' => Mod::model()->getAttributeLabel('mod5'),
            'type' => 'raw',
            'value' => function ($data){
                /**
                 * @var $data Modgr
                 */
                return CHtml::textField('name-'.$data->modgr1, $data->module->mod5, array(
                    'class' => 'input-module-name'
                ));
            }
        ),
        array(
            'header' => Mod::model()->getAttributeLabel('mod6'),
            'type' => 'raw',
            'value' => function ($data){
                /**
                 * @var $data Modgr
                 */
                return CHtml::numberField('max-'.$data->modgr1, $data->module->mod6, array(
                    'class' => 'input-module-max'
                ));
            }
        ),
        array(
            'header' => Mod::model()->getAttributeLabel('mod7'),
            'type' => 'raw',
            'value' => function ($data){
                /**
                 * @var $data Modgr
                 */
                return CHtml::dateField('max-'.$data->modgr1, $data->module->mod7, array(
                    'class' => 'input-module-date-start'
                ));
            }
        ),
        array(
            'header' => Mod::model()->getAttributeLabel('mod8'),
            'type' => 'raw',
            'value' => function ($data){
                /**
                 * @var $data Modgr
                 */
                return CHtml::dateField('max-'.$data->modgr1, $data->module->mod8, array(
                    'class' => 'input-module-date-start'
                ));
            }
        ),
        array(
            'header' => Modgr::model()->getAttributeLabel('modgr4'),
            'value' => function ($data){
                /**
                 * @var $data Modgr
                 */
                if(empty($data->modgr4))
                    return '';
                $teacher = Pd::model()->getTeacherAndChairByPd1($data->modgr4);
                if(empty($teacher))
                    return '';

                return SH::getShortName($teacher['p3'], $teacher['p4'], $teacher['p5']);
            }
        ),
        array(
            'header' => Modgr::model()->getAttributeLabel('modgr5'),
            'value' => function ($data){
                /**
                 * @var $data Modgr
                 */
                if(empty($data->modgr5))
                    return '';
                $teacher = Pd::model()->getTeacherAndChairByPd1($data->modgr5);
                if(empty($teacher))
                    return '';

                return SH::getShortName($teacher['p3'], $teacher['p4'], $teacher['p5']);
            }
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{select}',
            'buttons'=>array
            (
                'select' => array(
                    'label'=>tt('Выбрать модуль'),
                    'icon'=>'icon-check bigger-120',
                    'url'=>'#',
                    'options' => array(
                        'class' => 'btn btn-mini btn-warning btn-select-module'),
                ),
            ),
        )
    )
));