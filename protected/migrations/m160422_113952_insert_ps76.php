<?php

class m160422_113952_insert_ps76 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(76, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160422_113952_insert_ps76 does not support migration down.\\n";
		return false;
	}
}