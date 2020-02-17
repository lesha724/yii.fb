<?php

class m140330_075343_journal_min_max extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
insert into PORTAL_SETTINGS(PS1, PS2) values(9, '0');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140330_075343_journal_min_max does not support migration down.\\n";
		return false;
	}
}