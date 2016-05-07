<?php

class m160507_095043_ps_80 extends CDbMigration
{
	public function safeUp()
	{
		/*скрывать баннер Плаймаркет*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(80, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160507_095043_ps_80 does not support migration down.\\n";
		return false;
	}
}