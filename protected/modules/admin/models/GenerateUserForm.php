<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 30.09.14
 * Time: 9:12
 */
class GenerateUserForm extends CFormModel
{
    public $lastName;
    public $firstName;
    public $secondName;
    public $type;
    public $bDate;

    public $users;

    public function rules()
    {
        return array(
			array('type', 'numerical', 'integerOnly'=>true),
			array('lastName,firstName,secondName, users', 'type', 'type'=>'string'),
            array('bDate', 'type', 'type'=>'date'),
		);
    }

    public function attributeLabels()
    {
        return array(
            'lastName' => tt('Фамилия'),
            'firstName'=>tt('Имя'),
            'secondName'=>tt('Отчество'),
            'bDate'=>tt('Дата рождения'),
            'type'=>tt('Тип'),
        );
    }

    public static function getTypes(){
        return array(1=>tt('Студент'),2=>tt('Преподователь'),3=>tt('Родитель'));
    }

    public static function getType($type){
        $types = self::getTypes();
        if(isset($types[$type+1]))
            return $types[$type+1];
        else
            return '-';
    }

    public function search(){
        $where = '';

        if(!empty($this->lastName))
        {
            $where.=" AND last_name CONTAINING '".$this->lastName."'";
        }

        if(!empty($this->firstName))
        {
            $where.=" AND first_name CONTAINING '".$this->firstName."'";
        }

        if(!empty($this->secondName))
        {
            $where.=" AND second_name CONTAINING '".$this->secondName."'";
        }

        if(!empty($this->bDate))
        {
            $where.=" AND b_date CONTAINING '".date_format(date_create_from_format('d-m-Y', trim($this->bDate)), 'Y-m-d')."'";
        }

        if(!empty($this->type))
        {
            $where.=' AND type = '.($this->type-1);
        }

        $sql = 'SELECT st1 as id, st2 as last_name, st3 as first_name, st4 as second_name, 0 as type, st7 as b_date FROM st';
        $sql.= ' UNION ';
        $sql .= 'SELECT p1 as id, p3 as last_name, p4 as first_name, p5 as second_name, 1 as type, p9 as b_date FROM p';
        $sql.= ' UNION ';
        $sql .= 'SELECT st1 as id, st2 as last_name, st3 as first_name, st4 as second_name, 2 as type, st7 as b_date FROM st';
        $sql = 'SELECT * FROM ('.$sql.') t WHERE last_name<>\'\' AND (SELECT COUNT(*) FROM USERS WHERE u6=t.id and u5=t.type)=0 '.$where;
        $rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
        $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_record')->queryScalar(); //the count


        return new CSqlDataProvider($rawData, array(
            'keyField' => 'id',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'type',
                    'firstName'=>array(
                        'asc'=>'first_name asc',
                        'desc'=>'first_name desc'
                    ),
                    'secondName'=>array(
                        'asc'=>'second_name asc',
                        'desc'=>'second_name desc'
                    ),
                    'lastName'=>array(
                        'asc'=>'last_name asc',
                        'desc'=>'last_name desc'
                    ),
                    'bDate'=>array(
                        'asc'=>'b_date asc',
                        'desc'=>'b_date desc'
                    )
                ),
                'defaultOrder' => array(
                    'id' => CSort::SORT_ASC, //default sort value
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize',10),
            ),
        ));
    }
}
?>