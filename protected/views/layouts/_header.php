<?php
    Yii::app()->clientScript->registerScript('authorization',
        'tt.authorization = "'.tt('Авторизация').'"',
        CClientScript::POS_END);

    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/authorization.js', CClientScript::POS_END);
?>
<div class="navbar navbar-fixed-top">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="#">
                <small>
                    <i class="icon-leaf"></i>
                    <?=tt('АСУ')?>
                </small>
            </a><!-- /.brand -->
            <ul class="nav ace-nav pull-right">
                <li class="light-blue">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" >
                        <?php if (Yii::app()->user->isGuest) : ?>
                            <i class="icon-user"></i><?=tt('Войти')?>
                        <?php else: ?>
                            <img alt="User's Photo" src="/theme/ace/assets/avatars/avatar2.png" class="nav-user-photo">
                            <span class="user-info">
                                <small>Welcome,</small>
                                <?=Yii::app()->user->name?>
                            </span>
                        <?php endif; ?>
                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
                        <?php if (Yii::app()->user->isGuest) : ?>
                            <li>
                                <a href="<?=Yii::app()->createUrl('site/login')?>" id="sign-in">
                                    <i class="icon-signin"></i><?=tt('Авторизация')?>
                                </a>
                            </li>
                            <li>
                                <a href="<?=Yii::app()->createUrl('site/registration')?>" id="registration">
                                    <i class="icon-user"></i>
                                    <?=tt('Регистрация')?>
                                </a>
                            </li>
                            <li>
                                <a href="<?=Yii::app()->createUrl('site/forgotPassword')?>" id="forgot-password">
                                    <i class="icon-envelope"></i>
                                    <?=tt('Забыл пароль')?>
                                </a>
                            </li>
                        <?php else: ?>
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