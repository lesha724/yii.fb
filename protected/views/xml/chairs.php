<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 19.08.2016
 * Time: 21:50
 */
?>
<Chairs>
    <?php
        foreach($chairs as $chair){
            echo "<Chair id=\"{$chair['k1']}\" abbr=\"{$chair['k2']}\" filial=\"{$chair['k10']}\" faculty=\"{$chair['k7']}\">";
            echo $chair['k3'],'</Chair>';
        }
    ?>
</Chairs>