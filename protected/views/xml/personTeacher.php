<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 20.10.2016
 * Time: 15:56
 */
?>
<GetTeacherPerson>
    <Teacher>
        <FirstName><?=$teacher->p4?></FirstName>
        <SecondName><?=$teacher->p5?></SecondName>
        <LastName><?=$teacher->p3?></LastName>
        <Id><?=$teacher->p1?></Id>
        <OutId><?=$teacher->p132?></OutId>
        <Date><?=date(XmlController::FORMAT_DATE, strtotime($teacher->p9))?></Date>
        <Sex><?=$teacher->p8?></Sex>
    </Teacher>
</GetTeacherPerson>
