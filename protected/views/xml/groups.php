<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 19.08.2016
 * Time: 21:50
 */
?>
<GetGroups>
    <Groups>
        <?php
            foreach($groups as $group){
                echo "<Group id=\"{$group['gr1']}\" filial=\"{$group['f14']}\" sort=\"{$group['gr7']}\" type=\"{$group['gr13']}\" faculty=\"{$group['sp5']}\" course=\"{$group['sem4']}\">";
                echo Gr::model()->getGroupName($group['sem4'], $group),'</Group>';
            }
        ?>
    </Groups>
</GetGroups>