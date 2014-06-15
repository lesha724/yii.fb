<?php

/**
 * Dummy class to use default Yii preload feature
 */
class ShortCodes extends CApplicationComponent
{
    public static function getShortName($surname, $name, $patronymic)
    {
        $res = $surname;

        $res .= self::truncateText($name);
        $res .= self::truncateText($patronymic);

        return $res;
    }

    public static function truncateText($text)
    {
        if (empty($text))
            return '';

        return ' '.mb_substr($text, 0,1).'.';
    }

    public static function formatDate($patternFrom, $patternTo, $value)
    {
        if (empty($value))
            return null;

        try{
            $result = DateTime::createFromFormat($patternFrom, $value)->format($patternTo);
        } catch(Exception $e) {
            $result = null;
        }

        return $result;
    }

    public static function convertUS4($us4)
    {
        switch($us4){
            case 0:	$type = tt('Всего'); break;
            case 1:	$type = tt('Лк'); break;
            case 2:	$type = tt('Пз'); break;
            case 3:	$type = tt('Сем'); break;
            case 4:	$type = tt('Лб'); break;
            case 5:	$type = tt('Экз'); break;
            case 6:	$type = tt('Зч'); break;
            case 7:	$type = tt('Кр'); break;
            case 8:	$type = tt('КП'); break;
            case 9: $type = tt('УЛк'); break;
            case 10: $type = tt('УПз'); break;
            case 11: $type = tt('УСем'); break;
            case 12: $type = tt('УЛб'); break;
            case 13: $type = tt('Доп'); break;
            case 14: $type = tt('Инд'); break;
            case 15: $type = ''; break;
            case 16: $type = tt('КнЧ'); break;
            case 17: $type = tt('Конс'); break;
            case 18: $type = tt('Пер'); break;
            default: $type='';
        }
        return $type;
    }

    public static function getLessonColor($type)
    {
        $type = mb_strtolower($type);
        switch($type){
            case 'лк':
            case 'улк':
                $color = '#fffadb'; break;
            case 'пз':
            case 'пз1':
            case 'пз2':
            case 'пз3':
            case 'пз4':
            case 'упз':
                $color = '#e2ffe2'; break;
            case 'сем':
            case 'сем1':
            case 'сем2':
            case 'сем3':
            case 'сем4':
                $color = '#fff0ff'; break;
            case 'лб':
            case 'лб1':
            case 'лб2':
            case 'лб3':
            case 'лб4':
            case 'улб':
            case 'улб1':
            case 'улб2':
            case 'улб3':
            case 'улб4':
                $color = '#c4e5ff'; break;
            case 'экз':	$color = '#ffe1e1'; break;
            case 'зач':	$color = '#ddffdd'; break;
            case 'кр':	$color = '#d6d6bd'; break;
            case 'кп':	$color = '#d4d4b9'; break;
            case 'доп': $color = '#e3ebe4'; break;
            case 'инд': $color = '#fffadd'; break;
            case 'гек': $color = '#ff0000'; break;
            case 'кнч': $color = '#dfefff'; break;
            case 'конс': $color = '#ffe2ff'; break;
            case 'пер': $color = '#e2ffe2'; break;
            default: $color = '';
        }
        return $color;
    }

    public static function getCurrentYearAndSem()
    {
        if (date('n') >= 8) {
            $year = date('Y');
            $sem  = 0;
        } else {
            $year = date('Y', strtotime('-1 year'));
            $sem  = 1;
        }

        return array($year, $sem);
    }

    public static function convertEducationType($sg4)
    {
        switch($sg4){
            case 0:	$type = tt('Дневная'); break;
            case 1:	$type = tt('Заочная'); break;
            case 2:	$type = tt('Вечерняя'); break;
            case 3:	$type = tt('Экстернат'); break;
            case 4:	$type = tt('Второе высшее'); break;
            default: $type='';
        }
        return $type;
    }

    public static function convertSem5($sem5)
    {
        switch($sem5){
            case 0:	$type = tt('Осенний'); break;
            case 1:	$type = tt('Весенний'); break;
            default: $type='';
        }
        return $type;
    }

    public static function showIcon($val)
    {
        $isPrint = stristr(Yii::app()->controller->action->id, 'print');
        if ($val == 1) {
            $symbol = ! $isPrint
                        ? '<i class="icon-ok green"></i>'
                        : '+';
        } else {
            $symbol = ! $isPrint
                        ? '<i class="icon-remove red"></i>'
                        : '-';
        }

        return $symbol;
    }

    public static function is($code)
    {
        return Yii::app()->params['code'] == $code;
    }
}

class SH extends ShortCodes
{

}




/**
 * Translates string to current language.
 * @see Yii::t()
 * @param string $str
 * @param array $params
 * @return string
 */
function tt($str, $params = array())
{
	return Yii::t('main', $str, $params);
}

