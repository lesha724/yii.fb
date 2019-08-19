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
$priceStr =  $rubles.' '.tt( 'рубль|рубля|рублей|рубль', $rubles ).' '.$penny.' '.tt( 'копейка|копейки|копеек|копейка', $penny)
?>

<style>
    tr
    {mso-height-source:auto;}
    col
    {mso-width-source:auto;}
    br
    {mso-data-placement:same-cell;}
    .style0
    {mso-number-format:General;
        vertical-align:bottom;
        white-space:nowrap;
        mso-rotate:0;
        mso-background-source:auto;
        mso-pattern:auto;
        color:black;
        font-size:12.0pt;
        font-weight:400;
        font-style:normal;
        text-decoration:none;
        font-family:"Times New Roman", sans-serif;
        mso-font-charset:204;
        border:none;
        mso-protection:locked visible;
        mso-style-name:Звичайний;
        mso-style-id:0;}
    .style17
    {mso-number-format:General;
        vertical-align:bottom;
        white-space:nowrap;
        mso-rotate:0;
        mso-background-source:auto;
        mso-pattern:auto;
        color:windowtext;
        font-size:10.0pt;
        font-weight:400;
        font-style:normal;
        text-decoration:none;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border:none;
        mso-protection:locked visible;
        mso-style-name:"Обычный 2";}
    .style16
    {mso-number-format:General;
        vertical-align:bottom;
        white-space:nowrap;
        mso-rotate:0;
        mso-background-source:auto;
        mso-pattern:auto;
        color:windowtext;
        font-size:10.0pt;
        font-weight:400;
        font-style:normal;
        text-decoration:none;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border:none;
        mso-protection:locked visible;
        mso-style-name:Обычный_Книга1;}
    .font12
    {color:black;
        font-size:11.0pt;
        font-weight:400;
        font-style:normal;
        text-decoration:none;
        font-family:Arial, sans-serif;
        mso-font-charset:204;}
    .font17
    {color:black;
        font-size:12.0pt;
        font-weight:400;
        font-style:normal;
        text-decoration:none;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;}
    td
    {mso-style-parent:style0;
        padding:0px;
        mso-ignore:padding;
        color:black;
        font-size:12.0pt;
        font-weight:400;
        font-style:normal;
        text-decoration:none;
        font-family:"Times New Roman", sans-serif;
        mso-font-charset:204;
        mso-number-format:General;
        vertical-align:bottom;
        border:none;
        mso-background-source:auto;
        mso-pattern:auto;
        mso-protection:locked visible;
        white-space:nowrap;
        mso-rotate:0;}
    .xl67
    {mso-style-parent:style0;
        color:black;
        font-weight:700;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        mso-number-format:"\@";}
    .xl68
    {mso-style-parent:style0;
        white-space:normal;}
    .xl69
    {mso-style-parent:style0;
        color:black;
        font-weight:700;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        mso-number-format:"Short Date";
        text-align:right;}
    .xl70
    {mso-style-parent:style0;
        mso-number-format:"\@";
        mso-protection:unlocked visible;}
    .xl71
    {mso-style-parent:style0;
        mso-protection:unlocked visible;}
    .xl72
    {mso-style-parent:style0;
        font-weight:700;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        text-align:left;
        vertical-align:middle;
        padding-left:48px;
        mso-char-indent-count:4;}
    .xl73
    {mso-style-parent:style0;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        text-align:left;
        vertical-align:middle;
        padding-left:12px;
        mso-char-indent-count:1;}
    .xl74
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;}
    .xl75
    {mso-style-parent:style0;
        mso-number-format:"\@";
        text-align:center;
        vertical-align:middle;
        mso-protection:unlocked visible;}
    .xl76
    {mso-style-parent:style0;
        color:black;
        font-weight:700;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        mso-number-format:Standard;
        text-align:right;
        border:.5pt solid windowtext;}
    .xl77
    {mso-style-parent:style0;
        color:black;
        font-weight:700;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        mso-number-format:"\#\,\#\#0";
        text-align:right;
        border:.5pt solid windowtext;}
    .xl78
    {mso-style-parent:style0;
        color:black;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        mso-number-format:"\@";
        text-align:right;
        border:.5pt solid windowtext;
        white-space:nowrap;
        mso-text-control:shrinktofit;}
    .xl79
    {mso-style-parent:style0;
        color:black;
        font-weight:700;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        mso-number-format:"\@";
        text-align:center;
        vertical-align:middle;
        white-space:normal;}
    .xl80
    {mso-style-parent:style0;
        mso-number-format:"\@";
        text-align:center;
        vertical-align:middle;}
    .xl81
    {mso-style-parent:style0;
        text-align:center;
        vertical-align:middle;}
    .xl82
    {mso-style-parent:style0;
        color:#00B050;
        font-weight:700;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        text-align:left;
        vertical-align:middle;
        mso-protection:unlocked visible;}
    .xl83
    {mso-style-parent:style0;
        color:black;
        font-weight:700;
        mso-number-format:"\@";
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:#FC9204;
        mso-pattern:black none;
        white-space:normal;}
    .xl84
    {mso-style-parent:style0;
        text-align:left;
        vertical-align:middle;}
    .xl85
    {mso-style-parent:style0;
        color:black;
        mso-protection:unlocked visible;}
    .xl86
    {mso-style-parent:style17;
        color:black;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:0;
        mso-number-format:"\@";
        text-align:center;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        mso-protection:unlocked visible;}
    .xl87
    {mso-style-parent:style17;
        color:black;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:0;
        mso-number-format:Fixed;
        text-align:center;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        mso-protection:unlocked visible;}
    .xl88
    {mso-style-parent:style17;
        color:black;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:0;
        mso-number-format:"\@";
        text-align:center;
        border-top:.5pt solid windowtext;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        mso-protection:unlocked visible;}
    .xl89
    {mso-style-parent:style17;
        color:black;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:0;
        mso-number-format:Fixed;
        text-align:center;
        border-top:.5pt solid windowtext;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        mso-protection:unlocked visible;}
    .xl90
    {mso-style-parent:style0;
        font-size:10.0pt;}
    .xl91
    {mso-style-parent:style0;
        font-size:10.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;}
    .xl92
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl93
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:.5pt dashed windowtext;
        border-right:none;
        border-bottom:none;
        border-left:.5pt dashed windowtext;
        background:white;
        mso-pattern:black none;}
    .xl94
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:.5pt dashed windowtext;
        border-right:none;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl95
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:.5pt dashed windowtext;
        border-right:.5pt dotted windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl96
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:none;
        border-bottom:none;
        border-left:.5pt dashed windowtext;
        background:white;
        mso-pattern:black none;}
    .xl97
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        vertical-align:middle;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl98
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        background:white;
        mso-pattern:black none;}
    .xl99
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:.5pt dotted windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl100
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:none;
        border-bottom:.5pt dashed windowtext;
        border-left:.5pt dashed windowtext;
        background:white;
        mso-pattern:black none;}
    .xl101
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:none;
        border-bottom:.5pt dashed windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl102
    {mso-style-parent:style16;
        color:windowtext;
        font-size:11.0pt;
        font-weight:700;
        font-family:"Arial Cyr", sans-serif;
        mso-font-charset:204;
        vertical-align:top;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl103
    {mso-style-parent:style16;
        color:windowtext;
        font-size:11.0pt;
        font-weight:700;
        font-family:"Arial Cyr", sans-serif;
        mso-font-charset:204;
        mso-number-format:Standard;
        vertical-align:middle;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl104
    {mso-style-parent:style0;
        color:black;
        font-size:11.0pt;
        font-weight:700;
        font-family:Calibri, sans-serif;
        mso-font-charset:204;
        mso-number-format:Standard;
        vertical-align:middle;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl105
    {mso-style-parent:style0;
        border-top:none;
        border-right:none;
        border-bottom:.5pt dashed windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl106
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:.5pt dotted windowtext;
        border-bottom:.5pt dashed windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl107
    {mso-style-parent:style0;
        color:black;
        font-size:10.0pt;
        font-weight:700;
        font-family:Calibri, sans-serif;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl108
    {mso-style-parent:style0;
        color:black;
        font-size:10.0pt;
        font-weight:700;
        font-family:Calibri, sans-serif;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:.5pt dotted windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl109
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:none;
        border-bottom:.5pt dotted windowtext;
        border-left:.5pt dotted windowtext;
        background:white;
        mso-pattern:black none;}
    .xl110
    {mso-style-parent:style0;
        border-top:none;
        border-right:none;
        border-bottom:.5pt dotted windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl111
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:none;
        border-bottom:.5pt dotted windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl112
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:.5pt dotted windowtext;
        border-bottom:.5pt dotted windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl113
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:none;
        border-bottom:.5pt dashed windowtext;
        border-left:.5pt dotted windowtext;
        background:white;
        mso-pattern:black none;}
    .xl114
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:none;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;}
    .xl115
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        background:white;
        mso-pattern:black none;}
    .xl116
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl117
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;}
    .xl118
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl119
    {mso-style-parent:style16;
        color:windowtext;
        font-size:11.0pt;
        font-weight:700;
        font-family:"Arial Cyr", sans-serif;
        mso-font-charset:204;
        mso-number-format:Standard;
        vertical-align:middle;
        border-top:none;
        border-right:.5pt dashed windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl120
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl121
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl122
    {mso-style-parent:style0;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl123
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl124
    {mso-style-parent:style0;
        color:black;
        font-weight:700;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        mso-number-format:"\@";
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:#FC9204;
        mso-pattern:black none;
        white-space:normal;}
    .xl125
    {mso-style-parent:style0;
        font-weight:700;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;}
    .xl126
    {mso-style-parent:style0;
        color:windowtext;
        mso-number-format:"\@";
        text-align:center;}
    .xl127
    {mso-style-parent:style0;
        text-align:center;
        vertical-align:middle;
        mso-protection:unlocked visible;}
    .xl128
    {mso-style-parent:style0;
        mso-number-format:"\@";}
    .xl129
    {mso-style-parent:style0;
        text-align:left;}
    .xl130
    {mso-style-parent:style0;
        color:red;
        font-weight:700;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        mso-number-format:"\@";
        text-align:center;
        vertical-align:middle;
        border-top:1.0pt solid windowtext;
        border-right:1.0pt solid windowtext;
        border-bottom:none;
        border-left:1.0pt solid windowtext;
        mso-protection:unlocked visible;}
    .xl131
    {mso-style-parent:style0;
        color:red;
        font-weight:700;
        font-family:"Times New Roman", serif;
        mso-font-charset:204;
        mso-number-format:"\@";
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:1.0pt solid windowtext;
        border-bottom:1.0pt solid windowtext;
        border-left:1.0pt solid windowtext;
        mso-protection:unlocked visible;}
    .xl132
    {mso-style-parent:style0;
        font-size:6.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:left;
        background:white;
        mso-pattern:black none;}
    .xl133
    {mso-style-parent:style0;
        font-size:6.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:left;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl134
    {mso-style-parent:style0;
        font-size:6.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:left;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl135
    {mso-style-parent:style0;
        font-size:6.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:right;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl136
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl137
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl138
    {mso-style-parent:style0;
        mso-number-format:"\@";
        text-align:center;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl139
    {mso-style-parent:style0;
        font-size:8.0pt;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl140
    {mso-style-parent:style0;
        font-size:8.0pt;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl141
    {mso-style-parent:style0;
        font-size:8.0pt;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:.5pt solid windowtext;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl142
    {mso-style-parent:style0;
        font-size:10.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:none;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl143
    {mso-style-parent:style0;
        font-size:10.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl144
    {mso-style-parent:style0;
        font-size:10.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl145
    {mso-style-parent:style0;
        font-size:10.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl146
    {mso-style-parent:style0;
        font-size:10.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl147
    {mso-style-parent:style0;
        font-size:10.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl148
    {mso-style-parent:style0;
        font-size:6.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:top;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;}
    .xl149
    {mso-style-parent:style0;
        font-size:6.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:top;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl150
    {mso-style-parent:style0;
        font-size:6.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:top;
        border-top:.5pt solid windowtext;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl151
    {mso-style-parent:style0;
        font-size:11.0pt;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;}
    .xl152
    {mso-style-parent:style0;
        font-size:11.0pt;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl153
    {mso-style-parent:style0;
        font-size:11.0pt;
        text-align:center;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl154
    {mso-style-parent:style0;
        font-size:6.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:top;
        background:white;
        mso-pattern:black none;}
    .xl155
    {mso-style-parent:style0;
        font-size:6.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:top;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl156
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;}
    .xl157
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl158
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:left;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl159
    {mso-style-parent:style0;
        font-size:8.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:left;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl160
    {mso-style-parent:style0;
        font-size:8.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:left;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:.5pt solid windowtext;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl161
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl162
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:left;
        border-top:.5pt solid windowtext;
        border-right:.5pt solid windowtext;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl163
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;}
    .xl164
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl165
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:left;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl166
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:left;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl167
    {mso-style-parent:style0;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;}
    .xl168
    {mso-style-parent:style0;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl169
    {mso-style-parent:style0;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl170
    {mso-style-parent:style0;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:none;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;}
    .xl171
    {mso-style-parent:style0;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        background:white;
        mso-pattern:black none;}
    .xl172
    {mso-style-parent:style0;
        font-weight:700;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl173
    {mso-style-parent:style0;
        font-size:6.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl174
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:none;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl175
    {mso-style-parent:style0;
        font-size:6.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:.5pt solid windowtext;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl176
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl177
    {mso-style-parent:style0;
        font-size:9.0pt;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:.5pt solid windowtext;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl178
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:none;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;}
    .xl179
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        background:white;
        mso-pattern:black none;}
    .xl180
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        border-top:none;
        border-right:.5pt solid windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;}
    .xl181
    {mso-style-parent:style0;
        font-family:"Arial Cur";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:center;
        border-top:none;
        border-right:none;
        border-bottom:.5pt solid windowtext;
        border-left:.5pt solid windowtext;
        background:white;
        mso-pattern:black none;}
    .xl182
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:left;
        vertical-align:middle;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl183
    {mso-style-parent:style16;
        color:windowtext;
        font-size:11.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        mso-number-format:Standard;
        text-align:left;
        vertical-align:middle;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl184
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-weight:700;
        font-family:"Arial Cyr", sans-serif;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:none;
        border-bottom:none;
        border-left:.5pt dashed windowtext;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl185
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-weight:700;
        font-family:"Arial Cyr", sans-serif;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl186
    {mso-style-parent:style16;
        color:windowtext;
        font-size:11.0pt;
        font-weight:700;
        font-family:"Arial Cyr", sans-serif;
        mso-font-charset:204;
        mso-number-format:Standard;
        text-align:left;
        vertical-align:middle;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl187
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:left;
        vertical-align:middle;
        border-top:none;
        border-right:.5pt dotted windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl188
    {mso-style-parent:style16;
        color:windowtext;
        font-size:10.0pt;
        font-weight:700;
        font-family:"Arial Cyr", sans-serif;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:.5pt dotted windowtext;
        border-bottom:none;
        border-left:none;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl189
    {mso-style-parent:style16;
        color:windowtext;
        font-size:11.0pt;
        font-weight:700;
        font-family:"Arial Cyr";
        mso-generic-font-family:auto;
        mso-font-charset:204;
        text-align:left;
        vertical-align:middle;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
    .xl190
    {mso-style-parent:style0;
        color:black;
        font-size:10.0pt;
        font-weight:700;
        font-family:Calibri, sans-serif;
        mso-font-charset:204;
        text-align:center;
        vertical-align:middle;
        border-top:none;
        border-right:none;
        border-bottom:none;
        border-left:.5pt dashed windowtext;
        background:white;
        mso-pattern:black none;
        white-space:normal;}
</style>

<table border="0" cellpadding="0" cellspacing="0" width="689" style="border-collapse:
 collapse;table-layout:fixed;width:530pt">
    <colgroup><col width="13" span="69" style="mso-width-source:userset;mso-width-alt:416;
 width:10pt">
    </colgroup><tbody><tr height="13" style="mso-height-source:userset;height:9.95pt">
        <td colspan="13" rowspan="3" height="46" class="xl167" width="169" style="border-right:
  .5pt solid black;height:34.9pt;width:130pt">ИЗВЕЩЕНИЕ</td>
        <td colspan="10" class="xl173" width="130" style="width:100pt">ПАО СБЕРБАНК</td>
        <td colspan="17" class="xl174" width="221" style="width:170pt">&nbsp;</td>
        <td colspan="12" class="xl173" width="156" style="border-right:.5pt solid black;
  width:120pt">Форма №ПД-4</td>
        <td width="13" style="width:10pt"></td>
    </tr>
    <tr height="20" style="mso-height-source:userset;height:15.0pt">
        <td colspan="39" height="20" class="xl176" style="border-right:.5pt solid black;
  height:15.0pt"><?=$CompanyName?></td>
        <td></td>
    </tr>
    <tr height="13" style="mso-height-source:userset;height:9.95pt">
        <td colspan="39" height="13" class="xl154" style="border-right:.5pt solid black;
  height:9.95pt">(наименование получателя платежа)</td>
        <td></td>
    </tr>
    <tr height="20" style="mso-height-source:userset;height:15.0pt">
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
    <tr height="20" style="mso-height-source:userset;height:15.0pt">
        <td colspan="3" height="20" class="xl156" style="height:15.0pt;border-left:none">БИК:</td>
        <td colspan="6" class="xl158"><?=$BIK?></td>
        <td class="xl121" style="border-top:none">&nbsp;</td>
        <td></td>
        <td class="xl123" style="border-top:none">&nbsp;</td>
        <td class="xl123" style="border-top:none">&nbsp;</td>
        <td colspan="26" class="xl159" style="border-right:.5pt solid black"><?=$BankName?></td>
        <td class="xl91"></td>
    </tr>
    <tr height="20" style="mso-height-source:userset;height:15.0pt">
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
    <tr height="21" style="mso-height-source:userset;height:15.75pt">
        <td colspan="31" height="21" class="xl139" width="403" style="border-right:.5pt solid black;
  height:15.75pt;border-left:none;width:310pt">ЮРИДИЧЕСКИЙ ФАКУЛЬТЕТ</td>
        <td colspan="8" class="xl139" width="104" style="border-right:.5pt solid black;
  border-left:none;width:80pt"><?=$TypeScore?>% ОБУЧЕНИЯ</td>
        <td></td>
    </tr>
    <tr height="21" style="mso-height-source:userset;height:15.75pt">
        <td colspan="39" rowspan="2" height="42" class="xl142" width="507" style="border-right:
  .5pt solid black;border-bottom:.5pt solid black;height:31.5pt;width:390pt">Договор:
            <?=$sk6?>; ФИО обучающегося: <?=Yii::app()->user->dbModel->fullName?>; ФИО плательщика: <?=$sk7?></td>
        <td></td>
    </tr>
    <tr height="21" style="mso-height-source:userset;height:15.75pt">
        <td height="21" style="height:15.75pt"></td>
    </tr>
    <tr height="13" style="mso-height-source:userset;height:9.95pt">
        <td colspan="39" height="13" class="xl154" style="border-right:.5pt solid black;
  height:9.95pt">(назначение платежа)</td>
        <td></td>
    </tr>
    <tr height="21" style="mso-height-source:userset;height:15.75pt">
        <td colspan="39" height="21" class="xl152" style="border-right:.5pt solid black;
  height:15.75pt">Сумма: <?=$priceStr?></td>
        <td></td>
    </tr>
    <tr height="13" style="mso-height-source:userset;height:9.95pt">
        <td colspan="39" height="13" class="xl154" style="border-right:.5pt solid black;
  height:9.95pt">(сумма платежа)</td>
        <td></td>
    </tr>
    <tr height="13" style="mso-height-source:userset;height:9.95pt">
        <td colspan="39" height="13" class="xl132" style="border-right:.5pt solid black;
  height:9.95pt">С условиями приёма указанной в платёжном документе суммы, в
            т.ч. с суммой взимаемой платы за услуги банка, ознакомлен и согласен.</td>
        <td></td>
    </tr>
    <tr height="13" style="mso-height-source:userset;height:9.95pt">
        <td colspan="15" height="13" class="xl134" style="height:9.95pt">&nbsp;</td>
        <td colspan="8" class="xl135">Подпись плательщика</td>
        <td colspan="10" class="xl136">_____________</td>
        <td class="xl92">\</td>
        <td colspan="5" class="xl136" style="border-right:.5pt solid black">&nbsp;</td>
        <td></td>
    </tr>
    <tr height="13" style="mso-height-source:userset;height:9.95pt">
        <td colspan="13" rowspan="3" height="46" class="xl167" style="border-right:.5pt solid black;
  height:34.9pt">КВИТАНЦИЯ</td>
        <td colspan="10" class="xl173">ПАО СБЕРБАНК</td>
        <td colspan="17" class="xl174">&nbsp;</td>
        <td colspan="12" class="xl173" style="border-right:.5pt solid black">Форма №ПД-4</td>
        <td></td>
    </tr>
    <tr height="20" style="mso-height-source:userset;height:15.0pt">
        <td colspan="39" height="20" class="xl176" style="border-right:.5pt solid black;
  height:15.0pt"><?=$CompanyName?></td>
        <td></td>
    </tr>
    <tr height="13" style="mso-height-source:userset;height:9.95pt">
        <td colspan="39" height="13" class="xl154" style="border-right:.5pt solid black;
  height:9.95pt">(наименование получателя платежа)</td>
        <td></td>
    </tr>

    <tr height="20" style="mso-height-source:userset;height:15.0pt">
        <td height="20" class="xl114" style="height:15.0pt">&nbsp;</td>
        <td class="xl115">&nbsp;
            <?php
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

                //var_dump($text);

                $qrCode = new Endroid\QrCode\QrCode($text);
                $qrCode->setEncoding('utf-8');
                $qrCode->setMargin(5);
                $qrCode->setSize(100);
            ?>
            <span style="position:absolute;z-index:2;"><img src="data:<?=$qrCode->writeDataUri()?>"></span>
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
    <tr height="20" style="mso-height-source:userset;height:15.0pt">
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
    <tr height="21" style="mso-height-source:userset;height:15.75pt">
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
    <tr height="21" style="mso-height-source:userset;height:15.75pt">
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
    <tr height="13" style="mso-height-source:userset;height:9.95pt">
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
    <tr height="20" style="mso-height-source:userset;height:15.0pt">
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
    <tr height="21" style="mso-height-source:userset;height:15.95pt">
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
    <tr height="21" style="mso-height-source:userset;height:15.75pt">
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
    <tr height="13" style="mso-height-source:userset;height:9.95pt">
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
    <tr height="21" style="height:15.75pt">
        <td colspan="52" height="21" class="xl138" style="height:15.75pt">---------------------------------------------------------------------------------------------------------------</td>
        <td></td>
    </tr>

    <!--[endif]-->
    </tbody></table>
