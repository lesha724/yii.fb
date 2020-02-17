<?php

class m150923_071720_alter_stegnd9 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
ALTER TABLE STEGND DROP CONSTRAINT PK_STEGND;
SQL;
		$this->execute($sql);
        $sql = <<<SQL
alter table STEGND add stegnd9 smal;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
alter table stegnd add constraint PK_stegnd primary key (stegnd1,stegnd2,stegnd3,stegnd4,stegnd5,stegnd6,stegnd9);
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150923_071720_alter_stegnd9 does not support migration down.\\n";
		return false;
	}
}