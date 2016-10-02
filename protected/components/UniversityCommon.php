<?php

/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 02.10.2016
 * Time: 20:52
 */
class UniversityCommon extends CApplicationComponent
{
    /*++++++++++++++++++запорожье++++++++++++++++++++++++++++++*/
    const ZAP_SUPPORT_HREF = 'support.zsmu.zp.ua';//запорожье
    const REGISTER_TYPE = 'account';/*типы в параметр op*/
    const CHANGE_PASSWORD_TYPE = 'passwd';/*типы в параметр op*/
    /*мето для отпрваки пост завпроса для апи поддержки запорожья*/
    public static function SendZapApiRequest($type,$message){
        $pattern = '{
                "api" : "API_KEY",
                "op" : "%s",
                %s
        }';

        $src = sprintf($pattern, $type, $message);

        $url = 'http://'.self::ZAP_SUPPORT_HREF.'/index.php?api=yes';
        $curl = curl_init();
        $curlOptions = array(
            CURLOPT_URL=>$url,
            CURLOPT_FOLLOWLOCATION=>false,
            CURLOPT_POST=>true,
            CURLOPT_HEADER=>true,
            CURLOPT_RETURNTRANSFER=>true,
            /*CURLOPT_CONNECTTIMEOUT=>15,
            CURLOPT_TIMEOUT=>100,*/
            CURLOPT_POSTFIELDS=>$src,
            CURLOPT_HEADER => array(
                'Content-Type: text/xml; charset=utf-8',
                'Content-Length: '.strlen(($src)).''
            ),
        );
        curl_setopt_array($curl, $curlOptions) or die("cURL set options error" . curl_error($curl));
        if(false === ($result = curl_exec($curl))) {
            return false;
            //throw new Exception('Http request failed'. curl_error($curl));
        }else{
            return true;
        }
    }
    /*---------------------------запорожье-----------------------------+*/
}