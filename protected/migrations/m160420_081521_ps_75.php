<?php

class m160420_081521_ps_75 extends CDbMigration
{
	public function safeUp()
	{
		/*закрыть посик перподователя в оарасписании для не авторизированных пользователей*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(75, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160420_081521_ps_75 does not support migration down.\\n";
		return false;
	}
}