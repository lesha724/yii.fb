<?php

class m160507_100830_ps81 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(81, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160507_100830_ps81 does not support migration down.\\n";
		return false;
	}
}