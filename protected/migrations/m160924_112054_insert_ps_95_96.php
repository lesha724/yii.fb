<?php

class m160924_112054_insert_ps_95_96 extends CDbMigration
{
	public function safeUp()
	{
		/*xml api login*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(95, '');
SQL;
		$this->execute($sql);
		/*xml api password*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(96, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160924_112054_insert_ps_95_96 does not support migration down.\\n";
		return false;
	}
}