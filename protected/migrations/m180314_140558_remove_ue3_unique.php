<?php

class m180314_140558_remove_ue3_unique extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
          ALTER TABLE USERS_EMAIL DROP CONSTRAINT UNQ1_USERS_EMAIL
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m180314_140558_remove_ue3_unique does not support migration down.\\n";
		return false;
	}
}