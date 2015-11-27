<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 27.11.2015
 * Time: 9:51
 */

/* @var $st St */


$studentInfo = $st->getStudentInfoForCard();

if(empty($studentInfo))
    echo tt('Error');
else {
    $infoHtml = <<<HTML
    <div class="student-info">
        <table class="table">
            <tbody>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
            </tbody>
        </table>
    </div>
HTML;

    echo sprintf($infoHtml,
        tt('Факультет'), $studentInfo['f3'],
        tt('Специальность'), $studentInfo['sp2'],
        tt('Курс'), $studentInfo['sem4'],
        tt('Группа'), $studentInfo['gr3']
    );
}