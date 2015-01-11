<?php

class m150111_092324_nkrs8 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table nkrs add nkrs8 var350;    /* id документа из антиплагиат */
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150111_092324_nkrs8 does not support migration down.\\n";
		return false;
	}
}