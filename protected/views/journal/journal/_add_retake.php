<div class="">

    <h4 class="page-header"><?=tt('Отработка')?></h4>
<?php
    $this->renderPartial('/journal/retake/_add_retake', array(
        'model' => $model,
        'elgzst'=>$elgzst,
        'us4'=>$us4,
        'r1'=>$r1
    ));
?>
</div>