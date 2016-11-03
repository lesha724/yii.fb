<?php
    if(!empty($models))
    {
        $table = '<table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>'.Elgotr::model()->getAttributeLabel('elgotr2').'</th>
                        <th>'.Elgotr::model()->getAttributeLabel('elgotr3').'</th>
                        <th>'.Elgotr::model()->getAttributeLabel('elgotr4').'</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    %s
                </tbody>
            </table>';
        $tr="";
        $i=1;
        foreach ($models as $model) {
            $mark=round($model->elgotr2,1);
            if($us4==1)
                $mark=$model->getElgotr2ByLk();
            $tr.='<tr>'.
                '<td>'.$i.'</td>'.
                '<td>'. $mark.'</td>'.
                '<td class="date">'.date('d.m.Y', strtotime($model->elgotr3)).'</td>'.
                '<td>'.  P::model()->getTeacherNameBy($model->elgotr4,true).'</td>'.
                '<td><button data-url="'.Yii::app()->createUrl('/journal/deleteRetake').'" class="delete-retake btn btn-danger btn-mini" data-elgotr0="'.$model->elgotr0.'"><i class="icon-trash"></i></button></td>'.
            '</tr>';
            $i++;   
        }
        echo sprintf($table, $tr); 
    }  else {
        echo tt('Нет отроботок');
    }
?>
