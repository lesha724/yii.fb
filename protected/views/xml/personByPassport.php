<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 28.09.2016
 * Time: 11:16
 */
?>
<GetPersonByPassport>
    <?=$this->renderPartial('_person',array(
        'person'=>$person,
        'type'=> $type
    ))?>
</GetPersonByPassport>
