<?php

class m140404_115906_users_index extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
CREATE INDEX USERS_U6_U5 ON USERS (U6, U5);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140404_115906_users_index does not support migration down.\\n";
		return false;
	}
}