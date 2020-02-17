<?php

class m150625_131811_drop_stegn extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
                   drop table stegn
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150625_131811_drop_stegn does not support migration down.\\n";
		return false;
	}
}