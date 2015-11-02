<?php

class m151026_084344_gen_elgzst extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
          CREATE SEQUENCE GEN_ELGZST;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151026_084344_gen_elgzst does not support migration down.\\n";
		return false;
	}
}