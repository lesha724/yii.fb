<?php

class m160905_152121_insert_ps_88 extends CDbMigration
{
	public function safeUp()
	{
		/*настройка для журнала галочка это пропуск или присутсвие*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(88, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160905_152121_insert_ps_88 does not support migration down.\\n";
		return false;
	}
}