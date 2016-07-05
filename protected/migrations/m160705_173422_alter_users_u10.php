<?php

class m160705_173422_alter_users_u10 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			alter table users
					add u10 var45;/*reset password token*/
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160705_173422_alter_users_u10 does not support migration down.\\n";
		return false;
	}
}