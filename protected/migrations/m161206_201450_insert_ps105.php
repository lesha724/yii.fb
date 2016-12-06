<?php

class m161206_201450_insert_ps105 extends CDbMigration
{
	public function safeUp()
	{
		/*скрывать хлебные корошки*/
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(105, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m161206_201450_insert_ps105 does not support migration down.\\n";
		return false;
	}
}