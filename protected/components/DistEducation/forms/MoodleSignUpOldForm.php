<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 16.11.2017
 * Time: 17:18
 */

/**
 * Class MoodleSignUpForm
 * @property $params array
 * @property $universityId int Код вуза
 */
class MoodleSignUpOldForm extends SingUpOldDistEducationForm
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
        return parent::_getParams();
    }

    /**
     * MoodleSignUpOldForm constructor.
     * @param int $universityId
     * @throws CHttpException
     */
    public function __construct($universityId)
    {
        /*if($universityId==U_NMU)
            throw new CHttpException(400, 'Не доступно');*/
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