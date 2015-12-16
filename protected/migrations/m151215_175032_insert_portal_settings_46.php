<?php

class m151215_175032_insert_portal_settings_46 extends CDbMigration
{
	public function safeUp()
	{
		//Название министерсва
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(46, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151215_175032_insert_portal_settings_46 does not support migration down.\\n";
		return false;
	}
}