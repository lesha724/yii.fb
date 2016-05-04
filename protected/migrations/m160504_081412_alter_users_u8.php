<?php

class m160504_081412_alter_users_u8 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			alter table users add u8 smal;
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160504_081412_alter_users_u8 does not support migration down.\\n";
		return false;
	}
}