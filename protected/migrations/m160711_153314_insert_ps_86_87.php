<?php

class m160711_153314_insert_ps_86_87 extends CDbMigration
{
	public function safeUp()
	{
		/*Письмо для смены пароля*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(86, '');
SQL;
		$this->execute($sql);
		/*Письмо о смене пароля*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(87, '');
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160711_153314_insert_ps_86_87 does not support migration down.\\n";
		return false;
	}
}