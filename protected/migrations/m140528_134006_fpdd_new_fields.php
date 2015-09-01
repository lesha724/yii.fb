<?php

class m140528_134006_fpdd_new_fields extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table fpdd add fpdd4 var250,add fpdd5 var250;
SQL;
		$this->execute($sql);
/*fpdd4 - new name fpdd5 - old name*/
        $sql = <<<SQL
        ALTER TABLE FPDD DROP CONSTRAINT PK_FPDD
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140528_134006_fpdd_new_fields does not support migration down.\\n";
		return false;
	}
}