<?php

class m161004_192907_insert_ps_97 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(97, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m161004_192907_insert_ps_97 does not support migration down.\\n";
		return false;
	}
}