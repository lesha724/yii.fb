<?php

class m150930_070437_insert_portal_to_utl extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
        INSERT INTO UTL (UTL1, UTL2, UTL3) VALUES (999, 'Портал', 0);
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150930_070437_insert_portal_to_utl does not support migration down.\\n";
		return false;
	}
}