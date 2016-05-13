<?php

class m160313_130122_add_st163 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			alter table st add st163 dat;
SQL;
		//$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160313_130122_add_st163 does not support migration down.\\n";
		return false;
	}
}