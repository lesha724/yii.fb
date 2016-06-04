<?php

/**
 * This is the model class for table "stus".
 *
 * The followings are the available columns in table 'stus':
 * @property integer $stus0
 * @property integer $stus1
 * @property integer $stus3
 * @property integer $stus4
 * @property integer $stus5
 * @property string $stus6
 * @property string $stus7
 * @property integer $stus8
 * @property string $stus9
 * @property integer $stus10
 * @property string $stus11
 * @property string $stus12
 * @property string $stus13
 * @property string $stus14
 * @property integer $stus16
 * @property integer $stus17
 * @property integer $stus18
 * @property integer $stus19
 * @property integer $stus20
 * @property integer $stus21
 */
class Stus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stus0, stus1, stus3, stus4, stus5, stus8, stus10, stus16, stus17, stus18, stus19, stus20, stus21', 'numerical', 'integerOnly'=>true),
			array('stus6, stus9, stus11', 'length', 'max'=>8),
			array('stus7', 'length', 'max'=>60),
			array('stus12, stus13, stus14', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('stus0, stus1, stus3, stus4, stus5, stus6, stus7, stus8, stus9, stus10, stus11, stus12, stus13, stus14, stus16, stus17, stus18, stus19, stus20, stus21', 'safe', 'on'=>'search'),
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
			'stus0' => 'Stus0',
			'stus1' => 'Stus1',
			'stus3' => 'Stus3',
			'stus4' => 'Stus4',
			'stus5' => 'Stus5',
			'stus6' => 'Stus6',
			'stus7' => 'Stus7',
			'stus8' => 'Stus8',
			'stus9' => 'Stus9',
			'stus10' => 'Stus10',
			'stus11' => 'Stus11',
			'stus12' => 'Stus12',
			'stus13' => 'Stus13',
			'stus14' => 'Stus14',
			'stus16' => 'Stus16',
			'stus17' => 'Stus17',
			'stus18' => 'Stus18',
			'stus19' => 'Stus19',
			'stus20' => 'Stus20',
			'stus21' => 'Stus21',
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

		$criteria->compare('stus0',$this->stus0);
		$criteria->compare('stus1',$this->stus1);
		$criteria->compare('stus3',$this->stus3);
		$criteria->compare('stus4',$this->stus4);
		$criteria->compare('stus5',$this->stus5);
		$criteria->compare('stus6',$this->stus6,true);
		$criteria->compare('stus7',$this->stus7,true);
		$criteria->compare('stus8',$this->stus8);
		$criteria->compare('stus9',$this->stus9,true);
		$criteria->compare('stus10',$this->stus10);
		$criteria->compare('stus11',$this->stus11,true);
		$criteria->compare('stus12',$this->stus12,true);
		$criteria->compare('stus13',$this->stus13,true);
		$criteria->compare('stus14',$this->stus14,true);
		$criteria->compare('stus16',$this->stus16);
		$criteria->compare('stus17',$this->stus17);
		$criteria->compare('stus18',$this->stus18);
		$criteria->compare('stus19',$this->stus19);
		$criteria->compare('stus20',$this->stus20);
		$criteria->compare('stus21',$this->stus21);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getMarksFor($st1, $start=0, $end=99)
    {
        if (empty($st1))
            return array();

        $sql = <<<SQL
            SELECT stus8
            FROM stus_an(0, 1, {$st1}, {$start}, {$end})
            WHERE stus19<>6
SQL;

        $command = Yii::app()->db->createCommand($sql);
        $marks = $command->queryColumn();

        return $marks;
    }

    public function getStatisticForDisciplines($st1, $start=0, $end=99)
    {
        if (empty($st1))
            return array();

        $sql = <<<SQL
            SELECT *
            FROM stus_an(0, 1, {$st1}, {$start}, {$end})
            ORDER BY STUS20_,d2
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $statistic = $command->queryAll();

        return $statistic;
    }

	public function getDispByStudentCard($st1,$gr1,$type)
	{
		if($type==0)
			$where = "WHERE stus19<>8";
		else
			$where = "WHERE stus19=8";
		$sql = <<<SQL
            SELECT stus18,d2,d27,uo1,uo6,uo12,uo10,uo5,u10,stus19 /*,
            (SELECT sum(us6) as sm FROM us WHERE us4=0 and us2=uo1) as sum_us6,
            (SELECT sum(us6) as sm FROM us WHERE us4 in (1,2,3,4,9,10,11,12) and us2=uo1) as sum_us6_aud*/
            FROM STUS_ST1(:ST1,1,99,:GR1)
            {$where}
            GROUP BY stus18,d2,d27,uo1,uo6,uo12,uo10,uo5,u10,stus19
			order by d2
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':GR1', $gr1);
		$disciplines = $command->queryAll();

		return $disciplines;
	}
	//функция получания экзаменов в электроном журнале
	/*public function getExam($uo1,$gr1,$sem1,$d1){

	}*/

	public function getMarkForDisp($st1, $d1, $sem7)
	{
		$sql = <<<SQL
            SELECT stus3,stus11, stus19, stus0 from stus
            WHERE stus1=:ST1 AND stus18=:D1 AND stus20=:SEM7
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ST1', $st1);
		$command->bindValue(':D1', $d1);
		$command->bindValue(':SEM7', $sem7);
		$mark = $command->queryRow();

		return $mark;
	}

	/*функция для переводов балов */
	private function getBalMarkb($bal,$type){
		$sql = <<<SQL
                              SELECT max(markb3) FROM markb WHERE markb2<=:BAL AND markb4=:TYPE
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':BAL', $bal);
		$command->bindValue(':TYPE', $type);
		$mark = $command->queryScalar();
		//print_r($mark);
		if(!empty($mark)){
			$bal_per = $mark;
		}else {
			$bal_per = 0;
		}

		return $bal_per;
	}

	private function recalculateXarcovMed($st1,$gr1,$sem7,$elg,$idUniversity,$stus,$marks){
		//print_r($stus->stus19);
		switch($stus->stus19){
			case 5:
				if(!empty($marks)) {
					$sym = 0;

					$count=0;
					foreach ($marks as $mark) {
						$bal = 0;
						if ($mark['elgzst3'] > 0) {
							$bal = $mark['elgzst5'];
						} else {
							$bal = ($mark['elgzst5'] > 0) ? $mark['elgzst5'] : $mark['elgzst4'];
						}
						$sym += $bal;
						//$count++;
					}

					$sql=<<<SQL
				  SELECT COUNT(*) FROM  elgz WHERE  elgz.elgz2=:ELGZ2 AND elgz.elgz4=0
SQL;
					$command = Yii::app()->db->createCommand($sql);
					$command->bindValue(':ELGZ2', $elg->elg1);
					$command->bindValue(':ST1', $st1);

					$count = $command->queryScalar();

					$elgsdInd = Elgsd::model()->findByAttributes(array('elgsd4'=>Elgsd::IND_TYPE));
					$elgsdExam = Elgsd::model()->findByAttributes(array('elgsd4'=>Elgsd::EXAM_TYPE));

					$elgsdSumm = Elgsd::model()->findByAttributes(array('elgsd4'=>Elgsd::SUM_TYPE));
					$elgsdSred = Elgsd::model()->findByAttributes(array('elgsd4'=>Elgsd::SRED_TYPE));
					$elgsdPerevod1 = Elgsd::model()->findByAttributes(array('elgsd4'=>Elgsd::PEREVOD_1_TYPE));

					$elgdInd = Elgd::model()->findByAttributes(array('elgd1'=>$elg->elg1,'elgd2'=>$elgsdInd->elgsd1));
					$elgdExam = Elgd::model()->findByAttributes(array('elgd1'=>$elg->elg1,'elgd2'=>$elgsdExam->elgsd1));

					$elgdSumm= Elgd::model()->findByAttributes(array('elgd1'=>$elg->elg1,'elgd2'=>$elgsdSumm->elgsd1));
					$elgdSred = Elgd::model()->findByAttributes(array('elgd1'=>$elg->elg1,'elgd2'=>$elgsdSred->elgsd1));
					$elgdPerevod1 = Elgd::model()->findByAttributes(array('elgd1'=>$elg->elg1,'elgd2'=>$elgsdPerevod1->elgsd1));

					if($elgsdInd==null||$elgsdExam==null)
						return;

					$balInd = Elgdst::model()->findByAttributes(array('elgdst1'=>$st1,'elgdst2'=>$elgdInd->elgd0));
					$balExam = Elgdst::model()->findByAttributes(array('elgdst1'=>$st1,'elgdst2'=>$elgdExam->elgd0));

					if($balInd==null)
					{
						$balInd = new Elgdst();
						$balInd->elgdst3 = 0;
					}

					if($balExam==null)
					{
						$balExam = new Elgdst();
						$balExam->elgdst3 = 0;
					}

					//print_r($sym.'<br>');
					/*если сумма балов +инд работа >120 то отнимаем разницу от суммы балов*/
					if($sym+$balInd->elgdst3>120){
						$sym-=$sym+$balInd-120;
					}

					/*запись суммы*/
					if($elgsdSumm!=null) {
						if ($elgdSumm != null) {
							$balSumm = Elgdst::model()->findByAttributes(array('elgdst1'=>$st1,'elgdst2'=>$elgdSumm->elgd0));
							if (empty($balSumm)) {
								$balSumm = new Elgdst();
								$balSumm->elgdst0 = new CDbExpression('GEN_ID(GEN_elgdst, 1)');
								$balSumm->elgdst1 = $st1;
								$balSumm->elgdst2 = $elgdSumm->elgd0;
							}

							$balSumm->elgdst3 = $sym;
							$balSumm->elgdst5 = Yii::app()->user->dbModel->p1;
							$balSumm->elgdst4 = date('Y-m-d H:i:s');
							$balSumm->save();
						}
					}
					//print_r($sym.'<br>');
					/*запись среднее*/
					$sr_bal = $sym/$count;
					/*запись среднего*/
					if($elgdSred!=null) {
						if ($elgdSred != null) {
							$balSred = Elgdst::model()->findByAttributes(array('elgdst1'=>$st1,'elgdst2'=>$elgdSred->elgd0));
							if (empty($balSred)) {
								$balSred = new Elgdst();
								$balSred->elgdst0 = new CDbExpression('GEN_ID(GEN_elgdst, 1)');
								$balSred->elgdst1 = $st1;
								$balSred->elgdst2 = $elgdSred->elgd0;
							}

							$balSred->elgdst3 = $sr_bal;
							$balSred->elgdst5 = Yii::app()->user->dbModel->p1;
							$balSred->elgdst4 = date('Y-m-d H:i:s');
							$balSred->save();
						}
					}

					$bal_per1 = $this->getBalMarkb($sr_bal,1);

					/*запись перевода*/
					if($elgdPerevod1!=null) {
						if ($elgdPerevod1 != null) {
							$balPerevod1 = Elgdst::model()->findByAttributes(array('elgdst1'=>$st1,'elgdst2'=>$elgdPerevod1->elgd0));
							if (empty($balPerevod1)) {
								$balPerevod1 = new Elgdst();
								$balPerevod1->elgdst0 = new CDbExpression('GEN_ID(GEN_elgdst, 1)');
								$balPerevod1->elgdst1 = $st1;
								$balPerevod1->elgdst2 = $elgdPerevod1->elgd0;
							}

							$balPerevod1->elgdst3 = $bal_per1;
							$balPerevod1->elgdst5 = Yii::app()->user->dbModel->p1;
							$balPerevod1->elgdst4 = date('Y-m-d H:i:s');
							$balPerevod1->save();
						}
					}

					$bal_itog = 0;
					if($bal_per1+$balInd->elgdst3>=70&&$bal_per1+$balInd->elgdst3<=120){
						$bal_itog=$bal_per1+$balInd->elgdst3+$balExam->elgdst3;

						$bal_itog = $this->getBalMarkb($bal_itog,2);
						$stus->stus3 = $bal_itog;
						$cxmb= Cxmb::model()->getMark($bal_itog);
						$stus->stus11 = $cxmb['cxmb3'];
						$stus->save();
					}
				}
				break;
		}
	}

	public function recalculateStusMark($st1,$gr1,$sem7,$elg){
		$idUniversity = SH::getUniversityCod();

		if($idUniversity==0)
			return;

		//print_r($idUniversity.'<br>');
		$sql = <<<SQL
            SELECT uo3 from elg
            	INNER JOIN uo on (elg2=uo1)
            WHERE elg1=:ELG1
SQL;
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':ELG1', $elg->elg1);
		$d1 = $command->queryScalar();

		//print_r($d1.'<br>');
		if(!empty($d1)){
			$stus = Stus::model()->findByAttributes(array('stus1'=>$st1,'stus18'=>$d1,'stus20'=>$sem7));
			if($stus!=null){
				$sql=<<<SQL
				  SELECT elgzst5,elgzst4,elgzst3 FROM elgzst
				  INNER JOIN elgz on (elgzst.elgzst2 = elgz.elgz1 AND elgz.elgz2=:ELGZ2 AND elgz.elgz4=0)
				  WHERE elgzst1=:ST1 ORDER by elgz3 asc
SQL;
					$command = Yii::app()->db->createCommand($sql);
					$command->bindValue(':ELGZ2', $elg->elg1);
					$command->bindValue(':ST1', $st1);
					$marks= $command->queryAll();

					switch($idUniversity){
						case 38:
							$this->recalculateXarcovMed($st1,$gr1,$sem7,$elg,$idUniversity,$stus,$marks);
							break;
					}
			}
		}
	}
}
