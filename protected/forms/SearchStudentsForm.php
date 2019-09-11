<?php
/**
 * Created by PhpStorm.
 * User: Lesha
 * Date: 11.09.2019
 * Time: 11:44
 */

class SearchStudentsForm extends CFormModel
{
    public $name;

    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name', 'length', 'max'=>60),
        );
    }

    /**
     * поиск студентов по имени
     * @param $name
     * @return array
     * @throws CException
     */
    public function getSearchStudents()
    {
        if (empty($this->name))
            return array();

        list($year, $sem) = SH::getCurrentYearAndSem();

        $where="";
        if(Yii::app()->core->universityCode==U_NULAU)
            $where = "AND f1!=5";

        $sql = /** @lang text */
            <<<SQL
        SELECT st1,pe1,pe2,pe3,pe4,gr1,gr3,f1,f2,ks1,ks3,sem4,sg1,sp1,pnsp1, gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26 FROM ks
			inner join f on (ks.ks1 = f.f14)
			inner join sp on (f.f1 = sp.sp5)
            inner join pnsp on (sp.sp11 = pnsp.pnsp1)
			inner join sg on (sp.sp1 = sg.sg2)
			inner join gr on (sg.sg1 = gr.gr2)
			inner join std on (gr.gr1 = std.std3)
			inner join st on (std.std2 = st.st1)
			inner join pe on (st.st200 = pe.pe1)
			inner join sem on (sg.sg1 = sem.sem2)
		where std7 is null and std11 in (0, 5, 6, 8) and pe2 CONTAINING :name and sem3=:YEAR1 and sem5=:SEM1 and st101!=7 {$where}
		GROUP BY st1,pe1,pe2,pe3,pe4,gr1,gr3,f1,f2,ks1,ks3,sem4,sg1,sp1,pnsp1, gr19,gr20,gr21,gr22,gr23,gr24,gr25,gr26
        ORDER BY pe2 collate UNICODE,ks3,gr3,f2
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':name', $this->name);
        $command->bindValue(':YEAR1', $year);
        $command->bindValue(':SEM1', $sem);
        $students= $command->queryAll();
        foreach($students as $key => $student) {
            $students[$key]['group_name'] = Gr::model()->getGroupName($students[$key]['sem4'], $student);
        }
        return $students;
    }
}