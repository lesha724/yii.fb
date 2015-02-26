<?php

class m141115_090538_portal_settings_28 extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(28, '0');
SQL;

        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m141115_090538_portal_settings_28 does not support migration down.\\n";
		return false;
	}
}