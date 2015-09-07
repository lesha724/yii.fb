<?php

class m150907_103651_portal_settings_33 extends CDbMigration
{
	public function safeUp()
	{
		//переводить ли в 200 бальную систему
        $sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(33, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150907_103651_portal_settings_33 does not support migration down.\\n";
		return false;
	}
}