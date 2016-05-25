<?php

class m160525_174943_alter_elgsd4 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			alter table elgsd
					add elgsd4 smal;/*1 - для сумированния по индивидуальной работы */
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160525_174943_alter_elgsd4 does not support migration down.\\n";
		return false;
	}
}