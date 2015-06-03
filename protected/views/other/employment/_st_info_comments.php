<?php
/**
 * @var St $student
 * @var Sdp $models
 * @var CActiveForm $form
 * @var Psto[] $comments
 */

?>
<div class="page-header position-relative" style="margin-top: 3%">
    <h1>
        <?=tt('Комментарии преподавателей')?>
    </h1>
</div>

<div class="comments">

    <?php foreach ($comments as $comment) : ?>
        <div class="itemdiv commentdiv">
            <div class="user">
                <img alt="Jennifer's Avatar" src="<?=$this->createUrl('/site/userPhoto', array('_id' => $comment->psto1, 'type' => 0))?>" />
            </div>

            <div class="body">
                <div class="name">
                    <?=P::model()->getTeacherNameBy($comment->psto1)?>
                </div>

                <div class="time">
                    <i class="icon-time"></i>
                    <span class="blue"><?=$comment->psto4?></span>
                </div>

                <div class="text">
                    <i class="icon-quote-left"></i>
                    <?=$comment->psto3?>
                    <i class="icon-quote-right"></i>
                </div>
            </div>

            <div class="tools">
                <?php
                    $user    = Yii::app()->user;
                    $canEdit = $user->isTch && $user->dbModel->p1 == $comment->psto1;
                    $href    = $this->createUrl('/other/deleteComment', array('psto1' => $comment->psto1, 'psto2' => $comment->psto2, 'psto4' => $comment->psto4));

                    if ($canEdit) :
                ?>
                    <a href="<?=$href?>" class="btn btn-minier btn-danger delete-comment">
                        <i class="icon-only icon-trash"></i>
                    </a>
                <?php endif ?>
            </div>
        </div>
    <?php endforeach ?>
</div>

<form style="width: 50%">
    <div class="form-actions input-append">
        <input type="text" name="message" class="width-75" placeholder="<?=tt('Оставьте здесь свой комментарий')?> ...">
        <button class="btn btn-small btn-info no-radius">
            <i class="icon-share-alt"></i>
            <span class="hidden-phone"><?=tt('Отправить')?></span>
        </button>
    </div>
</form>
