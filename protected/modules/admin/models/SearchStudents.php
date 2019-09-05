<?php
/**
 * Created by PhpStorm.
 * User: Lesha
 * Date: 22.08.2019
 * Time: 10:26
 */

class SearchStudents extends St
{
    /**
     * for @see getStudentsForAdmin
     * @var int
     */
    public $st_status;

    public $st2;

    public $st3;

    public $st4;

    public $st15;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('st1', 'required'),
            array('st_status, st1', 'numerical', 'integerOnly'=>true),
            array('st2, st3, st4, st15', 'length', 'max'=>60)
        );
    }

    /**
     * @return CActiveDataProvider
     */
    public function getStudentsForAdmin()
    {
        $criteria=new CDbCriteria;

        $criteria->join = 'INNER JOIN std ON st1=std2 and std7 is null';

        $criteria->select = array('std11 as st_status');
        $with = array(
            'account' => array(
                'select' => 'u2, u3, u4'
            ),
            'person' => array(
                'select' => 'pe2, pe3, pe4, pe20'
            ),
        );

        $criteria->addCondition("st1 > 0");
        //$criteria->addCondition("pe2 <> ''");
        $criteria->addCondition("st101 != 7");

        $criteria->addCondition("std11 != 1");
        if(!empty($this->st2))
            $criteria->addCondition('pe2 CONTAINING :ST2');
        if(!empty($this->st3))
            $criteria->addCondition('pe3 CONTAINING :ST3');
        if(!empty($this->st4))
            $criteria->addCondition('pe4 CONTAINING :ST4');
        if(!empty($this->st15))
            $criteria->addCondition('pe20 = :ST15');

        if($this->st_status>0) {
            if($this->st_status==1)
                $criteria->addCondition('std11!=4 and std11!=2');
            if($this->st_status==2)
                $criteria->addCondition(' ( std11=4 or std11=2)');
        }

        $login = Yii::app()->request->getParam('login');
        $email = Yii::app()->request->getParam('email');

        if(!empty($login))
            $criteria->addCondition('account.u2 CONTAINING :LOGIN');
        if(!empty($email))
            $criteria->addCondition('account.u4 CONTAINING :EMAIL');

        $criteria->with = $with;

        $criteria->params = array(
            ':ST2'=>$this->st2,
            ':ST3'=>$this->st3,
            ':ST4'=>$this->st4,
            ':ST15'=>$this->st15,
            ':LOGIN' => $login,
            ':EMAIL' => $email
        );

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',10),
            ),
            'sort' => array(
                'defaultOrder' => 'pe2 collate UNICODE,pe3 collate UNICODE,pe4 collate UNICODE',
                'attributes' => array(
                    'st2' => array(
                        'asc'=>'pe2',
                        'desc'=>'pe2 DESC',
                    ),
                    'st3' => array(
                        'asc'=>'pe3',
                        'desc'=>'pe3 DESC',
                    ),
                    'st4' => array(
                        'asc'=>'pe4',
                        'desc'=>'pe4 DESC',
                    ),
                    'st15' => array(
                        'asc'=>'pe20',
                        'desc'=>'pe20 DESC',
                    ),
                    'account.u2',
                    'account.u3',
                    'account.u4',
                ),
            )
        ));
    }

    public function getParentsForAdmin()
    {
        $criteria=new CDbCriteria;

        $criteria->join = 'INNER JOIN std ON st1=std2 and std7 is null';

        $criteria->select = array('std11 as st_status');
        $with = array(
            'parentsAccount' => array(
                'select' => 'u2, u3, u4'
            ),
            'person' => array(
                'select' => 'pe2, pe3, pe4, pe20'
            ),
        );

        $criteria->addCondition("st1 > 0");

        $criteria->addCondition("st101 != 7");

        $criteria->addCondition("std11 != 1");
        if(!empty($this->st2))
            $criteria->addCondition('pe2 CONTAINING :ST2');
        if(!empty($this->st3))
            $criteria->addCondition('pe3 CONTAINING :ST3');
        if(!empty($this->st4))
            $criteria->addCondition('pe4 CONTAINING :ST4');
        if(!empty($this->st15))
            $criteria->addCondition('pe20 = :ST15');

        if($this->st_status>0) {
            if($this->st_status==1)
                $criteria->addCondition('std11!=4 and std11!=2');
            if($this->st_status==2)
                $criteria->addCondition(' ( std11=4 or std11=2)');
        }

        $login = Yii::app()->request->getParam('login');
        $email = Yii::app()->request->getParam('email');

        if(!empty($login))
            $criteria->addCondition('parentsAccount.u2 CONTAINING :LOGIN');
        if(!empty($email))
            $criteria->addCondition('parentsAccount.u4 CONTAINING :EMAIL');

        $criteria->with = $with;

        $criteria->params = array(
            ':ST2'=>$this->st2,
            ':ST3'=>$this->st3,
            ':ST4'=>$this->st4,
            ':ST15'=>$this->st15,
            ':LOGIN' => $login,
            ':EMAIL' => $email
        );

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'pe2 collate UNICODE,pe3 collate UNICODE,pe4 collate UNICODE',
                'attributes' => array(
                    'st2' => array(
                        'asc'=>'pe2',
                        'desc'=>'pe2 DESC',
                    ),
                    'st3' => array(
                        'asc'=>'pe3',
                        'desc'=>'pe3 DESC',
                    ),
                    'st4' => array(
                        'asc'=>'pe4',
                        'desc'=>'pe4 DESC',
                    ),
                    'st15' => array(
                        'asc'=>'pe20',
                        'desc'=>'pe20 DESC',
                    ),
                    'parentsAccount.u2',
                    'parentsAccount.u3',
                    'parentsAccount.u4',
                ),
            )
        ));
    }

    public function attributeLabels()
    {
        return array(
            'st2' => tt('Фамилия'),
            'st3' => tt('Имя'),
            'st4' => tt('Отчество'),
            'st15' => tt('ИНН')
        );
    }
}