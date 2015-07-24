<?php
    Yii::app()->clientScript->registerScript('authorization',
        'tt.authorization = "'.tt('Авторизация').'"',
        CClientScript::POS_END);

    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/authorization.js', CClientScript::POS_END);
?>
<?php
        $logo=Yii::getPathOfAlias('webroot').Yii::app()->params['logo'];
?>
<div id="fixed-top">
   <a class="brand" href="<?=Yii::app()->createUrl('site/index')?>">
        <small>
        <?php
            if(!empty($logo)&&!empty(Yii::app()->params['logo']))
            {
                    /*if(!file_exists($logo))
                    {
                            echo '<i class="icon-leaf"></i>';
                    }else
                    {*/
                            echo CHtml::image(Yii::app()->params['logo'], '',array('class'=>'logo-image'));
                    //}
            }else
            {
                    echo '<i class="icon-leaf"></i>';
            }
        ?>
	<?php
            if(!empty(Yii::app()->params['title'.Yii::app()->language]))
            {
                    echo Yii::app()->params['title'.Yii::app()->language];
            }
            else
            {
                    echo tt('АСУ');
            };
        ?>
        <?php
            $logo2=Yii::getPathOfAlias('webroot').Yii::app()->params['logo_right'];					
            if(file_exists($logo2)&&!empty(Yii::app()->params['logo_right']))
            {
                    echo CHtml::image(Yii::app()->params['logo_right'], '',array('id'=>'logo-image-right'));
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
            <a id="brand" class="brand" href="<?=Yii::app()->createUrl('site/index')?>">
                <small>
					
		<?php
                    if(!empty($logo)&&!empty(Yii::app()->params['logo']))
                    {
                            if(!file_exists($logo))
                            {
                                    echo '<i class="icon-leaf"></i>';
                            }else
                            {
                                    echo CHtml::image(Yii::app()->params['logo'], '',array('id'=>'logo-image'));
                            }
                    }else
                    {
                            echo '<i class="icon-leaf"></i>';
                    }
                ?>
					
                </small>
            </a><!-- /.brand -->
			
            <ul class="nav ace-nav pull-right">
                <li class="light-blue">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" >
                        <?php if (Yii::app()->user->isGuest) : ?>
                            <i class="icon-user"></i><?=tt('Войти')?>
                        <?php else:
                                if (Yii::app()->user->isTch) {
                                    $id   = Yii::app()->user->dbModel->p1;
                                    $type = Users::FOTO_P1;
                                    $url = $this->createUrl('site/userPhoto', array('_id' => $id, 'type' => $type));
                                } elseif (Yii::app()->user->isStd) {
                                    $id   = Yii::app()->user->dbModel->st1;
                                    $type = Users::FOTO_ST1;
                                    $url = $this->createUrl('site/userPhoto', array('_id' => $id, 'type' => $type));
                                } else
                                    $url = '/theme/ace/assets/avatars/avatar2.png';
                            ?>
                            <img alt="photo" src="<?=$url?>" class="nav-user-photo">
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