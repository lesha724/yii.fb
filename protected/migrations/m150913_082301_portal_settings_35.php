<?php

class m150913_082301_portal_settings_35 extends CDbMigration
{
	public function safeUp()
	{
        //показівать ли для админа закрепления паспорта
        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(35, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150913_082301_portal_settings_35 does not support migration down.\\n";
		return false;
	}
}