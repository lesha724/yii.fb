<?php

class m161130_184016_insert_ps103 extends CDbMigration
{
	public function safeUp()
	{
		/*скрывать пункт забыл пароль*/
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(103, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m161130_184016_insert_ps103 does not support migration down.\\n";
		return false;
	}
}