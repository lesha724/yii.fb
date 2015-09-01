<?php

class m140413_085438_portal_settings_module_min_max extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(16, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140413_085438_portal_settings_module_min_max does not support migration down.\\n";
		return false;
	}
}