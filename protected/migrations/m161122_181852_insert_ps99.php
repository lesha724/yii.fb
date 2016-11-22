<?php

class m161122_181852_insert_ps99 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(99, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m161122_181852_insert_ps99 does not support migration down.\\n";
		return false;
	}
}