<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 18.01.2018
 * Time: 16:47
 */

/**
 * Форма для фильтров по рейтингу
 * Class RatingForm
 */
class RatingForm extends CFormModel
{
    const SPECIALITY = 1;

    const GROUP = 2;
    const STUDENT = 3;
    const COURSE = 4;

    /**
     * @var int филиал
     */
    public $filial = 0;

    /**
     * @var int факульетт
     */
    public $faculty;

    /**
     * @var int курс
     */
    public $course = 0;

    /**
     * Код группы
     * @var int| null
     */
    public $group;

    /**
     * Код студента
     * @var int| null
     */
    public $student;

    /**
     * Тип студентов
     * @var int
     * @see getStudentsTypes
     */
    public $stType = 0;

    /**
     * Тип Рейтинга (0 - рейтинг группы) (1- рейтинг потока)
     * @var int
     */
    public $ratingType = 0;

    /**
     * @var int семестр с
     */
    public $semStart;

    /**
     * @var int семестр по
     */
    public $semEnd;

    /**
     * validation rules
     * @return array
     */
    public function rules()
    {
        return array(
            array('filial, faculty, course, group, semStart, semEnd, ratingType, stType, student', 'numerical'),
            array('stType, ratingType', 'default', 'value'=>0, 'setOnEmpty'=>TRUE),
            array('filial, faculty, course, group, semStart, semEnd, ratingType, stType', 'required'),
        );
    }

    /**
     * attribute labels
     * @return array
     */
    public function attributeLabels()
    {
        $arr= array(
            'filial'=> tt('Учебн. заведение'),
            'faculty'=> tt('Факультет'),
        );

        $universityCode = Yii::app()->controller->universityCode;

        if($universityCode==7)
            $arr = array(
                'filial' => tt('Факультет'),
                'faculty' => tt('Вид подготовки'),
            );
        elseif($universityCode==15)
            $arr = array(
                'filial' => tt('Факультет'),
                'faculty' => tt('Направление подготовки'),
            );
        elseif ($universityCode==42)
            $arr = array(
                'filial' => tt('Факультет'),
                'faculty' => tt('Направление'),
            );

        return array_merge(
            array(
                'group'=> tt('Группа'),
                'course' => tt('Курс'),
                'semStart' => tt('Семестр с'),
                'semEnd' => tt('Семестр по'),
                'ratingType'=>tt('Рейтинг потока'),
                'stType'=>tt('Тип студентов'),
            ),
            $arr
        );
    }

    /**
     * Список типов студентов
     * @return array
     */
    public static function getStudentsTypes(){
        return array(
            0=>tt('Все'),
            1=>tt('Не иностранцы'),
            2=>tt('Иностранцы'),
        );
    }

    /**
     * Спиок
     * @see group
     * @return array
     */
    public function getSemestersForFilter(){
        if(empty($this->group))
            return array();

         return CHtml::listData(Sem::model()->getSemestersForRating($this->group, self::GROUP ), 'sem7', 'sem7', 'name');
    }

    /**
     * Код потока по группе
     * @see group
     * @return int
     */
    private function getSg1ByGroup(){
        if(empty($this->group))
            return 0;

        $gr = Gr::model()->findByPk($this->group);

        if(empty($gr))
            return 0;

        return $gr->gr2;
    }

    /**
     * Получить таблицу для рейтинга
     * @param $type int
     * @return array
     */
    public function getRating($type){
        switch ($type){
            case self::GROUP:
                return array();
                break;
            case self::STUDENT:
                return array();
                break;
            case self::COURSE:
                $sg1 = $this->getSg1ByGroup();

                return array();
                break;
            default:
                return array();
        }
    }
}