<?php
    if(!empty($models))
    {
        $table = '<table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>'.Stego::model()->getAttributeLabel('stego2').'</th>
                        <th>'.Stego::model()->getAttributeLabel('stego3').'</th>
                        <th>'.Stego::model()->getAttributeLabel('stego4').'</th>
                    </tr>
                </thead>
                <tbody>
                    %s
                </tbody>
            </table>';
        $tr="";
        $i=1;
        foreach ($models as $model) {
            $tr.='<tr>'.
                '<td>'.$i.'</td>'.
                '<td>'.  round($model->stego2).'</td>'.  
                '<td class="date">'.date('Y-m-d', strtotime($model->stego3)).'</td>'.
                '<td>'.  P::model()->getTeacherNameBy($model->stego4,true).'</td>'.
            '</tr>';
            $i++;   
        }
        echo sprintf($table, $tr); 
    }  else {
        echo tt('Нет отроботок');
    }
?>
