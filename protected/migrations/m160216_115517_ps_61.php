<?php

class m160216_115517_ps_61 extends CDbMigration
{
	public function safeUp()
	{
		/*Текст на главной юа*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(61, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160216_115517_ps_61 does not support migration down.\\n";
		return false;
	}
}