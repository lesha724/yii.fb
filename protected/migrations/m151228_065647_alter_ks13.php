<?php

class m151228_065647_alter_ks13 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			alter table KS add KS13 smal;
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151228_065647_alter_ks13 does not support migration down.\\n";
		return false;
	}
}