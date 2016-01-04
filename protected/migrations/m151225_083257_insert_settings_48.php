<?php

class m151225_083257_insert_settings_48 extends CDbMigration
{
	public function safeUp()
	{
		/*Карточка студента показывать ли таб отработка*/
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(48, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151225_083257_insert_settings_48 does not support migration down.\\n";
		return false;
	}
}