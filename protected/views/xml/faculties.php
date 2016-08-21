<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 19.08.2016
 * Time: 21:50
 */
?>
<GetFaculties>
    <Faculties>
        <?php
            foreach($faculties as $faculty){
                echo "<Faculty id=\"{$faculty['f1']}\" abbr=\"{$faculty['f2']}\" filial=\"{$faculty['f14']}\">";
                echo $faculty['f3'],'</Faculty>';
            }
        ?>
    </Faculties>
</GetFaculties>