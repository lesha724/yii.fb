<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 19.08.2016
 * Time: 21:50
 */
?>
<GetTeachers>
    <Teachers>
        <?php
            foreach($teachers as $teacher){
                echo "<Teacher chair=\"{$teacher['pd4']}\" id=\"{$teacher['p1']}\" firstName=\"{$teacher['p4']}\" secondName=\"{$teacher['p5']}\" lastName=\"{$teacher['p3']}\">";
                echo $teacher['p132'],'</Teacher>';
            }
        ?>
    </Teachers>
</GetTeachers>