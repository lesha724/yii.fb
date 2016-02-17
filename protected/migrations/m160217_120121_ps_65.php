<?php

class m160217_120121_ps_65 extends CDbMigration
{
	public function safeUp()
	{
		/*Автопроставление пропусков*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(65, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160217_120121_ps_65 does not support migration down.\\n";
		return false;
	}
}