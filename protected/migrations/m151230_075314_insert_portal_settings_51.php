<?php

class m151230_075314_insert_portal_settings_51 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(51, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151230_075314_insert_portal_settings_51 does not support migration down.\\n";
		return false;
	}
}