<?php

class m140616_084014_portal_settings_26 extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(26, '');
SQL;

		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140616_084014_portal_settings_26 does not support migration down.\\n";
		return false;
	}
}