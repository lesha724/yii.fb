<?php

class m160509_150322_ps82 extends CDbMigration
{
	public function safeUp()
	{
		/*тип подсчета тек по пмк*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(82, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160509_150322_ps82 does not support migration down.\\n";
		return false;
	}
}