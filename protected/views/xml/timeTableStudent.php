<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 08.08.2016
 * Time: 22:09
 */
?>
<TimetableForStudent>
    <?=$this->renderPartial('_timeTable',array(
        'timeTable'=>$timeTable,
        'type'=> $type
    ))?>
</TimetableForStudent>