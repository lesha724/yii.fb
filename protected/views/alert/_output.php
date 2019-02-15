<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 15.02.2019
 * Time: 13:50
 */

/**
 * @var $this AlertController
 * @var $model Users
 */

$messages = Um::model()->findAllByAttributes(array('um2'=> $model->u1));

if(empty($messages)): ?>
   <div class="alert alert-warning">
        <?=tt('Нет выходящих сообщений')?>
    </div>
<?php
    endif;

$pattern = <<<HTML
<div class="media">
  <a class="pull-left" href="#">
    <div class="media-object">%s</div>
  </a>
  <div class="media-body">
    <h4 class="media-heading">%s</h4>
    %s
  </div>
</div>
HTML;

echo '<div>';
foreach ($messages as $message){
    echo sprintf($pattern, '', tt('Сообщение от {username} {date}', array(
        '{username}' => $message->um20->u2
    )));
}
echo '</div>';