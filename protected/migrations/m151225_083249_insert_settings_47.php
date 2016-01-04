<?php

class m151225_083249_insert_settings_47 extends CDbMigration
{
	public function safeUp()
	{
		/*Карточка студента показывать ли таб журнла*/
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(47, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151225_083249_insert_settings_47 does not support migration down.\\n";
		return false;
	}
}