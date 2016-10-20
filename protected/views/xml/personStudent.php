<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 20.10.2016
 * Time: 15:56
 */
?>
<GetStudentPerson>
    <Student>
        <FirstName><?=$student->st3?></FirstName>
        <SecondName><?=$student->st4?></SecondName>
        <LastName><?=$student->st2?></LastName>
        <Id><?=$student->st1?></Id>
        <OutId><?=$student->st108?></OutId>
        <Date><?=date(XmlController::FORMAT_DATE, strtotime($student->st7))?></Date>
        <RecordBook><?=$student->st5?></RecordBook>
        <Sex><?=$student->st6?></Sex>
    </Student>
</GetStudentPerson>
