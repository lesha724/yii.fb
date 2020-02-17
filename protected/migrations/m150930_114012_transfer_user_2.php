<?php

class m150930_114012_transfer_user_2 extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
        SELECT st1,st105, st106, st107, (SELECT COUNT(*) FROM users WHERE users.u6=st.st1 and users.u5=0) as users_count
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
            $users_count=$st['users_count'];

            if($users_count==0)
            {
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
        }


        $sql = <<<SQL
        SELECT p1,p79,p80, p81,(SELECT COUNT(*) FROM users WHERE users.u6=p.p1 and users.u5=1) as users_count
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
            $users_count=$tch['users_count'];

            if($users_count==0)
            {
                $sql = <<<SQL
                    insert into USERS(u1,u2,u3,u4,u5,u6,u7) values(GEN_ID(GEN_USERS,1), '{$u2}', '{$u3}', '{$u4}', 1, {$u6}, 0)
SQL;
                $this->execute($sql);
            }
        }
	}

	public function safeDown()
	{
		echo "m150930_114012_transfer_user_2 does not support migration down.\\n";
		return false;
	}
}