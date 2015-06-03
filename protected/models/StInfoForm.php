<?php

class StInfoForm extends CFormModel
{
    public $st34;
	public $st74;
	public $st75;
	public $st76;
	public $st107;

	public $speciality;


	public function rules()
	{
		return array(
			array('st74', 'length', 'max'=>35),
			array('st75, st76', 'length', 'max'=>20),
			array('st107', 'email'),
			array('speciality, st34', 'safe'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'st34'=> tt('Специализация'),
			'st74'=> tt('Фамилия (англ.)'),
			'st75'=> tt('Имя (англ.)'),
			'st76'=> tt('Отчество (англ.)'),
			'st107'=> 'Email',
		);
	}

    public function customSave(TimeTableForm $model)
    {
        if (! $model->student)
            return;

        $res1 = St::model()->updateByPk($model->student, array(
            'st34' => $this->st34,
            'st74' => $this->st74,
            'st75' => $this->st75,
            'st76' => $this->st76,
            'st107' => $this->st107,
        ));

        $res2 = Users::model()->updateAll(array(
            'u4' => $this->st107
        ), 'u5 =0 and u6 = '.$model->student);

        return $res1 && $res2;
    }

    public function fillData(TimeTableForm $model)
    {
        if (! $model->student)
            return;

        $st = St::model()->findByPk($model->student);

        $this->st34 = $st->st34;
        $this->st74 = $st->st74;
        $this->st75 = $st->st75;
        $this->st76 = $st->st76;
        $this->st107 = $st->st107;
        $this->speciality = Pnsp::model()->getSpecialityFor($st->st1);
    }

}