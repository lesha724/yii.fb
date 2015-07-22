<?php

class m150708_070605_portal_settings_29 extends CDbMigration
{
	public function safeUp()
	{
                //Блокировать поле пересдач
		$sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(29, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150708_070605_portal_settings_29 does not support migration down.\\n";
		return false;
	}
}