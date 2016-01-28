<?php

class m160122_112255_insert_ps_56 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(56, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160122_112255_insert_ps_56 does not support migration down.\\n";
		return false;
	}
}