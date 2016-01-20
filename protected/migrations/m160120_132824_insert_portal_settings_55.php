<?php

class m160120_132824_insert_portal_settings_55 extends CDbMigration
{
	public function safeUp()
	{
		/*возможность ввода 0*/
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(55, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160120_132824_insert_portal_settings_55 does not support migration down.\\n";
		return false;
	}
}