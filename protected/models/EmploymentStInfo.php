<?php


class EmploymentStInfo extends CFormModel
{
	public $phone;
	public $email;
	public $topic;
	public $experience;
	public $interests;
	public $workPlace;
	public $showStatistic;
	public $showComments;


	public function rules()
	{
		return array(
			array('phone', 'length', 'max' => 45),
			array('email', 'length', 'max' => 75),
			array('email', 'email'),
			array('topic', 'length', 'max' => 1500),
			array('experience', 'length', 'max' => 350),
			array('interests', 'length', 'max' => 350),
			array('workPlace', 'length', 'max' => 350),
			array('showStatistic, showComments', 'numerical'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'phone'=>tt('Телефон').':',
			'email'=>tt('Email').':',
			'topic'=>tt('Тема диплома').':',
			'experience'=>tt('Опыт работы').':',
			'interests'=>tt('Интересы').':',
			'workPlace'=>tt('Место работы').':',
			'showStatistic'=>tt('Отображать статистику успеваемости').':',
			'showComments'=>tt('Отображать комментарии преподавателей').':',
		);
	}

    public function loadData($st1)
    {
        $sdp = Sdp::model()->findByPk($st1);

        if (empty($sdp))
            return;

        $this->phone         = $sdp->sdp30;
        $this->email         = $sdp->sdp31;
        $this->topic         = $sdp->sdp4;
        $this->experience    = $sdp->sdp26;
        $this->interests     = $sdp->sdp27;
        $this->workPlace     = $sdp->sdp28;
        $this->showStatistic = $sdp->sdp32;
        $this->showComments  = $sdp->sdp33;
    }

}