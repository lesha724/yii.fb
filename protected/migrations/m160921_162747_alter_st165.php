<?php

class m160921_162747_alter_st165 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			alter table st
					add st165 var1000;/*общая успеваемость карточка студента*/
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160921_162747_alter_st165 does not support migration down.\\n";
		return false;
	}
}