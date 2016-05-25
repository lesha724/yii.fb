<?php

class m160525_175342_alter_markb4 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
				alter table markb
					add markb4 smal;/*номер таблицы(для разных переводов)*/
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160525_175342_alter_markb4 does not support migration down.\\n";
		return false;
	}
}