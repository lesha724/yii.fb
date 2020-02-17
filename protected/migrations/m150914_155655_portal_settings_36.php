<?php

class m150914_155655_portal_settings_36 extends CDbMigration
{
	public function safeUp()
	{
		//максимальный бал в журнале
        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(36, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150914_155655_portal_settings_36 does not support migration down.\\n";
		return false;
	}
}