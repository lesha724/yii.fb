<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 10.10.2016
 * Time: 15:23
 */
?>
<GetJournalMark>
    <?php
        foreach($rows as $row){
            echo '<Lesson>' ,
                '<Chair>',$row['k1'],'</Chair>',
                '<Speciality>',$row['sp1'],'</Speciality>',
                '<Group>',$row['gr1'],'</Group>',
                '<Course>',$row['sem4'],'</Course>',
                '<Date>', date(XmlController::FORMAT_DATE, strtotime($row['r2'])),'</Date>';
                echo '<Discipline>',
                        //'<Id>',$row['d1'],'</Id>',
                        /*'<Name>',*/$row['d2'];/*,'</Name>';*/
                echo '</Discipline>';
                echo '<Type>',$row['us4'],'</Type>';
                echo '<Student>',
                    /*'<FirstName>',$row['st3'],'</FirstName>',
                    '<SecondName>',$row['st4'],'</SecondName>',
                    '<LastName>',$row['st2'],'</LastName>',
                    '<RecordBook>',$row['st5'],'</RecordBook>',*/
                    '<Id>',$row['st1'],'</Id>',
                    '<OutId>',$row['st108'],'</OutId>';
                echo '</Student>';
                echo '<Estimate>',
                    '<Mark>',$row['elgzst4'],'</Mark>';
                    if($row['elgzst3']>0)
                    echo '<Omission>',
                        '<Type>',$row['elgzst3'],'</Type>',
                        '<Reason>',$row['elgp2'],'</Reason>',
                        '<Reference>',$row['elgp3'],'</Reference>',
                        '<Receipt>',$row['elgp4'],'</Receipt>',
                    '</Omission>';
                    if($row['elgzst5']>0)
                    echo '<Retake>',
                        '<Mark>',$row['elgzst5'],'</Mark>',
                        '<CountRetake>',$row['count_retake'],'</CountRetake>',
                    '</Retake>';
                echo '</Estimate>';
            echo '</Lesson>';
        }
    ?>
</GetJournalMark>
