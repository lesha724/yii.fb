<?php

class m150922_174320_alter_pmg6 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table pmg add pmg6 smal;    /* 0-доступен для всех пользоватлей, 1 - для авторизированных*/
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150922_174320_alter_pmg6 does not support migration down.\\n";
		return false;
	}
}