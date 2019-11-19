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
    'id' => 'modules',
    'htmlOptions' => array(
        'data-url' => Yii::app()->createUrl('progress/changeField')
    ),
    'rowHtmlOptionsExpression' => 'array("data-id"=>$data->modgr1, "data-module"=>$data->modgr2)',
    'type' => 'striped bordered',
    'columns' => array(
        'module.mod3',
        array(
            'header' => Mod::model()->getAttributeLabel('mod5'),
            'type' => 'raw',
            'value' => function ($data){
                /**
                 * @var $data Modgr
                 */
                return CHtml::textField('name-'.$data->modgr1, $data->module->mod5, array(
                    'class' => 'input-module-name input-module',
                    'data-field' => 'mod5',
                    'style' => 'margin-bottom:0px'
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
                    'class' => 'input-module-max input-module',
                    'data-field' => 'mod6',
                    'style' => 'margin-bottom:0px'
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
                $date = $data->module->mod7;

                return CHtml::dateField('start-'.$data->modgr1, empty($date) ? '' : date('Y-m-d',strtotime($date)), array(
                    'class' => 'input-module-date-start input-module',
                    'data-field' => 'mod7',
                    'style' => 'margin-bottom:0px'
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
                $date = $data->module->mod8;

                return CHtml::dateField('end-'.$data->modgr1, empty($date) ? '' : date('Y-m-d',strtotime($date)), array(
                    'class' => 'input-module-date-start input-module',
                    'data-field' => 'mod8',
                    'style' => 'margin-bottom:0px'
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
        )
    )
));