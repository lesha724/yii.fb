<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->pageHeader=tt('Error');
$this->breadcrumbs=array(
	'Error',
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

        <!--<div>
            <div class="space"></div>
            <h4 class="smaller">Try one of the following:</h4>

            <ul class="unstyled spaced inline bigger-110">
                <li>
                    <i class="icon-hand-right blue"></i>
                    Re-check the url for typos
                </li>

                <li>
                    <i class="icon-hand-right blue"></i>
                    Read the faq
                </li>

                <li>
                    <i class="icon-hand-right blue"></i>
                    Tell us about it
                </li>
            </ul>
        </div>

        <hr>
        <div class="space"></div>

        <div class="row-fluid">
            <div class="center">
                <a class="btn btn-grey" href="<?=Yii::app()->createUrl('/site/index')?>">
                    <i class="icon-arrow-left"></i>
                    Go Back
                </a>
            </div>
        </div>-->
    </div>
</div>