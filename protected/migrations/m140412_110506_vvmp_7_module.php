<?php

class m140412_110506_vvmp_7_module extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table vvmp add VVMP22 smal default 0,/* min оценка 7 модуль */
                 add VVMP23 smal default 0;/* max оценка 7 модуль */
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140412_110506_vvmp_7_module does not support migration down.\\n";
		return false;
	}
}