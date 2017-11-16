<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 16.11.2017
 * Time: 17:07
 */

/**
 * Class SingUpOldDistEducationForm
 * @property $params array Массив параметров для привязки к сущетвующей учетке
 * @property $universityId int Код вуза
 */
abstract class SingUpOldDistEducationForm extends CFormModel implements ISingUpOldDistEducationForm
{
    /**
     * @var int Код вуза
     */
    protected $_universityId;

    /**
     * Код вуза
     * @return int
     */
    public function getUniversityId()
    {
        return $this->_universityId;
    }

    /**
     * Массив параметров для привязки к сущетвующей учетке
     * @return array
     */
    public function getParams()
    {
        return $this->_getParams();
    }

    /**
     * Массив параметров для привязки к сущетвующей учетке
     * @return array
     */
    abstract protected function _getParams();

    /**
     * SingUpOldDistEducationForm constructor.
     * @param int $universityId
     */
    public function __construct($universityId)
    {
        $this->_universityId = $universityId;
        parent::__construct($universityId);
    }
}