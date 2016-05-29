<?php

class m160529_122518_insert_ps_85 extends CDbMigration
{
	public function safeUp()
	{
		/*скрывать столбец Всего*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(85, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160529_122518_insert_ps_85 does not support migration down.\\n";
		return false;
	}
}