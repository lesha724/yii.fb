<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 06.11.2017
 * Time: 16:24
 */

/**
 * Class IrpenMoodleDistEducation
 * Конектор для мудла
 */
class IrpenMoodleDistEducation extends MoodleDistEducation
{
    /**
     * Загрузить оценки с дист. образования
     */
    /*public function uploadMarks($uo1, $gr1, $year, $sem){

        $uo = Uo::model()->findByPk($uo1);
        if(empty($uo))
            throw new Exception('Ошибочный код дисциплины учебного плана!');

        $gr = Gr::model()->findByPk($gr1);
        if(empty($gr))
            throw new Exception('Ошибочный код группы!');

        $sem7 = Yii::app()->db->createCommand(<<<SQL
                  select
                   first 1 sem7
                    from sem
                       inner join sg on (sem.sem2 = sg.sg1)
                       inner join gr on (sg.sg1 = gr.gr2)
                    WHERE gr1=:GR1 and sem3=:YEAR and sem5=:SEM
			
SQL
        )->queryScalar(
            array(
                ':GR1' => $gr1,
                ':YEAR' => $year,
                ':SEM' => $sem
            ));

        $vvmp = Vvmp::model()->findByAttributes(
            array(
                'vvmp3' => $uo->uo3,
                'vvmp4' => $sem7,
                'vvmp5' => $uo->uo4,
                'vvmp25' => $gr->gr2
                //'vvmp6' => 0
            )
        );

        if(empty($vvmp))
            return array(false, 'Модуль не создан, обратитесь в деканат!');

        $vedomost = null;

        try {
            $vedomost = new DistVedomost($uo1, $gr1, $vvmp->vvmp6);

            $vedomost = $this->_getMarks($vedomost);
        }catch (Exception $error){
            return array(false, $error->getMessage());
        }

        $students = St::model()->getStudentsOfGroupForDistEducation($gr1);

        if(empty($students))
            return array(false, 'Не найдены студенты в группе АСУ');

        $f2 = Yii::app()->db->createCommand(<<<SQL
          select 
               f2
            from gr
               inner join sg on (gr.gr2 = sg.sg1)
               inner join sp on (sg.sg2 = sp.sp1)
               inner join f on (sp.sp5 = f.f1)
          where gr1=:GR1
SQL
        )->queryScalar(array(
            ':GR1' => $gr1
        ));

        $selectVmpv1 = <<<SQL
          SELECT vmpv1 from vmpv WHERE vmpv2=:VVMP1 and vmpv6 is NULL and vmpv7=:GR1
SQL;

        $vmpv1 = Yii::app()->db->createCommand( $selectVmpv1)->queryScalar(array(
            ':VVMP1' => $vvmp->vvmp1,
            ':GR1' => $gr1
        ));

        $isOld = true;

        if(empty($vmpv1)) {

            $isOld = false;

            $transaction = Yii::app()->db->beginTransaction();
            $insertVmpv = <<<SQL
                INSERT into vmpv(vmpv1,vmpv2,vmpv3,vmpv4,vmpv5,vmpv6,vmpv7,vmpv8,vmpv9,vmpv10,vmpv11) 
                  VALUES (
                    :VMPV1,
                    :VMPV2,
                    :VMPV3,
                    :VMPV4,
                    :VMPV5,
                    null,
                    :VMPV7,
                    :VMPV8,
                    :VMPV9,
                    0,
                    :VMPV11
                );
SQL;
            try {
                $vmpv1 = Yii::app()->db->createCommand("select first 1 id1 from pr1('vmpv1','vmpv') left join vmpv on (vmpv1=id1) where vmpv1 is null")->queryScalar();
                $currentDate = date('Y-m-d H:i:s');
                Yii::app()->db->createCommand($insertVmpv)->queryScalar(array(
                    ':VMPV1' => $vmpv1,
                    ':VMPV2' => $vvmp->vvmp1,
                    ':VMPV3' => '-',
                    ':VMPV7' => $gr1,
                    ':VMPV11' => Yii::app()->user->dbModel->p1,
                    ':VMPV4' => $currentDate,
                    ':VMPV5' => $currentDate,
                    ':VMPV8' => $currentDate,
                    ':VMPV9' => $currentDate
                ));

                $transaction->commit();
            } catch (Exception $error) {
                $transaction->rollback();
                return array(false, 'Ошибка создания ведомости: ' . $error->getMessage());
            }
        }

        $transaction = Yii::app()->db->beginTransaction();

        try {

            if(!$isOld) {
                $name = sprintf('%s-%d.%d-%d', $f2, $sem7, (int)$year - 2000, $vmpv1);

                Yii::app()->db->createCommand('UPDATE vmpv set vmpv3=:VMPV3 WHERE vmpv1= :VMPV1')->execute(array(
                    ':VMPV1' => $vmpv1,
                    ':VMPV3' => $name
                ));
            }

            $marks = $vedomost->getMarks();
            //var_dump($marks);

            foreach ($students as $student) {

                $vmp = Vmp::model()->findByAttributes(array(
                    'vmp1' => $vmpv1,
                    'vmp2' => $student->st1
                ));

                //var_dump($vmp);

                if(empty($vmp)) {
                    $vmp = new Vmp();
                    $vmp->vmp1 = $vmpv1;
                    $vmp->vmp2 = $student->st1;
                }

                if(isset($marks[$student->st1])) {

                    $vmp->vmp4 = round($marks[$student->st1],2);
                    $vmp->vmp7 = round($marks[$student->st1],2);
                    //var_dump($vmp);
                }else{
                    $vmp->vmp4 = 0;
                    $vmp->vmp7 = -4;
                }

                $vmp->vmp5 = 0;
                $vmp->vmp6 = 0;
                $vmp->vmp9 = 0;
                $vmp->vmp10 = date('Y-m-d H:i:s');
                $vmp->vmp11 = 0;
                $vmp->vmp12 = Yii::app()->user->dbModel->p1;
                $vmp->vmp13 = 0;
                $vmp->vmp14 = 0;

                if(!$vmp->save()){
                    //var_dump($vmp->getErrors());
                    throw new Exception('Ошибка сохранения оценки ');
                }
            }

            $transaction->commit();

            return array(true, 'Успешно!');
        }catch (Exception $error){
            $transaction->rollback();

            return array(false, $error->getMessage());
        }
    }*/
}