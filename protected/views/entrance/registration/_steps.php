
<ul class="wizard-steps">
    <?php
        foreach ($steps as $step => $title) :
            $num = $step+1;
    ?>
        <li data-target="#step<?=$num?>" class="<?=($step==0?'active':'')?>">
            <span class="step"><?=$num?></span>
            <span class="title"><?=tt($title)?></span>
        </li>
    <?php endforeach?>
</ul>



