<?php if (Yii::app()->user->hasFlash('success')) : ?>
    <div class="alert alert-success">
        <button data-dismiss="alert" class="close" type="button">
            <i class="icon-remove"></i>
        </button>
        <?=Yii::app()->user->getFlash('success')?>
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('info')) : ?>
    <div class="alert alert-info">
        <button data-dismiss="alert" class="close" type="button">
            <i class="icon-remove"></i>
        </button>
        <?=Yii::app()->user->getFlash('info')?>
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('error')) : ?>
    <div class="alert alert-error">
        <button data-dismiss="alert" class="close" type="button">
            <i class="icon-remove"></i>
        </button>
        <?=Yii::app()->user->getFlash('error')?>
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('warning')) : ?>
    <div class="alert alert-warning">
        <button data-dismiss="alert" class="close" type="button">
            <i class="icon-remove"></i>
        </button>
        <?=Yii::app()->user->getFlash('warning')?>
    </div>
<?php endif; ?>

