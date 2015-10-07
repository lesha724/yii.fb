<?php

/**
 * This is the model class for table "stego".
 *
 * The followings are the available columns in table 'stego':
 * @property integer $stego1
 * @property double $stego2
 * @property string $stego3
 * @property integer $stego4
 *
 * The followings are the available model relations:
 * @property Stegn $stego10
 * @property P $stego40
 */
class Stego extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stego';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stego1, stego4', 'numerical', 'integerOnly'=>true),
			array('stego2', 'numerical'),
			array('stego3', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('stego1, stego2, stego3, stego4', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'stego10' => array(self::BELONGS_TO, 'Stegn', 'stego1'),
			'stego40' => array(self::BELONGS_TO, 'P', 'stego4'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stego1' => 'Stego1',
			'stego2' => tt('Оценка'),
			'stego3' => tt('Дата'),
			'stego4' => tt('Преподаватель'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('stego1',$this->stego1);
		$criteria->compare('stego2',$this->stego2);
		$criteria->compare('stego3',$this->stego3,true);
		$criteria->compare('stego4',$this->stego4);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stego the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getTeacher($stegn)
        {
            if (empty($stegn))
                return array();

            $today = date('d.m.Y 00:00');
            $sql = <<<SQL
                SELECT P1,P3,P4,P5
                FROM P
                    INNER JOIN PD ON (P1=PD2)
                WHERE PD4 = (select first 1 nr30
                    from us
                       inner join stegn on (us.us1 = stegn.stegn2)
                       inner join nr on (us.us1 = nr.nr2)
                       inner join ug on (nr.nr1 = ug.ug3)
                       inner join ucgn on (ug.ug4 = ucgn.ucgn1)
                       inner join ucgns on (ucgn.ucgn1 = ucgns.ucgns2)
                       inner join ucsn on (ucgns.ucgns1 = ucsn.ucsn1)
                       inner join r on (nr.nr1 = r.r1)
                    where r2 = :stegn9 and ucsn2 = :stegn1 and stegn2=:stegn2 )
                    and PD28 in (0,2,5,9) and PD3=0 and (PD13 IS NULL or PD13>'{$today}')
                group by P1,P3,P4,P5
                ORDER BY P3 collate UNICODE
SQL;
            $command=Yii::app()->db->createCommand($sql);
            $command->bindValue(':stegn9', $stegn->stegn9);
            $command->bindValue(':stegn1', $stegn->stegn1);
            $command->bindValue(':stegn2', $stegn->stegn2);
            $teachers = $command->queryAll();
            foreach ($teachers as $key => $tch) {
                $teachers[ $key ]['name'] = SH::getShortName($tch['p3'], $tch['p4'], $tch['p5']);
            }
            return $teachers;
        }

    public function getStego2ArrByLk()
    {
        return array('0'=>tt('Не отрботано'),'-1'=>tt('Отработано'));
    }

    public function getStego2ByLk()
    {
        switch ($this->stego2) {
            case 0:
                return tt('Не отрботано');
                break;
            case -1:
                return tt('Отработано');
                break;
            default:
                return '-';
        }
    }
}
