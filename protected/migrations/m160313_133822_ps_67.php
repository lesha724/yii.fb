<?php

class m160313_133822_ps_67 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(67, 1);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160313_133822_ps_67 does not support migration down.\\n";
		return false;
	}
}