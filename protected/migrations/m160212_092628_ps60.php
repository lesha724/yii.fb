<?php

class m160212_092628_ps60 extends CDbMigration
{
	public function safeUp()
	{
		/*Журнал блокировать непереведенных студентов*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(60, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160212_092628_ps60 does not support migration down.\\n";
		return false;
	}
}