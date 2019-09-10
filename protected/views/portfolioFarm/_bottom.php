<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 04.02.2019
 * Time: 13:22
 */


/**
 * @var $this PortfolioFarmController
 * @var St $student
 * @var TimeTableForm $model
 */

/**
 * @param $code
 * @param $st1
 * @return mixed|string
 * @throws Exception
 */
function grid($code, $st1){

    $dataProvider = new CArrayDataProvider(
        Stpfile::model()->findAllBySql(
            <<<SQL
                      SELECT stpfile.* from stpfile
                        INNER JOIN stpfieldfile on (stpfieldfile1=:codeM and stpfieldfile2 = stpfile1)
                      where stpfile5 = :stpfile5
SQL
            ,array(
                ':codeM' => $code,
                ':stpfile5' => $st1
            )
        ),
        array(
            'keyField'=>'stpfile1',
            'sort'=>false,
            'pagination'=>false
        )
    );

    $html = Yii::app()->controller->widget('bootstrap.widgets.TbGridView', array(
        'dataProvider' => $dataProvider,
        'filter' => null,
        'type' => 'striped bordered',
        'columns' => array(
            array(
                'name' => 'stpfile2',
                'header' => tt('Файл'),
                'value' => 'basename($data->stpfile2)'
            ),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{view} {delete}',
                'buttons'=>array(
                    'delete' => array
                    (
                        'url'=>'array("/portfolioFarm/deleteFile","id"=>$data->stpfile1)',
                    ),
                    'view' => array
                    (
                        'url'=>'array("/portfolioFarm/file","id"=>$data->stpfile1)',
                    ),
                ),
            ),
        )
    ), true);

    $html .= CHtml::link(tt('Добавить'), Yii::app()->createUrl('/portfolioFarm/uploadFile', array('id'=>$code, 'st1'=> $st1, 'type' => 'field')), array('class'=>'btn-mini btn btn-create-file'));

    return $html;
}

/**
 * @param $number string номер
 * @param $st1 int
 * @param $code int
 * @param $name string
 * @param $needFile bool
 * @param $inputType string
 * @param $value string
 * @return string
 * @throws Exception
 */
function renderField($number, $st1, $code, $name, $needFile, $inputType, $value = ''){
    $html = CHtml::openTag('ol');
    $html .= CHtml::tag('strong', array(), $number);
    $html .= CHtml::openTag('div', array(
        'class' => 'control-group'
    ));
    $html .= CHtml::label($name,'field-'.$code, array(
        'class' => 'control-label'
    ));
    $html .= CHtml::$inputType('field-'.$code, $value, array(
        'class' => 'field-input',
        'data-id' => $code
    ));
    $html .= CHtml::closeTag('div');
    if($needFile) {
        $html .= CHtml::openTag('div', array(
            'class' => 'file-control-group'
        ));

        $html .= '<div class="form-actions">';
        $html .= grid($code, $st1);
        $html .= '</div>';

        $html .= CHtml::closeTag('div');
    }
    $html .= CHtml::closeTag('ol');
    return $html;
}

Yii::app()->clientScript->registerCss('portfolioFarm', <<<CSS
    .control-group textarea{
        width: 500px;
        height: 80px;
    }
CSS
    );

$url = Yii::app()->createUrl('/portfolioFarm/changeField');
$spinner1 = '$spinner1';

Yii::app()->clientScript->registerScript('portfolioFarm', <<<JS
    var successFieldMessage = 'Изменение сохранено';
    
    $('.field-input').change(function(event) {
        
        var url = '{$url}';
        
        var parentControl = $(this).closest('.control-group');
        
        var params = {
            st1:{$model->student},
            id: $(this).data('id'),
            value:$(this).val()
        };
        $spinner1.show();
        $.ajax({
            type: 'POST',
            url:  url,
            data: params,
            dataType: 'json',
            success: function(data) {
                addGritter('', successFieldMessage, 'success');
                $spinner1.hide();
                parentControl.removeClass('error');
                parentControl.addClass('success');
            },
            error: function(jqXHR, textStatus, errorThrown){
                addGritter('', textStatus + ':'+ jqXHR.responseText, 'error');
                $spinner1.hide();
                parentControl.removeClass('success');
                parentControl.addClass('error');
            }
        });
    });
JS
   , CClientScript::POS_END );

$block = Stpblock::model()->findByPk($student->st1);
if($block){
    Yii::app()->clientScript->registerCss('block-st', <<<CSS
        .btn-create-file, .field-input{
            pointer-events: none;
            opacity: 0.6;
        }
CSS
    );
    ?>
    <div class="alert alert-warning">
        <?=tt('Данный студент заблокирован для изменений. Пользователь {userName} {date}', array(
            '{userName}' => $block->stpblock20->getName(),
            '{date}' => $block->stpblock3
        ))?>
    </div>
    <?php
}

if(Yii::app()->user->isTch){
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'link',
        'type'=>!$block ? 'success' : 'warning',
        'url' => Yii::app()->createUrl(!$block ? '/portfolioFarm/block' : '/portfolioFarm/unblock', array('id' => $model->student)),
        'icon'=>!$block ? 'ok' : 'remove',
        'label'=>!$block ? tt('Заблокировать') : tt('Отменить блокировку') ,
    ));
}

$fields = Stportfolio::model()->getFieldsList($student->st1);

echo '<div class="page-header">
  <h3>1. РЕЗЮМЕ</h3>
</div>';

$this->renderPartial('_stInfo', array(
    'student' => $student,
    'model' => $model,
));

echo CHtml::openTag('ul');


$field = $fields[Stportfolio::FIELD_EXTRA_EDUCATION];
echo renderField('',$student->st1, $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_WORK_EXPERIENCE];
echo renderField('',$student->st1, $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_PHONE];
echo renderField('',$student->st1, $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_EMAIL];
echo renderField('',$student->st1, $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

echo CHtml::closeTag('ul');


echo '<div class="page-header">
  <h3>2. ПОРТФОЛІО ДОСЯГНЕНЬ</h3>
</div>';

echo CHtml::openTag('ul');


echo CHtml::openTag('ol');
echo CHtml::tag('strong', array(), '2.1');
echo CHtml::label('Навчально-професійна діяльність', '');
Yii::app()->controller->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => Stpwork::model()->search($model->student),
    'filter' => null,
    'type' => 'striped bordered',
    'columns' => array(
        'stpwork3',
        'stpwork4',
        'stpwork5',
        'stpwork6',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
            'buttons'=>array(
                'delete' => array
                (
                    'url'=>'array("/portfolioFarm/deleteStpwork","id"=>$data->stpwork1)',
                ),
                'update' => array
                (
                    'url'=>'array("/portfolioFarm/updateStpwork","id"=>$data->stpwork1)',
                ),
            ),
        ),
    )
));
echo CHtml::link(tt('Добавить'), Yii::app()->createUrl('/portfolioFarm/addStpwork', array( 'id'=> $model->student)), array('class'=>'btn-mini btn'));
echo CHtml::closeTag('ol');

$field = $fields[Stportfolio::FIELD_EXTRA_COURSES];
echo renderField('2.2', $student->st1, $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_OLIMPIADS];
echo renderField('2.4',  $student->st1, $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_SPORTS];
echo renderField('2.5',  $student->st1, $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_SCIENCES];
echo renderField('2.6',  $student->st1, $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_STUD_ORGS];
echo renderField('2.7',  $student->st1, $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_VOLONTER];
echo renderField('2.8',  $student->st1, $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_GROMADSKE];
echo renderField('2.9',  $student->st1, $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

echo CHtml::closeTag('ul');



echo '<div class="page-header">
  <h3>3. ПОРТФОЛІО РОБІТ</h3>
</div>';



echo '<div class="page-header">
  <h3>4. ПОРТФОЛІО ВІДГУКІВ</h3>
</div>';

echo grid(-1, $model->student);



