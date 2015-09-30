<?php

class m150927_070615_drop_stegn10_11 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
        ALTER TABLE STEGN DROP STEGN10;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
        ALTER TABLE STEGN DROP STEGN11;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150927_070615_drop_stegn10_11 does not support migration down.\\n";
		return false;
	}
}