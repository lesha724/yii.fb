<?php

class m140412_093156_grant4 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table grants add GRANTS4 smal;    /* ведомости 0-только к своим 1-ко всем на кафедре*/
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140412_093156_grant4 does not support migration down.\\n";
		return false;
	}
}