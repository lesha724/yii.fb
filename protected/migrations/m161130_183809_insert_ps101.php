<?php

class m161130_183809_insert_ps101 extends CDbMigration
{
	public function safeUp()
	{
		/*скрывать выор языка*/
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(101, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m161130_183809_insert_ps101 does not support migration down.\\n";
		return false;
	}
}