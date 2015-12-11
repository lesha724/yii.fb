<?php

class m151211_112027_portal_settings_43 extends CDbMigration
{
	public function safeUp()
	{
		//текст закрытия портала для кафедр
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(43, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151211_112027_portal_settings_43 does not support migration down.\\n";
		return false;
	}
}