<?php

class m151106_082348_alter_table_tso12 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table tso add tso12 var50;
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151106_082348_alter_table_tso12 does not support migration down.\\n";
		return false;
	}
}