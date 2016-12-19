<?php

class m161218_104240_insert_ps_106 extends CDbMigration
{
	public function safeUp()
	{
		/*ввод старостами посещаемости*/
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(106, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m161218_104240_insert_ps_106 does not support migration down.\\n";
		return false;
	}
}