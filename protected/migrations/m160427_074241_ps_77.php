<?php

class m160427_074241_ps_77 extends CDbMigration
{
	public function safeUp()
	{
		/*закрыть посик студента в оарасписании для не авторизированных пользователей*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(77, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160427_074241_ps_77 does not support migration down.\\n";
		return false;
	}
}