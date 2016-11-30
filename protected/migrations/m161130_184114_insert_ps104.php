<?php

class m161130_184114_insert_ps104 extends CDbMigration
{
	public function safeUp()
	{
		/*в футере mkr текстом*/
		$sql = <<<SQL
		insert into PORTAL_SETTINGS(PS1, PS2) values(104, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m161130_184114_insert_ps104 does not support migration down.\\n";
		return false;
	}
}