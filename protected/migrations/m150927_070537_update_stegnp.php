<?php

class m150927_070537_update_stegnp extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
        SELECT stegn0,stegn10,stegn11
        FROM stegn
        WHERE stegn10 <>0 and stegn11 <> ''
SQL;
        $command = Yii::app()->db->createCommand($sql);
        $res = $command->queryAll();

        foreach($res as $val) {
            $stegn0 = $val['stegn0'];
            $stegn10 = $val['stegn10'];
            $stegn11 = $val['stegn11'];

            $sql = <<<SQL
            insert into STEGNP(stegnp0,stegnp1,stegnp2,stegnp3) values(GEN_ID(GEN_STEGNP,1), :stegnp1, :stegnp2, :stegnp3)
SQL;
            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(':stegnp1', $stegn0);
            $command->bindValue(':stegnp2', $stegn10);
            $command->bindValue(':stegnp3', $stegn11);
            $command->execute();
        }
	}

	public function safeDown()
	{
		echo "m150927_070537_update_stegnp does not support migration down.\\n";
		return false;
	}
}