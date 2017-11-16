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
    protected function _getParams()
    {
        return array();
    }

    /**
     * MoodleSignUpOldForm constructor.
     * @param int $universityId
     * @throws CHttpException
     */
    public function __construct($universityId)
    {
        if($universityId==U_NMU)
            throw new CHttpException(400, 'Не доступно');
        parent::__construct($universityId);
    }
}