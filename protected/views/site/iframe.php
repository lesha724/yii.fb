<?php
/* @var $this SiteController
        $model Pm
 */

Yii::app()->clientScript->registerScript('iframe-main', <<<JS
        top.document.getElementById('iframe-main').height = document.body.scrollHeight;
JS
    , CClientScript::POS_END);

$label='';
switch (Yii::app()->language) {
        case 'uk':
                $label=$model->pm2;
                break;
        case 'ru':
                $label=$model->pm3;
                break;
        case 'en':
                $label=$model->pm4;
                break;
        default:
                $label=$model->pm5;
                break;
}

$this->pageTitle=$label." | iframe:".$model->pm6;
$this->pageHeader=$this->pageTitle;
?>

<iframe id="iframe-main" src="<?=$model->pm6?>" width="100%" height="400px" align="left">
    Ваш браузер не поддерживает плавающие фреймы!
</iframe>


