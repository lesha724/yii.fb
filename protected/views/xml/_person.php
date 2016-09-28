<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 28.09.2016
 * Time: 11:24
 */
?>
<Person>
    <FirstName><?=$person['firstName']?></FirstName>
    <SecondName><?=$person['secondName']?></SecondName>
    <LastName><?=$person['lastName']?></LastName>
    <Id><?=$person['id']?></Id>
    <OutId><?=$person['outId']?></OutId>
    <Type><?=$person['type']?></Type>
    <Date><?=date(XmlController::FORMAT_DATE, strtotime($person['date']))?></Date>
</Person>
