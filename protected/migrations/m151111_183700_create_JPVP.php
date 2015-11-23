<?php

class m151111_183700_create_JPVP extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
    CREATE TABLE JPVP (
      JPVP1 inte,  /* JPV1 */
      JPVP2 inte); /* код P1 */
SQL;
		$this->execute($sql);
        $sql = <<<SQL
        ALTER TABLE JPVP ADD constraint FK_JPVP2_P1 FOREIGN KEY (JPVP2) REFERENCES P (P1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
        alter table JPVP add constraint PK_JPVP primary key (JPVP1,JPVP2);
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151111_183700_create_JPVP does not support migration down.\\n";
		return false;
	}
}