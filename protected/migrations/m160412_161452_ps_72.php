<?php

class m160412_161452_ps_72 extends CDbMigration
{
	public function safeUp()
	{
		/*запись на дисциплины*/
		$sql = <<<SQL
			insert into PORTAL_SETTINGS(PS1, PS2) values(72, 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160412_161452_ps_72 does not support migration down.\\n";
		return false;
	}
}