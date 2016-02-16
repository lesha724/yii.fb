<?php

class m160216_115625_ps_63 extends CDbMigration
{
	public function safeUp()
	{
		/*Текст на главной ен*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(63, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160216_115625_ps_63 does not support migration down.\\n";
		return false;
	}
}