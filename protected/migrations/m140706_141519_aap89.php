<?php

class m140706_141519_aap89 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
ALTER TABLE aap
    ALTER COLUMN aap89 TYPE VARCHAR(150)
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140706_141519_aap89 does not support migration down.\\n";
		return false;
	}
}