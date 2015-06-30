<?php

class m150626_152421_stegn_gen extends CDbMigration
{
	public function safeUp()
	{
                $sql = <<<SQL
CREATE SEQUENCE GEN_STEGN;
SQL;
                $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150626_152421_stegn_gen does not support migration down.\\n";
		return false;
	}
}