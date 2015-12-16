<?php

class m151215_175023_insert_portal_settings_45 extends CDbMigration
{
	public function safeUp()
	{
		//Название вуза (используетться для печати тайтла в журнале)
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(45, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151215_175023_insert_portal_settings_45 does not support migration down.\\n";
		return false;
	}
}