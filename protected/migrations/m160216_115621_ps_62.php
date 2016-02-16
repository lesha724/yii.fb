<?php

class m160216_115621_ps_62 extends CDbMigration
{
	public function safeUp()
	{
		/*Текст на главной ру*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(62, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160216_115621_ps_62 does not support migration down.\\n";
		return false;
	}
}