<?php
/**
 * Created by PhpStorm.
 * User: Lesha
 * Date: 19.08.2019
 * Time: 11:50
 */

/**
 * @var $KBK string
 * @var $TypeScore int
 * @var $OKTMO string
 * @var $INN string
 * @var $KPP string
 * @var $CompanyName string
 * @var $ChkAcc string
 * @var $BankName string
 * @var $KBK string
 * @var $BIK string
 * @var $sk6 string
 * @var $sk7 string
 * @var $price double
 * @var $ServiceCode string
 */

$rubles = intval($price);
$penny= round($price - $rubles, 2) * 100;
$priceStr =  $rubles.' '.tt( 'рубль|рубля|рублей|рубль', $rubles ).' '.$penny.' '.tt( 'копейка|копейки|копеек|копейка', $penny);

$text = strtr(
    'ST00012|Name={CompanyName}|PersonalAcc={ChkAcc}|BankName={BankName}|BIC={BIK}|CorrespAcc=0|PayeeINN={INN}|KPP={KPP}|CBC={KBK}|OKTMO={OKTMO}|contract={sk6}|Branch=ЮРИДИЧЕСКИЙ ФАКУЛЬТЕТ|PayType={PayType}|ServiceName={ServiceCode}|instNum=|childFio={STName}|LASTNAME={sk7}|Sum={Price}',
    array(
        '{CompanyName}' => $CompanyName,
        '{ChkAcc}' => $ChkAcc,
        '{BankName}' => $BankName,
        '{BIK}' => $BIK,
        '{INN}' => $INN,
        '{KPP}' => $KPP,
        '{KBK}' => $KBK,
        '{OKTMO}' => $OKTMO,
        '{PayType}' => $TypeScore.'% ОБУЧЕНИЯ',
        '{sk6}' => $sk6,
        '{sk7}' => $sk7,
        '{STName}' => Yii::app()->user->dbModel->fullName,
        '{Price}' => $price * 100,
        '{ServiceCode}' => $ServiceCode
    )
);

echo CHtml::textArea('test', $text);
?>

<style>
    td
    {
        color:black;
        font-size:12.0pt;
        font-weight:400;
        font-style:normal;
        text-decoration:none;

        vertical-align:bottom;
        border:none;
        white-space:nowrap;
    }
    .xl90, .xl91{font-size:10.0pt;}
    .xl92{
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl114
    {
        border-top:none;
        border-right:none;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        background:white;
    }
    .xl115
    {
        background:white;
    }
    .xl116
    {
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
    }
    .xl117
    {
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:white;
    }
    .xl118
    {
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl120
    {
        font-size:9.0pt;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl121
    {
        font-size:9.0pt;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl122
    {
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl123
    {
        font-size:9.0pt;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl132
    {
        font-size:6.0pt;
        text-align:left;
        background:white;
    }
    .xl134
    {
        font-size:6.0pt;
        text-align:left;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl135
    {
        font-size:6.0pt;
        text-align:right;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl136
    {
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl138
    {
        text-align:center;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:none;
        border-left:none;
        background:white;
    }
    .xl139
    {
        font-size:8.0pt;
        font-weight:700;
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:white;
        white-space:normal;
    }
    .xl142
    {
        font-size:10.0pt;
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:none;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        background:white;
        white-space:normal;
    }
    .xl148
    {
        font-size:6.0pt;
        text-align:center;
        vertical-align:top;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        background:white;
    }
    .xl151
    {
        font-size:11.0pt;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:white;
    }
    .xl152
    {
        font-size:11.0pt;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl154
    {
        font-size:6.0pt;
        text-align:center;
        vertical-align:top;
        background:white;
    }
    .xl156
    {
        font-size:9.0pt;
        font-weight:700;
        text-align:center;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:white;
    }
    .xl157
    {
        font-size:9.0pt;
        font-weight:700;
        text-align:center;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl158
    {
        font-size:9.0pt;
        text-align:left;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl159
    {
        font-size:8.0pt;
        text-align:left;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl161
    {
        font-size:9.0pt;
        text-align:center;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl163
    {
        font-size:9.0pt;
        font-weight:700;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:white;
    }
    .xl164
    {
        font-size:9.0pt;
        font-weight:700;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl165
    {
        font-size:9.0pt;
        text-align:left;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl167
    {
        font-weight:700;
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        background:white;
    }
    .xl173
    {
        font-size:6.0pt;
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:none;
        border-left:none;
        background:white;
    }
    .xl174
    {
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:none;
        border-left:none;
        background:white;
    }
    .xl176
    {
        font-size:9.0pt;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
    }
    .xl178
    {
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        background:white;
    }
</style>

<table border="0" cellpadding="0" cellspacing="0" width="689" style="border-collapse:
 collapse;table-layout:fixed;width:530pt">
    <tbody><tr style="height:9.95pt">
        <td colspan="13" rowspan="3" height="46" class="xl167" width="169" style="border-right:
  .5pt solid black;height:34.9pt;width:130pt">ИЗВЕЩЕНИЕ</td>
        <td colspan="10" class="xl173" width="130" style="width:100pt">ПАО СБЕРБАНК</td>
        <td colspan="17" class="xl174" width="221" style="width:170pt">&nbsp;</td>
        <td colspan="12" class="xl173" width="156" style="border-right:.5pt solid black;
  width:120pt">Форма №ПД-4</td>
        <td width="13" style="width:10pt"></td>
    </tr>
    <tr style="height:15.0pt">
        <td colspan="39" height="20" class="xl176" style="border-right:.5pt solid black;
  height:15.0pt"><?=$CompanyName?></td>
        <td></td>
    </tr>
    <tr style="height:9.95pt">
        <td colspan="39" height="13" class="xl154" style="border-right:.5pt solid black;
  height:9.95pt">(наименование получателя платежа)</td>
        <td></td>
    </tr>
    <tr style="height:15.0pt">
        <td colspan="13" rowspan="11" height="196" class="xl178" style="border-right:.5pt solid black;
  border-bottom:.5pt solid black;height:147.8pt">&nbsp;</td>
        <td colspan="3" class="xl163" style="border-left:none">ИНН:</td>
        <td colspan="6" class="xl165"><?=$INN?></td>
        <td class="xl120">&nbsp;</td>
        <td class="xl122">&nbsp;</td>
        <td class="xl122">&nbsp;</td>
        <td class="xl122">&nbsp;</td>
        <td colspan="3" class="xl164">КПП:</td>
        <td colspan="6" class="xl165"><?=$KPP?></td>
        <td class="xl122">&nbsp;</td>
        <td class="xl122">&nbsp;</td>
        <td colspan="3" class="xl164">р/с:</td>
        <td colspan="12" class="xl165" style="border-right:.5pt solid black"><?=$ChkAcc?></td>
        <td></td>
    </tr>
    <tr style="height:15.0pt">
        <td colspan="3" height="20" class="xl156" style="height:15.0pt;border-left:none">БИК:</td>
        <td colspan="6" class="xl158"><?=$BIK?></td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td></td>
        <td class="xl123" style="border-top:none">&nbsp;</td>
        <td class="xl123" style="border-top:none">&nbsp;</td>
        <td colspan="26" class="xl159" style="border-right:.5pt solid black"><?=$BankName?></td>
        <td class="xl91"></td>
    </tr>
    <tr style="height:15.0pt">
        <td colspan="3" height="20" class="xl156" style="height:15.0pt;border-left:none">КБК:</td>
        <td colspan="11" class="xl161"><?=$KBK?></td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td colspan="5" class="xl157">ОКТМО:</td>
        <td colspan="12" class="xl158" style="border-right:.5pt solid black"><?=$OKTMO?></td>
        <td class="xl90"></td>
    </tr>
    <tr style="height:15.75pt">
        <td colspan="31" height="21" class="xl139" width="403" style="border-right:.5pt solid black;
  height:15.75pt;border-left:none;width:310pt">ЮРИДИЧЕСКИЙ ФАКУЛЬТЕТ</td>
        <td colspan="8" class="xl139" width="104" style="border-right:.5pt solid black;
  border-left:none;width:80pt"><?=$TypeScore?>% ОБУЧЕНИЯ</td>
        <td></td>
    </tr>
    <tr style="height:15.75pt">
        <td colspan="39" rowspan="2" height="42" class="xl142" width="507" style="border-right:
  .5pt solid black;border-bottom:.5pt solid black;height:31.5pt;width:390pt">Договор:
            <?=$sk6?>; ФИО обучающегося: <?=Yii::app()->user->dbModel->fullName?>; ФИО плательщика: <?=$sk7?></td>
        <td></td>
    </tr>
    <tr style="height:15.75pt">
        <td height="21" style="height:15.75pt"></td>
    </tr>
    <tr style="height:9.95pt">
        <td colspan="39" height="13" class="xl154" style="border-right:.5pt solid black;
  height:9.95pt">(назначение платежа)</td>
        <td></td>
    </tr>
    <tr style="height:15.75pt">
        <td colspan="39" height="21" class="xl152" style="border-right:.5pt solid black;
  height:15.75pt">Сумма: <?=$priceStr?></td>
        <td></td>
    </tr>
    <tr style="height:9.95pt">
        <td colspan="39" height="13" class="xl154" style="border-right:.5pt solid black;
  height:9.95pt">(сумма платежа)</td>
        <td></td>
    </tr>
    <tr style="height:9.95pt">
        <td colspan="39" height="13" class="xl132" style="border-right:.5pt solid black;
  height:9.95pt">С условиями приёма указанной в платёжном документе суммы, в
            т.ч. с суммой взимаемой платы за услуги банка, ознакомлен и согласен.</td>
        <td></td>
    </tr>
    <tr style="height:9.95pt">
        <td colspan="15" height="13" class="xl134" style="height:9.95pt">&nbsp;</td>
        <td colspan="8" class="xl135">Подпись плательщика</td>
        <td colspan="10" class="xl136">_____________</td>
        <td class="xl92">\</td>
        <td colspan="5" class="xl136" style="border-right:.5pt solid black">&nbsp;</td>
        <td></td>
    </tr>
    <tr style="height:9.95pt">
        <td colspan="13" rowspan="3" height="46" class="xl167" style="border-right:.5pt solid black;
  height:34.9pt">КВИТАНЦИЯ</td>
        <td colspan="10" class="xl173">ПАО СБЕРБАНК</td>
        <td colspan="17" class="xl174">&nbsp;</td>
        <td colspan="12" class="xl173" style="border-right:.5pt solid black">Форма №ПД-4</td>
        <td></td>
    </tr>
    <tr style="height:15.0pt">
        <td colspan="39" height="20" class="xl176" style="border-right:.5pt solid black;
  height:15.0pt"><?=$CompanyName?></td>
        <td></td>
    </tr>
    <tr style="height:9.95pt">
        <td colspan="39" height="13" class="xl154" style="border-right:.5pt solid black;
  height:9.95pt">(наименование получателя платежа)</td>
        <td></td>
    </tr>

    <tr height="20" style="mso-height-source:userset;height:15.0pt">
        <td height="20" class="xl114" style="height:15.0pt">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td align="left" valign="top">
            <?php

            //var_dump($text);

            $qrCode = new Endroid\QrCode\QrCode($text);
            $qrCode->setSize(115);
            ?>
            <span style="position:absolute;z-index:2;"><img src="data:<?=$qrCode->writeDataUri()?>"></span>
            <span>
                <table cellpadding="0" cellspacing="0">
                <tbody><tr>
                <td height="20" class="xl115" width="13" style="height:15.0pt;width:10pt">&nbsp;</td>
                </tr>
                </tbody>
                </table>
            </span>
        </td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl116">&nbsp;</td>
        <td colspan="3" class="xl163" style="border-left:none">ИНН:</td>
        <td colspan="6" class="xl165"><?=$INN?></td>
        <td class="xl120">&nbsp;</td>
        <td class="xl122">&nbsp;</td>
        <td class="xl122">&nbsp;</td>
        <td class="xl122">&nbsp;</td>
        <td colspan="3" class="xl164">КПП:</td>
        <td colspan="6" class="xl165"><?=$KPP?></td>
        <td class="xl122">&nbsp;</td>
        <td class="xl122">&nbsp;</td>
        <td colspan="3" class="xl164">р/с:</td>
        <td colspan="12" class="xl165" style="border-right:.5pt solid black"><?=$ChkAcc?></td>
        <td></td>
    </tr>

    <tr style="height:15.0pt">
        <td height="20" class="xl114" style="height:15.0pt">&nbsp;</td>
        <td class="xl115">&nbsp</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl116">&nbsp;</td>
        <td colspan="3" class="xl156" style="border-left:none">БИК:</td>
        <td colspan="6" class="xl158"><?=$BIK?></td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td></td>
        <td class="xl123" style="border-top:none">&nbsp;</td>
        <td class="xl123" style="border-top:none">&nbsp;</td>
        <td colspan="26" class="xl159" style="border-right:.5pt solid black"><?=$BankName?></td>
        <td></td>
    </tr>
    <tr style="height:15.0pt">
        <td height="20" class="xl114" style="height:15.0pt">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl116">&nbsp;</td>
        <td class="xl116">&nbsp;</td>
        <td colspan="3" class="xl156" style="border-left:none">КБК:</td>
        <td colspan="11" class="xl161"><?=$KBK?></td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td colspan="5" class="xl157">ОКТМО:</td>
        <td colspan="12" class="xl158" style="border-right:.5pt solid black"><?=$OKTMO?></td>
        <td></td>
    </tr>
    <tr style="height:15.75pt">
        <td height="21" class="xl114" style="height:15.75pt">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl116">&nbsp;</td>
        <td class="xl116">&nbsp;</td>
        <td colspan="31" class="xl139" width="403" style="border-right:.5pt solid black;
  border-left:none;width:310pt">ЮРИДИЧЕСКИЙ ФАКУЛЬТЕТ</td>
        <td colspan="8" class="xl139" width="104" style="border-right:.5pt solid black;
  border-left:none;width:80pt"><?=$TypeScore?>% ОБУЧЕНИЯ</td>
        <td></td>
    </tr>
    <tr style="height:15.75pt">
        <td height="21" class="xl114" style="height:15.75pt">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl116">&nbsp;</td>
        <td class="xl116">&nbsp;</td>
        <td colspan="39" rowspan="2" class="xl142" width="507" style="border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:390pt">Договор: <?=$sk6?>; ФИО обучающегося: <?=Yii::app()->user->dbModel->fullName?>; ФИО плательщика: <?=$sk7?></td>
        <td></td>
    </tr>
    <tr style="height:9.95pt">
        <td height="13" class="xl114" style="height:9.95pt">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl116">&nbsp;</td>
        <td class="xl116">&nbsp;</td>
        <td></td>
    </tr>
    <tr style="height:15.0pt">
        <td height="20" class="xl114" style="height:15.0pt">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl118">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td colspan="39" class="xl148" style="border-right:.5pt solid black">(назначение
            платежа)</td>
        <td></td>
    </tr>
    <tr style="height:15.95pt">
        <td height="21" class="xl114" style="height:15.95pt">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td colspan="39" class="xl151" style="border-right:.5pt solid black">Сумма: <?=$priceStr?></td>
        <td></td>
    </tr>
    <tr style="height:15.75pt">
        <td height="21" class="xl114" style="height:15.75pt">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl115">&nbsp;</td>
        <td class="xl116">&nbsp;</td>
        <td colspan="39" class="xl132" style="border-right:.5pt solid black">С условиями
            приёма указанной в платёжном документе суммы, в т.ч. с суммой взимаемой платы
            за услуги банка, ознакомлен и согласен.</td>
        <td></td>
    </tr>
    <tr style="height:9.95pt">
        <td height="13" class="xl117" style="height:9.95pt">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl92">&nbsp;</td>
        <td class="xl118">&nbsp;</td>
        <td colspan="15" class="xl134">&nbsp;</td>
        <td colspan="8" class="xl135">Подпись плательщика</td>
        <td colspan="10" class="xl136">_____________</td>
        <td class="xl92">\</td>
        <td colspan="5" class="xl136" style="border-right:.5pt solid black">&nbsp;</td>
        <td></td>
    </tr>
    <tr style="height:15.75pt">
        <td colspan="52" height="21" class="xl138" style="height:15.75pt">---------------------------------------------------------------------------------------------------------------</td>
        <td></td>
    </tr>

    <!--[endif]-->
    </tbody></table>
