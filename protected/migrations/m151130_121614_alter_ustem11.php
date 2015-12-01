<?php

class m151130_121614_alter_ustem11 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			alter table USTEM add USTEM11 inte;
SQL;
		$this->execute($sql);
		$sql = <<<SQL
			 ALTER TABLE USTEM ADD constraint FK_USTEM11_k1 FOREIGN KEY (USTEM11) REFERENCES k (k1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151130_121614_alter_ustem11 does not support migration down.\\n";
		return false;
	}
}