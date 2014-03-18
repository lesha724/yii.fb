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

