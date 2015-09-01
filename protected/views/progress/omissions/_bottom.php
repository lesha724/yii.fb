<?php
$this->renderPartial('/filter_form/default/_refresh_filter_form_button');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getOptions($title,$type,$val)
{
    $selected="";
    if($type==$val)
        $selected="selected";
    return '<option '.$selected.' value="'.$type.'">'.$title.'</option>'; 
}
function getSelect($type,$i)
{
    /*if($i==0)
    {
        $html='<select data-field="stegn10" class="select-stegn10">';
    }  else {
        $html='<select name="select-type" id="select-type">';
    }
    $array = Stegn::model()->getTypes();
    foreach ($array as $key => $value) {
        $html.=getOptions($value, $key, $type); 
    }    
    /*$html.=getOptions(tt('Тип2'), 1, $type); 
    $html.=getOptions(tt('Тип3'), 2, $type); 
    $html.=getOptions(tt('Тип4'), 3, $type);*/ 
    /*$html.='</select>'; 
    return $html;*/
    if($i==0)
    {
        $options=array('data-field'=>"stegn10",'class'=>"select-stegn10",'id'=>"select-stegn10");
        $name ='select-stegn10';
    }  else {
        $options=array('id'=>"select-type");
        $name ='select-type';
    }
    $data = CHtml::listData(Stegn::model()->getTypesByGroup(),'id','text','group');
    return CHtml::dropDownList($name,$type,$data,$options);
    
}
$omissions = Stegn::model()->getOmissions($model->student,$model->date1,$model->date2);

if($omissions==null)
{
    echo '<span class="label label-success" style="font-size:16px">'.tt('Зарегистрированных пропусков нет').'</span>';
}  else {
    
    $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'button',
		'type'=>'success',
		'icon'=>'list-alt',
		'label'=>tt('Ввести уважительные пропуски'),
		'htmlOptions'=>array(
			'class'=>'btn-small',
                        'data-toggle' => 'modal',
                        'data-target' => '#myModal',
		)
	));
    $url       = Yii::app()->createUrl('/progress/insertOmissionsStegMark');
    $table = '<table data-url="'.$url.'" id="omissions" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>'.tt('Дата').'</th>
                        <th>'.tt('Дисциплина').'</th>
                        <th>'.tt('Тип').'</th>
                        <th>'.tt('Уваж./Неув.').'</th>
                        <th>'.tt('Номер справки').'</th>
                        <th>'.tt('Тип').'</th>
                    </tr>
                </thead>
                <tbody>
                    %s
                </tbody>
            </table>';
    $tr="";
    $i=1;
    foreach($omissions as $key)
    {
        $checked="";
        if($key['stegn4']==2)
            $checked="checked";
        $tr.='<tr data-stegn1="'.$key['stegn1'].'" data-stegn2="'.$key['stegn2'].'" data-stegn3="'.$key['stegn3'].'">'.
                '<td>'.$i.'</td>'.
                '<td class="date">'.date('d.m.Y', strtotime($key['stegn9'])).'</td>'.
                '<td>'.$key['d2'].'</td>'.
                '<td>'.  ShortCodes::convertUS4($key['us4']).'</td>'.
                '<td><input data-field="stegn4" class="ckbox-stegn4" '.$checked.' type="checkbox"/></td>'.
                '<td><input data-field="stegn11" class="input-stegn11" type="text" value="'.$key['stegn11'].'"/></td>'.
                '<td>'. getSelect($key['stegn10'],0).'</td>'.
        '</tr>';
        $i++;
    }
    echo sprintf($table, $tr); // 2 table


$this->beginWidget(
    'bootstrap.widgets.TbModal',
    array('id' => 'myModal')
); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4><?=tt('Ввести уважительные пропуски')?></h4>
    </div>
 
    <div class="modal-body">
        <?php
            echo CHtml::label(tt('C'), 'date1_omissions_change');
            echo CHtml::textField('date1_omissions_change', $model->date1, array('class' => 'datepicker', 'id'=>'date1_omissions_change'));
            echo CHtml::label(tt('по'), 'date2_omissions_change');
            echo CHtml::textField('date2_omissions_change', $model->date2, array('class' => 'datepicker', 'id'=>'date2_omissions_change'));
            echo CHtml::label(tt('Уваж./Неув.'), 'ck_omissions');
            echo CHtml::checkBox('ck_omissions', 'checked', array('id'=>'ck_omissions'));
            echo CHtml::label(tt('Номер справки'), 'number_reference');
            echo CHtml::textField('number_reference', '', array('id'=>'number_reference'));
            echo CHtml::label(tt('Тип'), 'select_type');
            echo getSelect(-1, 1);
        ?>
    </div>
 
    <div class="modal-footer">
        <?php 
            $url = Yii::app()->createUrl('/progress/updateOmissionsStegMark');
            $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'type' => 'primary',
                'label' => tt('Сохранить'),
                'url' => '#',
                'htmlOptions' => array(
                    'id'=>'save-change-omissions',
                    'data-stegn1'=>$model->student,
                    'data-url'=>$url
                ),
            )
        ); ?>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => tt('Отмена'),
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>
 
<?php $this->endWidget();

}
?>

