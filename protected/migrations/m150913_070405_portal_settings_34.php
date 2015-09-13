<?php

class m150913_070405_portal_settings_34 extends CDbMigration
{
	public function safeUp()
	{
        //показівать ли бюджет контракт в списке групп
        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(34, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150913_070405_portal_settings_34 does not support migration down.\\n";
		return false;
	}
}