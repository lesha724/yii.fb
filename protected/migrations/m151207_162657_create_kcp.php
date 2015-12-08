<?php

class m151207_162657_create_kcp extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
    /* закрытие портала для кафедры */
    CREATE TABLE KCP (KCP1 inte_not_null PRIMARY KEY,
        KCP2 inte); /* K1*/
SQL;
		$this->execute($sql);
		$sql = <<<SQL
  ALTER TABLE KCP ADD constraint FK_KCP2_K1 FOREIGN KEY (KCP2) REFERENCES K (K1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151207_162657_create_kcp does not support migration down.\\n";
		return false;
	}
}