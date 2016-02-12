<?php

class m160212_081724_insert_ps_59 extends CDbMigration
{
	public function safeUp()
	{
		/*Журнал показывать ли кафедру */
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(59, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160212_081724_insert_ps_59 does not support migration down.\\n";
		return false;
	}
}