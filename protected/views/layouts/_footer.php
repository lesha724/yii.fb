<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 22.11.2016
 * Time: 20:31
 */?>

<?php
$textFooter = PortalSettings::model()->findByPk(99)->ps2;
if(!empty($textFooter))
    echo '<div class="user-block">',$textFooter,'</div>';
?>
©2015 ООО НПП "МКР", <a target="_ablank" title="www.mkr.org.ua" href="http://mkr.org.ua/">www.mkr.org.ua</a>
