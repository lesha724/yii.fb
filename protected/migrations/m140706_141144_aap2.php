<?php

class m140706_141144_aap2 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
ALTER TABLE AAP DROP AAP113
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140706_141144_aap2 does not support migration down.\\n";
		return false;
	}
}