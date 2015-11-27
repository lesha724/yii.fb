<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 26.11.2015
 * Time: 15:31
 */


$this->pageHeader=tt('Карточка студента').' '.SH::getShortName($st->st2,$st->st3,$st->st4);
$this->breadcrumbs=array(
    tt('Другое'),
);

$this->renderPartial('/filter_form/default/year_sem');

if ($st1) :
    $this->renderPartial('studentCard/_bottom', array(
        'st' => $st,
    ));

endif;
