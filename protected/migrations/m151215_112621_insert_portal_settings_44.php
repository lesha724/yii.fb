<?php

class m151215_112621_insert_portal_settings_44 extends CDbMigration
{
	public function safeUp()
	{
		//тип пересчета для портала
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(44, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151215_112621_insert_portal_settings_44 does not support migration down.\\n";
		return false;
	}
}