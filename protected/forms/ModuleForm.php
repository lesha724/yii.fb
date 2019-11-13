<?php

/**
 * Class ModuleForm
 */
class ModuleForm extends CFormModel
{
    /**
     * @var int
     */
    public $discipline;

    /**
     * @var int
     */
    public $group;

    protected $_teacherId;

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('discipline, group', 'numerical'),
            array('discipline, group', 'required'),
        );
    }

    /**
     * ModuleForm constructor.
     * @param $teacherId
     * @param string $scenario
     */
    public function __construct($teacherId, $scenario = '')
    {
        parent::__construct($scenario);
        $this->_teacherId = $teacherId;
    }

    /**
     * attribute labels
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'discipline'=>tt('Дисциплина'),
            'group'=>tt('Группа')
        );
    }

    /**
     * саисок дисиплин преподователя для ввода модульного окнтпроля
     * @return array
     * @throws CException
     */
    public function getDisciplines(){
        $sql = <<<SQL
            select d2,d1
                from sem
                   inner join us on (sem.sem1 = us.us3)
                   inner join nr on (us.us1 = nr.nr2)
                   inner join pd on (nr.nr6 = pd.pd1 and pd2=:P1)
                   inner join uo on (us.us2 = uo.uo1)
                   inner join d on (uo.uo3 = d.d1)
                where us4 in (5,6,8) and d8=0 and sem3=:YEAR and sem5=:SEM
                group by d2,d1
                order by d2 collate UNICODE
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', $this->_teacherId);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        return $command->queryAll();
    }

    /**
     * Список групп по дисциплине
     * @param $discipline
     * @return array
     * @throws CException
     */
    public function getGroups($discipline){
        if(empty($discipline))
            return array();

        $sql = <<<SQL
            select sg4,gr7,gr3,gr1,us1,uo1
            from sg
               inner join gr on (sg.sg1 = gr.gr2)
               inner join ug on (gr.gr1 = ug.ug2)
               inner join nr on (ug.ug1 = nr.nr1)
               inner join us on (nr.nr2 = us.us1)
               inner join sem on (us.us3 = sem.sem1)
               inner join uo on (us.us2 = uo.uo1)
               inner join pd on (nr.nr6 = pd.pd1 and pd2=:P1)
            where us4 in (5,6,8) and sem3=:YEAR and sem5=:SEM and uo3=:D1
            group by sg4,gr7,gr3,gr1,us1,uo1
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':P1', $this->_teacherId);
        $command->bindValue(':D1', $discipline);
        $command->bindValue(':YEAR', Yii::app()->session['year']);
        $command->bindValue(':SEM', Yii::app()->session['sem']);
        $rows = $command->queryAll();

        $result = array();
        foreach ($rows as $row){
            $result[$row['us1'].'/'.$row['gr1']] = $row['gr3'];
        }
        return $result;
    }
}