<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 08.08.2016
 * Time: 19:24
 */
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<Response>
    <?php echo $content; ?>
</Response>