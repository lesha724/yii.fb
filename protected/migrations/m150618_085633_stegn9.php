<?php

class m150618_085633_stegn9 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table stegn add stegn9 dat DEFAULT 'NOW' NOT NULL;    /*дата занятия*/
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150618_085633_stegn9 does not support migration down.\\n";
		return false;
	}
}