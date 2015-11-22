<?php

class m151111_183648_create_JPV extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
    /* Ведение промежуточных модулей Модули УП (баллы) */
    CREATE TABLE JPV (JPV1 inte_not_null PRIMARY KEY,
        JPV2 inte, /* код SEM1 семестр */
        JPV3 inte, /* UO1*/
        JPV4 smal, /* № модуля 1,2...   -1- индив. -2 - экзамен */
        JPV5 inte); /* GR1*/
SQL;
		$this->execute($sql);
        $sql = <<<SQL
  ALTER TABLE JPV ADD constraint FK_JPV2_sem1 FOREIGN KEY (JPV2) REFERENCES sem (sem1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $sql = <<<SQL
 ALTER TABLE JPV ADD constraint FK_JPV3_uo1 FOREIGN KEY (JPV3) REFERENCES uo (uo1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $sql = <<<SQL
  ALTER TABLE JPV ADD constraint FK_JPV5_GR1 FOREIGN KEY (JPV5) REFERENCES GR (GR1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151111_183648_create_JPV does not support migration down.\\n";
		return false;
	}
}