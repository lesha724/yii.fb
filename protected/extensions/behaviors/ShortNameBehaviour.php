<?php

class ShortNameBehaviour extends CActiveRecordBehavior
{

    public $surname;
    public $name;
    public $patronymic;

    public function getShortName()
    {
        $model = $this->owner;

        $fieldName = $this->surname;
        $res = $model->$fieldName;

        $fieldName = $this->name;
        $res .= $this->truncateText($model->$fieldName);

        $fieldName = $this->patronymic;
        $res .= $this->truncateText($model->$fieldName);

        return $res;
    }

    private function truncateText($text)
    {
        if (empty($text))
            return '';

        return ' '.mb_substr($text, 0,1).'.';
    }
}
