<?php

class m160530_081405_alter_elgdsd5 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			alter table elgsd
					add elgsd5 smal DEFAULT 0;/*Ограничение ввода*/
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160530_081405_alter_elgdsd5 does not support migration down.\\n";
		return false;
	}
}