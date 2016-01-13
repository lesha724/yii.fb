<?php

class m160113_093137_insert_gen_elgd extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			CREATE SEQUENCE GEN_elgd;
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160113_093137_insert_gen_elgd does not support migration down.\\n";
		return false;
	}
}