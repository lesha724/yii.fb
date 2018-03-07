<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 06.03.2018
 * Time: 18:32
 */

/**
 * Class EmailValidator валидатор почті
 * @property array $universitiesDomens
 */
class EmailValidator extends CEmailValidator
{
    /**
     * Соотвествия кодов вузов и
     * @return array
     */
    public function getUniversitiesDomens(){
        return $this->_universitiesDomens;
    }
    /**
     * Домені университета
     * @var array
     */
    private $_universitiesDomens = array(
        U_NMU => 'nmu.ua',
        U_ZSMU => 'zsmu.edu.ua'
    );
    /**
     * Нужно ли валидировать домен
     * @var bool
     */
    public $validateDomen = false;

    /**
     * Код университета
     * @var int
     */
    public $universityCode;

    /**
     * Validates a static value to see if it is a valid email.
     * This method is provided so that you can call it directly without going through the model validation rule mechanism.
     *
     * Note that this method does not respect the {@link allowEmpty} property.
     *
     * @param mixed $value the value to be validated
     * @return boolean whether the value is a valid email
     * @since 1.1.1
     * @see https://github.com/yiisoft/yii/issues/3764#issuecomment-75457805
     * @throws CException
     */
    public function validateValue($value)
    {
        $result = parent::validateValue($value);

        if($result && $this->validateDomen){

            return $this->validateDomen($value);
        }

        return $result;
    }

    /**
     * Валидирование домена
     * @param $value
     * @return bool
     * @throws CException
     */
    public function validateDomen($value){
        if(empty($this->universityCode))
            throw new CException('Ошибка настройки: не задан код универстита');

        if(!isset($this->_universitiesDomens[$this->universityCode]))
            return true;

        $domain = rtrim(substr($value, strpos($value, '@') + 1), '>');

        return $domain == $this->_universitiesDomens[$this->universityCode];
    }

    /**
     * Validates the attribute of the object.
     * If there is any error, the error message is added to the object.
     * @param CModel $object the object being validated
     * @param string $attribute the attribute being validated
     */
    protected function validateAttribute($object,$attribute)
    {
        $value=$object->$attribute;
        if($this->allowEmpty && $this->isEmpty($value))
            return;

        if(!$this->validateValue($value))
        {
            if($this->validateDomen && isset($this->_universitiesDomens[$this->universityCode])){
                $this->message = tt('{attribute} не является правильным E-Mail адресом в домене {domen}.', array(
                    '{attribute}'=>$object->getAttributeLabel($attribute),
                    '{domen}' => $this->_universitiesDomens[$this->universityCode]
                ));
            }

            $message=$this->message!==null?$this->message:Yii::t('yii','{attribute} is not a valid email address.');
            $this->addError($object,$attribute,$message);
        }
    }
}