<?php

class m160122_114619_insert_ps_57 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(57, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160122_114619_insert_ps_57 does not support migration down.\\n";
		return false;
	}
}