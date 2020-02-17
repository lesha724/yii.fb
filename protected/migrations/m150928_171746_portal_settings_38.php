<?php

class m150928_171746_portal_settings_38 extends CDbMigration
{
	public function safeUp()
	{
		//1-закрыть сайт на тех работы
        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(38, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150928_171746_portal_settings_38 does not support migration down.\\n";
		return false;
	}
}