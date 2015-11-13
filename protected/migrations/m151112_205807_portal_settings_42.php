<?php

class m151112_205807_portal_settings_42 extends CDbMigration
{
	public function safeUp()
	{
        //показывать ли в модулях таблицу 3
        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(42, '0');
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151112_205807_portal_settings_42 does not support migration down.\\n";
		return false;
	}
}