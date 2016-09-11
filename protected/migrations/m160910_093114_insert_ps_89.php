<?php

class m160910_093114_insert_ps_89 extends CDbMigration
{
	public function safeUp()
	{
		/*добавлять ли пустые оценки по занятиям*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(89, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160910_093114_insert_ps_89 does not support migration down.\\n";
		return false;
	}
}