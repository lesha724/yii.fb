<?php

/**
 * This is the model class for table "u".
 *
 * The followings are the available columns in table 'u':
 * @property integer $u1
 * @property integer $u2
 * @property integer $u8
 * @property integer $u9
 * @property integer $u10
 * @property integer $u15
 * @property string $u16
 * @property integer $u17
 * @property integer $u18
 * @property integer $u19
 * @property string $u20
 * @property double $u21
 * @property double $u22
 * @property double $u23
 * @property string $u25
 * @property integer $u26
 */
class U extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'u';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('u1', 'required'),
			array('u1, u2, u8, u9, u10, u15, u17, u18, u19, u26', 'numerical', 'integerOnly'=>true),
			array('u21, u22, u23', 'numerical'),
			array('u16', 'length', 'max'=>40),
			array('u20', 'length', 'max'=>300),
			array('u25', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('u1, u2, u8, u9, u10, u15, u16, u17, u18, u19, u20, u21, u22, u23, u25, u26', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'u1' => 'U1',
			'u2' => 'U2',
			'u8' => 'U8',
			'u9' => 'U9',
			'u10' => 'U10',
			'u15' => 'U15',
			'u16' => 'U16',
			'u17' => 'U17',
			'u18' => 'U18',
			'u19' => 'U19',
			'u20' => 'U20',
			'u21' => 'U21',
			'u22' => 'U22',
			'u23' => 'U23',
			'u25' => 'U25',
			'u26' => 'U26',
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

		$criteria->compare('u1',$this->u1);
		$criteria->compare('u2',$this->u2);
		$criteria->compare('u8',$this->u8);
		$criteria->compare('u9',$this->u9);
		$criteria->compare('u10',$this->u10);
		$criteria->compare('u15',$this->u15);
		$criteria->compare('u16',$this->u16,true);
		$criteria->compare('u17',$this->u17);
		$criteria->compare('u18',$this->u18);
		$criteria->compare('u19',$this->u19);
		$criteria->compare('u20',$this->u20,true);
		$criteria->compare('u21',$this->u21);
		$criteria->compare('u22',$this->u22);
		$criteria->compare('u23',$this->u23);
		$criteria->compare('u25',$this->u25,true);
		$criteria->compare('u26',$this->u26);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return U the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getMinMAxBlocks($sg1)
    {
        $sql = <<<SQL
          SELECT min(u9) as MIN_BLOK, max(u9) as MAX_BLOK
          FROM u
          WHERE u2=:SG1 and u9>0
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SG1', $sg1);
        $row = $command->queryRow();

        return array($row['min_blok'], $row['max_blok']);
    }

    public function getU9($sg1_kod, $block)
    {
        $sql = <<<SQL
          SELECT first 1 u9 as U9_ROOT
          FROM u
          WHERE u1 IN (
            SELECT u17
            FROM u
            WHERE u2=:SG1_KOD and u9=:BLOCK
         )
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SG1_KOD', $sg1_kod);
        $command->bindValue(':BLOCK', $block);
        $u9_root = $command->queryScalar();

        return $u9_root;
    }

    public function getU17($sg1_kod, $block)
    {
        $sql = <<<SQL
         SELECT first 1 u17 as U1_ROOT
         FROM u
         WHERE u2=:SG1_KOD and u9=:BLOCK
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SG1_KOD', $sg1_kod);
        $command->bindValue(':BLOCK', $block);
        $u1_root = $command->queryScalar();

        return $u1_root;
    }

    public function getU1($sg1_kod, $block, $u1_vib)
    {
        $sql = <<<SQL
          SELECT first 1 u1
          FROM u
          WHERE u2=:SG1_KOD and u9=:BLOCK and u17 in ({$u1_vib})
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SG1_KOD', $sg1_kod);
        $command->bindValue(':BLOCK', $block);
        $u1 = $command->queryScalar();

        return $u1;
    }

    public function getAnalyze($uch_god, $semester, $block, $sg1_kod)
    {
        $subSql = <<<SQL
        select u1 from u where u2={$sg1_kod} and u9={$block}
SQL;

        $sql = <<<SQL
            select first 1 u1 as ANALIZIROVAT
            from u
            inner join uo on (u1 = uo.uo22)
            inner join us on (uo.uo1 = us.us2)
            inner join sem on (us.us3 = sem.sem1)
            where (sem3 = {$uch_god}) and (sem5 = {$semester}) and (
                (u1 in ({$subSql})) or
                (u1 in (select u1 from u where u17 in ({$subSql}))) or
                (u1 in (select u1 from u where u17 in (select u1 from u where u17 in ({$subSql}))))
            )
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $u1 = $command->queryScalar();

        return $u1;
    }

    public function getU1_VIBRAL($st1, $u1_kod, $block, $sg1_kod)
    {
        $subSql = <<<SQL
        select u1 from u where u1={$u1_kod} and u2={$sg1_kod} and u9={$block}
SQL;

        $sql = <<<SQL
            SELECT u1 as U1_VIBRAL
            FROM u
            INNER JOIN uo on (u.u1 = uo22)
            INNER JOIN (select ucx1 from ucx where ucx5>1) on (uo19 = ucx1)
            INNER JOIN ucxg on (ucx1 = ucxg1)
            INNER JOIN ucgn on (ucxg2 = ucgn1)
            INNER JOIN ucgns on (ucgn1 = ucgns2)
            INNER JOIN (select ucsn1,ucsn2 from ucsn where ucsn2={$st1}) on (ucgns1 = ucsn1)
            WHERE
                ucsn2 is not null and
                (u1 in ({$subSql}))or
                (u1 in (select u1 from u where u17 in ({$subSql})))or
                (u1 in (select u1 from u where u17 in (select u1 from u where u17 in ({$subSql}))))
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $u1 = $command->queryScalar();

        return $u1;
    }

    public function getU1_KOD($block, $sg1_kod)
    {
        $sql = <<<SQL
          SELECT u1 as U1_KOD
          FROM u
          WHERE u2=:SG1_KOD and u9=:BLOCK
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SG1_KOD', $sg1_kod);
        $command->bindValue(':BLOCK', $block);
        $u1 = $command->queryColumn();

        return $u1;
    }

    public function getKOL($block, $sg1_kod)
    {
        $sql = <<<SQL
          SELECT count(*) as KOL
          FROM u
          WHERE u2=:SG1_KOD and u9=:BLOCK
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SG1_KOD', $sg1_kod);
        $command->bindValue(':BLOCK', $block);
        $u1 = $command->queryScalar();

        return $u1;
    }

    public function get_U1($block, $sg1_kod)
    {
        $sql = <<<SQL
          SELECT U1
          FROM u
          WHERE u2=:SG1_KOD and u9=:BLOCK
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':SG1_KOD', $sg1_kod);
        $command->bindValue(':BLOCK', $block);
        $u1 = $command->queryScalar();

        return $u1;
    }
}
