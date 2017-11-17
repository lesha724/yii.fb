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
     * @var string
     */
    public $email;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array('email', 'required'),
            // email has to be a valid email address
            array('email', 'email'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'email'=>tt('Email'),
        );
    }

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