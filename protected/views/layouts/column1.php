<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

    <?php if (! empty($this->pageHeader)) :?>
        <div class="page-header position-relative">
            <h1>
                <?php echo $this->pageHeader;?>
                <!--<small>
                    <i class="icon-double-angle-right"></i>
                    based on widget boxes with 2 different styles
                </small>-->
            </h1>
        </div>
    <?php endif;?>

    <div class="row-fluid">
        <div class="span12">
            <div id="content">
                <?php echo $content; ?>
            </div><!-- content -->
        </div>
    </div>

<?php $this->endContent(); ?>