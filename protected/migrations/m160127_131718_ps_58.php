<?php

class m160127_131718_ps_58 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(58, 'ru');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160127_131718_ps_58 does not support migration down.\\n";
		return false;
	}
}