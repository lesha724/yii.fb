<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 19.08.2016
 * Time: 21:50
 */
?>
<GetAudiences>
    <Audiences>
        <?php
            foreach($audiences as $audience){
                echo "<Audience id=\"{$audience['a1']}\" type=\"{$audience['a8']}\" filial=\"{$audience['a6']}\" place=\"{$audience['a3']}\">";
                echo $audience['a2'],'</Audience>';
            }
        ?>
    </Audiences>
</GetAudiences>