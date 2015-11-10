<?php

class m151110_103648_alter_pm_11 extends CDbMigration
{
	public function safeUp()
	{
		/* 0-главный пункт, 1 -дочерний*/
        $sql = <<<SQL
          alter table pm add pm11 smal;
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151110_103648_alter_pm_11 does not support migration down.\\n";
		return false;
	}
}