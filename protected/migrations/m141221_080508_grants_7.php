<?php

class m141221_080508_grants_7 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table grants add grants7 smal;    /* данные студента 0-нет доступа 1-полный доступ*/
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m141221_080508_grants_7 does not support migration down.\\n";
		return false;
	}
}