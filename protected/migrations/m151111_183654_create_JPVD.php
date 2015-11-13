<?php

class m151111_183654_create_JPVD extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
        /* Модули УП(баллы) подчиненная*/
        CREATE TABLE JPVD (JPVD0 inte_not_null PRIMARY KEY,
          JPVD1 inte_not_null,  /* JPV1 */
          JPVD2 inte, /* код ST1 студента */
          JPVD3 smal, /* оценка */
          JPVD4 dat DEFAULT 'NOW' NOT NULL, /* дата корректировки */
          JPVD5 inte, /* I1 кто корректировал */
          JPVD6 inte); /* P1 кто корректировал */
SQL;
		$this->execute($sql);
        $sql = <<<SQL
      ALTER TABLE JPVD ADD constraint FK_JPVD1_JPV1 FOREIGN KEY (JPVD1) REFERENCES JPV (JPV1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
      ALTER TABLE JPVD ADD constraint FK_JPVD2_ST1 FOREIGN KEY (JPVD2) REFERENCES st (st1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
      ALTER TABLE JPVD ADD constraint FK_JPVD5_I1 FOREIGN KEY (JPVD5) REFERENCES i (i1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
     ALTER TABLE JPVD ADD constraint FK_JPVD6_P1 FOREIGN KEY (JPVD6) REFERENCES p (p1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
     CREATE SEQUENCE GEN_JPVD;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151111_183654_create_JPVD does not support migration down.\\n";
		return false;
	}
}