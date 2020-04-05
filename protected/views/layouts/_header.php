<?php
    Yii::app()->clientScript->registerScript('authorization',
        'tt.authorization = "'.tt('Авторизация').'"',
        CClientScript::POS_END);

    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/authorization.js', CClientScript::POS_END);
?>
<div id="fixed-top">
   <a class="brand" href="<?=Yii::app()->createUrl('site/index')?>">
        <small>
        <?php
            if(!empty(Yii::app()->params['top1']))
            {
                echo Yii::app()->params['top1'];
            }else
            {
                echo '<i class="icon-leaf"></i>';
            }
        ?>
        </small>
    </a><!-- /.brand --> 
</div>
<div id="header-fixed-top-block" class="navbar navbar-fixed-top noprint">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>
    <div class="navbar-inner">
        <div class="container-fluid">
            <?php
            if(!empty(Yii::app()->params['top2']))
            {
                echo '<div id="top2">'.Yii::app()->params['top2'].'</div>';
            } /*else
            {
                echo '<i class="icon-leaf"></i>';
            }*/
            ?> 	
            <ul class="nav ace-nav pull-right">
                <li class="light-blue">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" >
                        <?php if (Yii::app()->user->isGuest) : ?>
                            <i class="icon-user"></i><?=tt('Войти')?>
                        <?php else:
                                if (Yii::app()->user->isTch) {
                                    $url = $this->createUrl('/site/userPhoto', array('_id' => Yii::app()->user->dbModel->p1, 'type' => Users::FOTO_P1));
                                } elseif (Yii::app()->user->isStd) {
                                    $url = $this->createUrl('/site/userPhoto', array('_id' => Yii::app()->user->dbModel->st200, 'type' => Users::FOTO_PE1));
                                } else
                                    $url = '/theme/ace/assets/avatars/avatar2.png';
                            ?>
                            <img alt="photo" src="<?=$url?>" class="nav-user-photo">
                            <span class="user-info">
                                <?=tt('<small>Добро пожаловать,</small> {username}', array(
                                    '{username}' => Yii::app()->user->name
                                ))?>
                            </span>
                        <?php endif; ?>
                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
                        <?php if (Yii::app()->user->isGuest) : ?>
                            <li>
                                <a href="<?=Yii::app()->createUrl('site/login')?>" id="sign-in-new">
                                    <i class="icon-signin"></i><?=tt('Авторизация')?>
                                </a>
                            </li>
                            <?php
                            if(PortalSettings::model()->getSettingFor(102)==0) {
                                ?>
                                <li>
                                    <a href="<?= Yii::app()->createUrl('site/registration') ?>" id="registration">
                                        <i class="icon-user"></i>
                                        <?= tt('Регистрация') ?>
                                    </a>
                                </li>
                                <?php
                            }
                             if(PortalSettings::model()->getSettingFor(98)==0){
                                 ?>
                                    <li>
                                        <a href="<?=Yii::app()->createUrl('site/registrationInternational')?>" id="registration-international">
                                            <i class="icon-user"></i>
                                            <?=tt('Регистрация иностр. граждан')?>
                                        </a>
                                    </li>
                                <?php
                             }
                             if(PortalSettings::model()->getSettingFor(103)==0) {
                                 ?>
                                    <li>
                                        <a href="<?=Yii::app()->createUrl('site/forgotPassword')?>" id="forgot-password">
                                            <i class="icon-envelope"></i>
                                            <?=tt('Забыл пароль')?>
                                        </a>
                                    </li>
                                <?php
                             }
                             if(PortalSettings::model()->getSettingFor(PortalSettings::ACCEPT_CANCEL_REGISTRATION)==1) {
                                 ?>
                                <li>
                                    <a href="<?=Yii::app()->createUrl('site/cancelRegistration')?>">
                                        <i class="icon-remove"></i>
                                        <?=tt('Отменить регистрацию')?>
                                    </a>
                                </li>
                                <?php
                             }
                             ?>

                        <?php else: ?>

                            <?php
                                if(Yii::app()->user->isStd){

                                    $ps122 = PortalSettings::model()->getSettingFor(PortalSettings::ENABLE_DIST_EDUCATION);
                                    if($ps122==1){
                                        if(Yii::app()->user->dbModel->st168>0) {
                                            $ps123 = PortalSettings::model()->getSettingFor(PortalSettings::HOST_DIST_EDUCATION);

                                            if(!empty($ps123)) {
                                                ?>
                                                    <li>
                                                        <a href="<?= $ps123 ?>"
                                                           id="login-dist-education">
                                                            <i class="icon-hand-right"></i>
                                                            <?= tt('Перейти в дист. образование') ?>
                                                        </a>
                                                    </li>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <li>
                                                <a href="<?= Yii::app()->createUrl('site/signUpDistEducation') ?>"
                                                   id="sign-up-dist-education">
                                                    <i class="icon-thumbs-up"></i>
                                                    <?= tt('Зарегистрироваться в дист. образовании') ?>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                            }

                            if(PortalSettings::model()->getSettingFor(PortalSettings::SHOW_SCORE_LINK) && Yii::app()->core->universityCode == U_URFAK && Yii::app()->user->isStd)
                                echo '<li>
                                    <a href="'.Yii::app()->createUrl('self/score').'" target="_blank">
                                        <i class="icon-list-alt"></i>'
                                        .tt('Счет').
                                    '</a>
                                </li>';
                            ?>

                            <li>
                                <a href="<?=Yii::app()->createUrl('site/changePassword')?>" id="change-password">
                                    <i class="icon-user"></i>
                                    <?=tt('Смена профиля')?>
                                </a>
                            </li>
                            <li>
                                <a href="<?=Yii::app()->createUrl('/site/logout')?>">
                                    <i class="icon-off"></i>
                                    <?=tt('Выйти')?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>


        </div><!-- /.container-fluid -->
    </div><!-- /.navbar-inner -->
</div>