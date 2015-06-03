<?php

class m140317_083758_transfer_users extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
        SELECT st1,st105, st106, st107
        FROM st
        WHERE st105 <> '' and st106 <> ''
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $students = $command->queryAll();

        foreach($students as $st) {
            $u2 = $st['st105'];
            $u3 = $st['st106'];
            $u4 = $st['st107'];
            $u6 = $st['st1'];

            $sql = <<<SQL
            insert into USERS(u1,u2,u3,u4,u5,u6,u7) values(GEN_ID(GEN_USERS,1), :U2, :U3, :U4, 0, :U6, 0)
SQL;
            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':U2', $u2);
            $command->bindValue(':U3', $u3);
            $command->bindValue(':U4', $u4);
            $command->bindValue(':U6', $u6);
            $command->execute();
        }


        $sql = <<<SQL
        SELECT p1,p79,p80, p81
        FROM p
        WHERE p79 <> '' and p80 <> ''
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $teachers = $command->queryAll();

        foreach($teachers as $tch) {
            $u2 = $tch['p79'];
            $u3 = $tch['p80'];
            $u4 = $tch['p81'];
            $u6 = $tch['p1'];
            $sql = <<<SQL
insert into USERS(u1,u2,u3,u4,u5,u6,u7) values(GEN_ID(GEN_USERS,1), '{$u2}', '{$u3}', '{$u4}', 1, {$u6}, 0)
SQL;
            $this->execute($sql);
        }


        $sql = <<<SQL
        SELECT prnt2,prnt3, prnt4
        FROM prnt
        WHERE prnt2 <> '' and prnt3 <> ''
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $parents = $command->queryAll();

        foreach($parents as $tch) {
            $u2 = $tch['prnt2'];
            $u3 = $tch['prnt3'];
            $u4 = '';
            $u6 = $tch['prnt4'];
            $sql = <<<SQL
insert into USERS(u1,u2,u3,u4,u5,u6,u7) values(GEN_ID(GEN_USERS,1), '{$u2}', '{$u3}', '{$u4}', 2, {$u6}, 0)
SQL;
            $this->execute($sql);
        }

	}

	public function safeDown()
	{
		echo "m140317_083758_transfer_users does not support migration down.\\n";
		return false;
	}
}