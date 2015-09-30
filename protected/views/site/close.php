<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Close';
$this->pageHeader=tt('Close');
$this->breadcrumbs=array(
	'Close',
);
?>

<div class="error">

</div>

<div class="error-container">
    <div class="well">
        <h1 class="grey lighter smaller">
            <span class="blue bigger-125">
                <i class="icon-exclamation-sign"></i>
                <?php echo $code; ?>
            </span>
           <!--Page Not Found-->
        </h1>

        <hr>
        <h3 class="lighter smaller"><?php echo CHtml::encode($message); ?></h3>
    </div>
</div>