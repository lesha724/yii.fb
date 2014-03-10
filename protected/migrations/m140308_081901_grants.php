<?php

class m140308_081901_grants extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
  CREATE TABLE GRANTS (
	GRANTS1 inte PRIMARY KEY,    /* код P1 */
	GRANTS2 inte,    /* код P1 */
	GRANTS3 smal    /* эл. журнал 0-только к своим 1-ко всем на кафедре*/
  );
SQL;
		$this->execute($sql);

        $sql = <<<SQL
ALTER TABLE GRANTS ADD constraint FK_GRANTS2_P1 FOREIGN KEY (GRANTS2) REFERENCES P (P1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);

        $sql = <<<SQL
CREATE SEQUENCE GEN_GRANTS;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140308_081901_grants does not support migration down.\\n";
		return false;
	}
}