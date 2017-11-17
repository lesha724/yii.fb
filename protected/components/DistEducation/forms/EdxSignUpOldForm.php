<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 16.11.2017
 * Time: 17:19
 */

/**
 * Class EdxSignUpOldForm
 * @property $params array
 * @property $universityId int Код вуза
 */
class EdxSignUpOldForm extends SingUpOldDistEducationForm
{
    /**
     * @return array
     */
    public function rules()
    {
        return parent::rules();
    }

    /**
     * @return array
     */
    protected function _getParams()
    {
        return array();
    }

    /**
     * EdxSignUpOldForm constructor.
     * @param int $universityId
     * @throws CHttpException
     */
    public function __construct($universityId)
    {
        parent::__construct($universityId);
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return parent::attributeLabels();
    }
}