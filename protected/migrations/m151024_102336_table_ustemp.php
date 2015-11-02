<?php

class m151024_102336_table_ustemp extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
        CREATE TABLE USTEMP (USTEMP1  INTE);
SQL;
		$this->execute($sql);
        $sql = <<<SQL
        ALTER TABLE USTEMP ADD CONSTRAINT FK_USTEMP_1 FOREIGN KEY (USTEMP1) REFERENCES US (US1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151024_102336_table_ustemp does not support migration down.\\n";
		return false;
	}
}