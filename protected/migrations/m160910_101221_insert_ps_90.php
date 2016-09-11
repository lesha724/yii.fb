<?php

class m160910_101221_insert_ps_90 extends CDbMigration
{
	public function safeUp()
	{
		/*Менять темы занятий*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(90, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160910_101221_insert_ps_90 does not support migration down.\\n";
		return false;
	}
}