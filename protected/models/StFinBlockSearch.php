<?php

/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 09.04.2017
 * Time: 14:11
 */
class StFinBlockSearch extends Stbl
{
    public $st_fname, $st_sname, $st_lname;
    public $tch_fname, $tch_sname, $tch_lname;
    public $gr_name;
    //public $course;

    public $st;
    public $tch;

    public function rules()
    {
        return array(
            array('st, tch, st_fname, st_sname, st_lname, gr_name,stbl3, stbl5', 'safe', 'on'=>'search'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'st'=>tt('Студент'),
            'gr_name'=>tt('Группа'),
            'stbl3'=>tt('Дата блокировки'),
            'stbl5'=>tt('Дата извещения'),
            //'course'=>tt('Курс'),
            'tch'=>tt('Известивший преподаватель'),
        );
    }
    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->select = 't.*,
							pe2 as st_lname,pe3 as st_fname,pe4 as st_sname,
							p3 as tch_lname,p4 as tch_fname,p5 as tch_sname,
							gr3 as gr_name';
        $criteria->join = 'INNER JOIN st ON (stbl2=st.st1) ';
        $criteria->join .= 'LEFT JOIN pe ON (st.st200=pe.pe1) ';
        $criteria->join .= 'INNER JOIN std ON (st1 = std.std2) ';
        $criteria->join .= 'INNER JOIN gr ON (std.std3 = gr1) ';
        $criteria->join .= 'INNER JOIN sg ON (gr.gr2 = sg1) ';

        $criteria->join .= 'LEFT JOIN p ON (stbl6=p.p1) ';
        $criteria->compare('stbl3',$this->stbl3,true);
        $criteria->compare('stbl5',$this->stbl5,true);
        //что делать не понятно, аналогичного поля нет
        if(!empty($this->course))
            $criteria->compare('std20',$this->course);

        if(!empty($this->gr_name)) {
            $criteria->addCondition("gr3 CONTAINING :gr_name");
            $criteria->params[':gr_name'] =$this->gr_name;
        }

        $criteria->addCondition('std7 is null and std11 in (0, 5, 6, 8) and st101!=7 and st167=1');


        if(!empty($this->st)) {
            $criteria->addCondition("(pe2 CONTAINING :stName or pe3 CONTAINING :stName or pe4  CONTAINING :stName)");
            $criteria->params[':stName'] =$this->st;
        }

        if(!empty($this->tch)) {
            $criteria->addCondition("(p3 CONTAINING :tchName or p4 CONTAINING :tchName or p5  CONTAINING :tchName)");
            $criteria->params[':tchName'] =$this->tch;
        }

       /* if(count($params)>0)
            $criteria->params=$params;*/

        $sort = new CSort();
        $sort->sortVar = 'sort';
        $sort->defaultOrder = 'stbl3 desc';
        $sort->attributes = array(
            'st'=>array(
                'asc'=>'pe2 ASC, pe3 ASC, pe4 ASC',
                'desc'=>'pe2 DESC, pe3 ASC, pe4 ASC',
                'default'=>'ASC',
            ),
            'gr_name'=>array(
                'asc'=>'gr3 ASC',
                'desc'=>'gr3 DESC',
                'default'=>'ASC',
            ),
            'course'=>array(
                'asc'=>'std20 ASC',
                'desc'=>'std20 DESC',
                'default'=>'ASC',
            ),
            'stbl3'=>array(
                'asc'=>'stbl3 ASC',
                'desc'=>'stbl3 DESC',
                'default'=>'ASC',
            ),
            'stbl5'=>array(
                'asc'=>'stbl5 ASC',
                'desc'=>'stbl5 DESC',
                'default'=>'ASC',
            ),
            'tch'=>array(
                'asc'=>'p3 ASC, p4 ASC, p5 ASC',
                'desc'=>'p3 DESC, p4 ASC, p5 ASC',
                'default'=>'ASC',
            ),

        );

        $pageSize=Yii::app()->user->getState('pageSize',10);
        if($pageSize==0)
            $pageSize=10;

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>$sort,
            'pagination'=>array(
                'pageSize'=> $pageSize,
            ),
        ));
    }
}