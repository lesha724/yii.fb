<?php

class m160817_165945_alter_p132 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			alter table p
					add p132 INTE;/*out id*/
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160817_165945_alter_p132 does not support migration down.\\n";
		return false;
	}
}