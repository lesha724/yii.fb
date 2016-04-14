<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 13.04.2016
 * Time: 13:44
 */

    $lessons = Elg::model()->getRetakeAndOmissions($st1,$uo1,$sem1,$type,$gr1);
    foreach($lessons as $lesson){
        echo $lesson['elgzst0'].'</br>';
    }
?>