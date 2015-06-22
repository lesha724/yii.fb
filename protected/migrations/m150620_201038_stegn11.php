<?php

class m150620_201038_stegn11 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table stegn add  stegn11 var20; /* пояснение пропуска, № справки например */
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150620_201038_stegn11 does not support migration down.\\n";
		return false;
	}
}