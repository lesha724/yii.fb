<?php

class m160702_073917_add_user_salt extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			alter table users
					add u9 var45;/*salt*/
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160702_073917_add_user_salt does not support migration down.\\n";
		return false;
	}
}