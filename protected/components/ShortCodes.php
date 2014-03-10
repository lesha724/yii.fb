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

