<?php
/**
 *
 * @var DocsController $this
 * @var Tddo $model
 * @var Fpdd $fpdd
 */

$attachedFiles = $model->getFiles();
//var_dump($attachedFiles);

?>

    <ul class="thumbnails">

        <?php
        $html = '';
        $pattern = <<<HTML
            <li class="span3">
                <a href="%s" target="_blank">
                    <div class="thumbnail">
                            %s
                        <h3>%s</h3>
                    </div>
                </a>
            </li>
HTML;

        foreach ($attachedFiles as $file) {
            $link = Yii::app()->createUrl('/doc/file/',array('id'=>$file['FPDD1']));

            if(Tddo::model()->isImage($file['FPDD4'])) {
                $file_ = '<img src="%s" alt="%s">';
                $file_ = sprintf($file_, $link, $file['FPDD4']);
            }else{
                $file_ ='';
            }

            $html .= sprintf($pattern,$link, $file_, $file['FPDD4']);
        }
        echo $html;
        ?>
    </ul>
<?php
/*

<div class="widget-box no-margin span6">
    <div class="widget-header">
        <h4>Custom File Input</h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <?php
                $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'attach-file-form',
                    'htmlOptions' => array(
                        'enctype' => 'multipart/form-data',
                        'class' => 'form-horizontal'
                    )
                ));
            ?>

            <?php echo CHtml::fileField('files[]', '', array('id' => 'id-input-file-3', 'multiple' => 'true')) ?>


            <div class="form-actions">
                <button type="submit" class="btn btn-info">
                    <i class="icon-ok bigger-110"></i>
                    <?=tt('Сохранить')?>
                </button>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>*/

