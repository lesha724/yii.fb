<?php
/**
 *
 * @var TimeTableController $this
 * @var TimeTableForm $model
 * @var CActiveForm $form
 */
$this->pageHeader=tt('Отработка: Поиск');
$this->breadcrumbs=array(
    tt('Отработка'),
);
	
$students = $model->getSearchStudents($model->st2);
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'search-form',
    'htmlOptions' => array('class' => 'form-inline noprint'),
	'method'=>'post',
	'action'=> array('progress/filterStudent'),
));
?>
	<?php echo $form->textField($model,'st2',array('size'=>60,'maxlength'=>255)); ?>
	
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'icon'=>'search',
		'label'=>tt('Поиск'),
		'htmlOptions'=>array(
			'class'=>'btn-small btn-search'
		)
	)); ?>
	<?php
$this->endWidget();

$timTable=new FilterForm;
$form1=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'timeTable-form',
    'htmlOptions' => array('style'=>'display:none'),
	'method'=>'post',
	'action'=> array('progress/retake'),
));
?>
	<?php echo $form1->hiddenField($timTable,'filial'); ?>
	<?php echo $form1->hiddenField($timTable,'faculty'); ?>
	<?php echo $form1->hiddenField($timTable,'speciality'); ?>
	<?php echo $form1->hiddenField($timTable,'course'); ?>
	<?php echo $form1->hiddenField($timTable,'group'); ?>
	<?php
$this->endWidget();

$filial=false;
$filials = Ks::model()->findAll();
if (count($filials) > 1) {
	$filial=true;
}

if(!empty($students))
{
	echo '<div class="table-responsive">
	<table class="table table-striped table table-bordered table-hover table-condensed">';
	$i=1;
	echo '<thead>
        <tr>
          <th>№</th>
          <th>'.tt('Ф.И.О.').'</th>
		  <th>'.$timTable->getAttributeLabel('group').'</th>
		  <th>'.$timTable->getAttributeLabel('course').'</th>
          <th>'.$timTable->getAttributeLabel('faculty').'</th>';
		  if($filial)
			echo '<th>'.$timTable->getAttributeLabel('filial').'</th>';
          echo '<th></th>
        </tr>
      </thead>
	  <tbody>';
	foreach($students as $student)
	{
		echo '<tr>
          <th scope="row">'.$i.'</th>
          <td>'.SH::getShortName($student['st2'], $student['st3'], $student['st4']).'</td>
		  <td>'.$student['group_name'].'</td>
		  <td>'.$student['sem4'].'</td>
          <td>'.$student['f2'].'</td>';
		  if($filial)
			echo '<td>'.$teacher['ks3'].'</td>';
          echo '<td><a class="btn-check btn btn-small btn-success" href="#" data-pnsp1="'.$student['pnsp1'].'" data-ks1="'.$student['ks1'].'" data-sem4="'.$student['sem4'].'" data-f1="'.$student['f1'].'" data-sg1="'.$student['sg1'].'"><i class="icon-check"> '.tt('Выбрать').'</i></td>
        </tr>';
		$i++;
	}
	echo '</tbody>
			</table>
			</div>';
}
else{
	$error=tt('Нет результатов');
	if(empty($model->st2))
		$error=tt('Введите запрос');
?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong><?=tt('Внимание!')?></strong> <?=$error?>
	</div>
<?php
}

Yii::app()->clientScript->registerScript('check', "
    $(document).on('click', '.btn-search',function(event) {
        if($('#St_st2').val()=='')
		{
			event.preventDefault();
		}
    });
	
	$(document).on('click', '.btn-check',function(event) {
		var f1=$(this).data('f1');
		var pnsp1=$(this).data('pnsp1');
		var ks1=$(this).data('ks1');
		var sg1=$(this).data('sg1');
		var sem4=$(this).data('sem4');
		$('#FilterForm_filial').val(ks1);
		$('#FilterForm_group').val(sg1);
		$('#FilterForm_course').val(sem4);
		$('#FilterForm_faculty').val(f1);
		$('#FilterForm_speciality').val(pnsp1);
        $('#timeTable-form').submit();
    });
");
	