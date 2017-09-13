<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 13.09.2017
 * Time: 12:41
 */

/**
 * @var $this EAuthController
 * @var $form TbActiveForm
 * @var $model ConfigEAuthForm
 * @var $serviceTitle string
 * @var $serviceFileName string
 * @var $infoUrl string
 */
?>


<div class="span4">
    <div class="widget-box collapsed">
        <div class="widget-header">
            <h4><?=$serviceTitle?></h4>
            <span class="widget-toolbar">
                <a data-action="collapse" href="#">
                    <i class="icon-chevron-down"></i>
                </a>
            </span>
        </div>
        <div class="widget-body">
            <div class="widget-body-inner well" style="display: block;">
                <?php
                    if(isset($infoUrl)&&!empty($infoUrl))
                    {
                        echo '<div class="alert alert-info">';
                        echo tt('Зарегистрировать свое приложение вы можете : ').CHtml::link(tt('Здесь'), $infoUrl);
                        echo '</div>';
                    }
                ?>
                <?=$this->renderPartial('services/'.$serviceFileName, array(
                    'form' => $form,
                    'model' => $model
                ));?>
            </div>
        </div>
    </div>
</div>
