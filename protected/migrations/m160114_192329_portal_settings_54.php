<?php

class m160114_192329_portal_settings_54 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(54, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160114_192329_portal_settings_54 does not support migration down.\\n";
		return false;
	}
}