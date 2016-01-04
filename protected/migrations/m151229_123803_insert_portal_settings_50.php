<?php

class m151229_123803_insert_portal_settings_50 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(50, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151229_123803_insert_portal_settings_50 does not support migration down.\\n";
		return false;
	}
}