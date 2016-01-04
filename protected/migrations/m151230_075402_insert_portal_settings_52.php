<?php

class m151230_075402_insert_portal_settings_52 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(52, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151230_075402_insert_portal_settings_52 does not support migration down.\\n";
		return false;
	}
}