<?php

class m171127_162132_update_grants6 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
          UPDATE GRANTS set GRANTS6 = 0 
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m171127_162132_update_grants6 does not support migration down.\\n";
		return false;
	}
}