<?php

class m180312_155508_alter_users_email_unique_ue3 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
          ALTER TABLE USERS_EMAIL ADD CONSTRAINT UNQ1_USERS_EMAIL UNIQUE (UE3);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m180312_155508_alter_users_email_unique_ue3 does not support migration down.\\n";
		return false;
	}
}