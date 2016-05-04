<?php

class m160503_133130_ps_79 extends CDbMigration
{
	public function safeUp()
	{
		/*время после занятия в ктоторое разрешено редактирование оценко если ps78=1*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(79, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160503_133130_ps_79 does not support migration down.\\n";
		return false;
	}
}