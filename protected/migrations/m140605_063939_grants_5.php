<?php

class m140605_063939_grants_5 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table grants add grants5 smal;    /* документооборот 0-нет 1-да*/
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140605_063939_grants_4 does not support migration down.\\n";
		return false;
	}
}