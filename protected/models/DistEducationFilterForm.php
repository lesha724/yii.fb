<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 27.11.2017
 * Time: 17:07
 */

/**
 * Форма отображения спсика дисциплин
 * Class DistEducationFilterForm
 *
 * @property bool $isAdminDistEducation
 * @property null|WebUser $user
 * @property null|Grants $grants
 * @property null|K $chair
 * @property null|int $chairId
 */
class DistEducationFilterForm extends CFormModel
{
    /**
     * Прльзователь
     * @var null|WebUser
     */
    private $_user = null;

    /**
     * Права пользователя
     * @var null|Grants
     */
    private $_grants = null;

    /**
     * @var null|K
     */
    private $_chair = null;


    /**
     * Геттер для права пользователя
     * @see $grants
     * @return null|Grants
     */
    public function getGrants(){
        return $this->_grants;
    }

    /**
     * Getter for Пользователь
     * @see $user
     * @return null|WebUser
     */
    public function getUser(){
        return $this->_user;
    }

    /**
     * Геттер для кафедры пользователя
     * @see $chair
     * @return null|K
     */
    public function getChair(){
        return $this->_chair;
    }

    /**
     * Геттер для проперти IsAdminDistEducation
     * если админские права для закрепления
     * @see $isAdminDistEducation
     * @return bool
     */
    public function getIsAdminDistEducation(){
        if(empty($this->_user) || empty($this->_grants))
            return false;
        return $this->_user->isAdmin || ($this->_grants->getGrantsFor(Grants::DIST_EDUCATION_ADMIN) == 1);
    }

    /**
     * Для администраторов можно изменить кафедру
     * @param $chairId
     */
    public function setChairId($chairId){
        if(!$this->isAdminDistEducation)
            return;

        if(!empty($chairId))
            if($chairId!=$this->chairId)
                $this->_chair = K::model()->findByPk($chairId);
    }

    /**
     * Геттер для Код кафедры
     * @see $chairId
     * @return null|int
     */
    public function getChairId(){
        return !empty($this->chair) ? $this->chair->k1 : null;
    }

    /**
     * DistEducationFilterForm constructor.
     * @param WebUser $user
     * @param string $scenario
     */
    public function __construct(WebUser $user, $scenario = '')
    {
        parent::__construct($scenario);

        $this->_setUser($user);
    }

    /**
     * @param $user WebUser
     */
    private function _setUser($user){
        if($user==null)
            return;

        $this->_user = $user;

        $this->_chair = $this->_user->dbModel->chair;

        $this->_grants = $this->_user->dbModel->grants;
    }

    /**
     * Список дисциплин для зарупеления с дист образование для кафедры
     * @return CSqlDataProvider|null
     */
    public function getDispListForDistEducation(){

        $k1 = $this->chairId;

        if(empty($k1))
            return null;

        $params = array(
            ':K1' => $k1,
            ':YEAR' =>  Yii::app()->session['year'],
            ':SEM' =>  Yii::app()->session['sem']
        );

        $where = '';

        $sql = <<<SQL
          SELECT d2,d1,uo1,sem4,sp2, dispdist2, dispdist3, uo4
            FROM us
            INNER JOIN uo ON (US.US2 = UO.UO1)
            inner join u on (uo.uo22 = u.u1)
            inner join sg on (u.u2 = sg.sg1)
            inner join sp on (sg2 = sp1)
            INNER JOIN d ON (UO.uo3 = D.D1)
            INNER JOIN k ON (UO.uo4 = K.K1)
            INNER JOIN sem ON (Us.us3 = sem.sem1)
            LEFT JOIN dispdist on (uo.uo1 = dispdist1)
        WHERE uo4 =:K1 and sem3=:YEAR and sem5=:SEM {$where}
            group BY d2,d1,uo1,sem4,sp2, dispdist2, dispdist3, uo4
SQL;

        $countSQL =
            'SELECT COUNT(*) FROM (' .
                $sql.
            ') ';

        $command=Yii::app()->db->createCommand($countSQL);
        $command->params = $params;
        $count = $command->queryScalar();

        $sort = new CSort();
        $sort->sortVar = 'sort';
        $sort->defaultOrder = 'd2 ASC';
        $sort->attributes = array(
            'd2'=>array(
                'asc'=>'d2 ASC',
                'desc'=>'d2 DESC',
                'default'=>'ASC',
            ),
        );

        $pageSize=Yii::app()->user->getState('pageSize',10);
        if($pageSize==0)
            $pageSize=10;

        return new CSqlDataProvider($sql, array(
            'keyField' => 'uo1',
            'totalItemCount'=>$count,
            'params'=>$params,
            'sort'=>$sort,
            'pagination'=>array(
                'pageSize'=> $pageSize,
            ),
        ));
    }

    /**
     * Поучить инфо по дисциплине с проверкой доступа $uo1
     * @param $uo1
     * @return array|null
     */
    public function getDispInfo($uo1){
        if(empty($uo1))
            return null;

        $where = '' ;
        $params = array(
            ':UO1' => $uo1,
            ':YEAR' =>  Yii::app()->session['year'],
            ':SEM' =>  Yii::app()->session['sem']
        );

        if(!$this->isAdminDistEducation){
            $where = 'and uo4 =:K1';
            $params[':K1']= $this->chairId;
        }

        $sql = <<<SQL
          SELECT d2,d1,uo1,sem4,sp2, dispdist2, dispdist3, uo4
            FROM us
            INNER JOIN uo ON (US.US2 = UO.UO1)
            inner join u on (uo.uo22 = u.u1)
            inner join sg on (u.u2 = sg.sg1)
            inner join sp on (sg2 = sp1)
            INNER JOIN d ON (UO.uo3 = D.D1)
            INNER JOIN k ON (UO.uo4 = K.K1)
            INNER JOIN sem ON (Us.us3 = sem.sem1)
            LEFT JOIN dispdist on (uo.uo1 = dispdist1)
        WHERE sem3=:YEAR and sem5=:SEM and uo1=:UO1 {$where}
            group BY d2,d1,uo1,sem4,sp2, dispdist2, dispdist3, uo4
SQL;

        $params = array(
            ':UO1' => $uo1,
            ':YEAR' =>  Yii::app()->session['year'],
            ':SEM' =>  Yii::app()->session['sem']
        );

        $command=Yii::app()->db->createCommand($sql);
        $command->params = $params;
        $disp = $command->queryRow();

        return empty($disp)? null : $disp;
    }
}