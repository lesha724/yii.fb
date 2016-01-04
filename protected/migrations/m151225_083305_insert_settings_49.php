<?php

class m151225_083305_insert_settings_49 extends CDbMigration
{
	public function safeUp()
	{
		/*Карточка студента показывать ли таб веденение помодулей*/
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(49, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151225_083305_insert_settings_49 does not support migration down.\\n";
		return false;
	}
}