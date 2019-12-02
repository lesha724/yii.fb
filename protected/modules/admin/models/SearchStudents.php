<?php
/**
 * Created by PhpStorm.
 * User: Lesha
 * Date: 22.08.2019
 * Time: 10:26
 */

/**
 * Class SearchStudents
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
     * for @see getStudentsForAdmin
     * @var string
     */
    public $gr3;
    /**
     * for @see getStudentsForAdmin
     * @var int
     */
    public $std20;

    /**
     * @var string
     */
    public $gr19;
    /**
     * @var string
     */
    public $gr20;
    /**
     * @var string
     */
    public $gr21;
    /**
     * @var string
     */
    public $gr22;
    /**
     * @var string
     */
    public $gr23;
    /**
     * @var string
     */
    public $gr24;
    /**
     * @var string
     */
    public $gr28;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('st1', 'required'),
            array('st_status, st1, std20', 'numerical', 'integerOnly'=>true),
            array('st2, st3, st4, st15, gr3, gr19,gr20,gr21,gr22,gr23,gr24,gr28', 'length', 'max'=>60)
        );
    }

    /**
     * @return CActiveDataProvider
     */
    public function getStudentsForAdmin()
    {
        $criteria=new CDbCriteria;

        $criteria->join = ' INNER JOIN std ON st1=std2 and std7 is null';
        $criteria->join .= ' INNER JOIN gr ON gr1=std3';

        $criteria->select = 'std11 as st_status, gr3 as gr3, gr19 as gr19,gr20 as gr20,gr21 as gr21,gr22 as gr22,gr23 as gr23,gr24 as gr24,gr28 as gr28, std20 as std20';
        $with = array(
            'account' => array(
                'select' => 'u2, u4'
            ),
            'person' => array(
                'select' => 'pe2, pe3, pe4, pe20'
            ),
        );

        $criteria->addCondition("st1 > 0 and pe2 != ''");
        $criteria->addCondition("st101 != 7");

        $criteria->addCondition("std11 != 1 and std24=0");
        if(!empty($this->st2))
            $criteria->addCondition('pe2 CONTAINING :ST2');
        if(!empty($this->st3))
            $criteria->addCondition('pe3 CONTAINING :ST3');
        if(!empty($this->st4))
            $criteria->addCondition('pe4 CONTAINING :ST4');
        if(!empty($this->gr3))
            $criteria->addCondition('gr3 CONTAINING :GROUP');
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
            ':GROUP'=>$this->gr3,
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
                    'account.u4',
                ),
            )
        ));
    }

    /**
     * @return CActiveDataProvider
     */
    public function getParentsForAdmin()
    {
        $criteria=new CDbCriteria;

        $criteria->join = 'INNER JOIN std ON st1=std2 and std7 is null';

        $criteria->select = array('std11 as st_status');
        $with = array(
            'parentsAccount' => array(
                'select' => 'u2, u4'
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
                    'parentsAccount.u4',
                ),
            )
        ));
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'st2' => tt('Фамилия'),
            'st3' => tt('Имя'),
            'st4' => tt('Отчество'),
            'st15' => tt('ИНН'),
            'gr3' => tt('Группа')
        );
    }

    /**
     * Названеи группы для отображения
     * @return string
     */
    public function getGroupName(){
        return Gr::model()->getGroupName($this->std20, array(
            "gr3" => $this->gr3,
            "gr19" => $this->gr19,
            "gr20" => $this->gr20,
            "gr21" => $this->gr21,
            "gr22" => $this->gr22,
            "gr23" => $this->gr23,
            "gr24" => $this->gr24,
            "gr28" => $this->gr28
        )).' ('.$this->gr3.')';
    }
}