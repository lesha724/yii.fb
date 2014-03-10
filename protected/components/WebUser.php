<?php

class WebUser extends CWebUser
{
    private $_model = null;

    public function getModel()
    {
        $id = Yii::app()->user->id;

        if (! $this->isGuest && $this->_model === null) {
            $this->_model = Users::model()->findByPk($id);
        }
        return $this->_model;
    }

    public function getIsAdmin()
    {
        return !$this->isGuest && $this->model->isAdmin;
    }

    public function getName()
    {
        if (! $this->isGuest)
            return $this->model->name;

        return 'Guest';
    }

    public function getIsTch()
    {
        //if ($this->isAdmin)
        //    return true;

        return !$this->isGuest && $this->model->isTeacher;
    }

    public function getIsStd()
    {
        //if ($this->isAdmin)
        //    return true;

        return !$this->isGuest && $this->model->isStudent;
    }

    public function getDbModel()
    {
        $model = null;

        if ($this->isTch)
            $model = P::model()->findByPk($this->model->u6);
        elseif ($this->isStd)
            $model = St::model()->findByPk($this->model->u6);

        return $model;
    }

}

