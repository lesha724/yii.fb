<?php

class m151110_103707_create_pmc extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
    CREATE TABLE pmc (
      pmc1 inte, /* родитель */
      pmc2 inte);  /* реенок */
SQL;
        $this->execute($sql);
        $sql = <<<SQL
ALTER TABLE pmc ADD constraint FK_pmc2_pm1 FOREIGN KEY (pmc2) REFERENCES pm (pm1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151110_103707_create_pmc does not support migration down.\\n";
		return false;
	}
}