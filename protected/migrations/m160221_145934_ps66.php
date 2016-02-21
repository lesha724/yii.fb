<?php

class m160221_145934_ps66 extends CDbMigration
{
	public function safeUp()
	{
		/*Вводить отработки в журнале*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(66, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160221_145934_ps66 does not support migration down.\\n";
		return false;
	}
}