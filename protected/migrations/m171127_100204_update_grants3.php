<?php

class m171127_100204_update_grants3 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
            UPDATE GRANTS set GRANTS3 = 0 
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m171127_100204_update_grants3 does not support migration down.\\n";
		return false;
	}
}