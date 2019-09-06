<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 04.02.2019
 * Time: 13:22
 */

/**
 * @var St $student
 * @var TimeTableForm $model
 */
$fields = Stportfolio::model()->getFieldsList();

echo '<div class="page-header">
  <h3>1.РЕЗЮМЕ</h3>
</div>';

$this->renderPartial('_stInfo', array(
    'student' => $student,
    'model' => $model,
));

echo '<div class="page-header">
  <h3>2.ПОРТФОЛІО ДОСЯГНЕНЬ</h3>
</div>';

echo '<div class="page-header">
  <h3>3.ПОРТФОЛІО РОБІТ</h3>
</div>';

echo '<div class="page-header">
  <h3>4.ПОРТФОЛІО ВІДГУКІВ</h3>
</div>';



