<?php
/**
 * @var Aap $model
 */

    $disciplines = D::model()->getExamsOf($model->aap16);

    if (! empty($disciplines)) :
?>
<div class="hr hr-dotted"></div>
<h3 class="lighter block green">
    <?=tt('Прошу засчитать в качестве вступительных экзаменов')?>:
</h3>

    <table>
        <?php foreach ($disciplines as $discipline) : ?>
            <?php $d1 = $discipline['d1']; ?>
            <tr>
                <td>
                    <?=$discipline['d2']?>
                </td>
                <td>
                    <select name="aapes[<?=$d1?>][aapes3]" style="width:120px">
                        <option value="0"><?=tt('ЕГЭ')?></option>
                        <option value="1"><?=tt('Олимпиада')?></option>
                    </select>
                </td>
                <td>
                    <span data-type="0">
                        <input type="text" name="aapes[<?=$d1?>][aapes5]" class="input-mini" placeholder="<?=tt('Балл')?>" maxlength="3">
                        <input type="text" name="aapes[<?=$d1?>][aapes4]" data-name="aapes[<?=$d1?>][aapes4]" class="input-large" placeholder="<?=tt('№ свидетельства о сдаче')?>" maxlength="15">
                        <input type="text" name="aapes[<?=$d1?>][aapes6]" class="input-medium" placeholder="<?=tt('Год сдачи')?>" maxlength="4">
                    </span>
                    <span data-type="1" style="display:none">
                        <input type="text" data-name="aapes[<?=$d1?>][aapes4]" class="input-large" placeholder="<?=tt('№ свидетельства о победе')?>" maxlength="15">
                        <input type="text" name="aapes[<?=$d1?>][aapes7]" class="input-medium" placeholder="<?=tt('Год участия')?>" maxlength="4">
                    </span>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
<?php endif;