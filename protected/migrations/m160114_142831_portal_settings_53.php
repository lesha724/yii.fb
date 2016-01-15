<?php

class m160114_142831_portal_settings_53 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(53, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160114_142831_portal_settings_53 does not support migration down.\\n";
		return false;
	}
}