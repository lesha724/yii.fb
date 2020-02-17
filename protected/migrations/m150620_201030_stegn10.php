<?php

class m150620_201030_stegn10 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table stegn add stegn10 smal;  /* 0, 1-с отработкой ,2-...   */
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150620_201030_stegn10 does not support migration down.\\n";
		return false;
	}
}