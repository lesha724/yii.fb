<?php

class m160503_133122_ps_78 extends CDbMigration
{
	public function safeUp()
	{
		/*тип резрешения по времени на внесение в электронный журнал*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(78, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160503_133122_ps_78 does not support migration down.\\n";
		return false;
	}
}