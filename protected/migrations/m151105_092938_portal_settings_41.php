<?php

class m151105_092938_portal_settings_41 extends CDbMigration
{
	public function safeUp()
	{
        //тип статистики 0-по журналу, 1 по деканату
        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(41, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151105_092938_portal_settings_41 does not support migration down.\\n";
		return false;
	}
}