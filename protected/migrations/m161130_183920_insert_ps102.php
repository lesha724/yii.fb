<?php

class m161130_183920_insert_ps102 extends CDbMigration
{
	public function safeUp()
	{
		/*скрывать пункт регистрация*/
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(102, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m161130_183920_insert_ps102 does not support migration down.\\n";
		return false;
	}
}