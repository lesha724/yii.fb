<?php

class m160217_094819_ps_64 extends CDbMigration
{
	public function safeUp()
	{
		/*Показывать ли в расписании преп. фильтры*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(64, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160217_094819_ps_64 does not support migration down.\\n";
		return false;
	}
}