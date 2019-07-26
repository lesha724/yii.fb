<?php

class ShortNameBehaviour extends CActiveRecordBehavior
{

    public $surname;
    public $name;
    public $patronymic;

    /**
     * Сокращенное имя
     * @return mixed|string
     */
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

    /**
     * Полное имя
     * @return string
     */
    public function geFullName()
    {
        $model = $this->owner;

        $fieldName = $this->surname;
        $res1 = $model->$fieldName;

        $fieldName = $this->name;
        $res2 = $model->$fieldName;

        $fieldName = $this->patronymic;
        $res3 = $model->$fieldName;

        return strtr('%s %s %s', $res1, $res2, $res3);
    }

    private function truncateText($text)
    {
        if (empty($text))
            return '';

        return ' '.mb_substr($text, 0,1).'.';
    }
}
