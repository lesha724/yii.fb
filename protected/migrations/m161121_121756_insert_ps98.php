<?php

class m161121_121756_insert_ps98 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(98, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m161121_121756_insert_ps98 does not support migration down.\\n";
		return false;
	}
}