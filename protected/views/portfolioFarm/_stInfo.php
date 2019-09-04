<?php
/**
 * Created by PhpStorm.
 * User: Lesha
 * Date: 04.09.2019
 * Time: 17:08
 */

/**
 * @var St $student
 * @var TimeTableForm $model
 */

$studentInfo = $student->getStudentInfoForPortfolio();

$infoHtml = <<<HTML
    <div class="student-info">
        <table class="table">
            <tbody>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
                <tr>
                    <th>%s</th>
                    <td>%s</td>
                    <th>%s</th>
                    <td>%s</td>
                </tr>
            </tbody>
        </table>
    </div>
HTML;

echo sprintf($infoHtml,
    tt('ФИО'),$student->fullName,

    tt('Факультет'), $studentInfo['f3'],
    tt('Специальность, шифр'), $studentInfo['sp2'] . ', '. $studentInfo['sp4'],

    tt('Форма обучения'),SH::convertEducationType($studentInfo['sg4']),
    tt('Курс'), $studentInfo['st56'],

    tt('Группа'), Gr::model()->getGroupName($studentInfo['sem4'], $studentInfo),
    tt('Профиль'), $studentInfo['spc4'],

    '', ''
);
