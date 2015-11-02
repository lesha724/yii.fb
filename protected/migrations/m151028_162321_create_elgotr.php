<?php

class m151028_162321_create_elgotr extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
CREATE TABLE elgotr (elgotr0  inte_not_null PRIMARY KEY, /*'первичный ключ*/
  elgotr1 inte, /* код elgzst0 */
  elgotr2 doub,  /* оценки (от 1 и до ...) */
  elgotr3 dat DEFAULT 'NOW' NOT NULL, /* дата отработки */
  elgotr4 inte,  /* кто принимал P1 */
  elgotr5 dat DEFAULT 'NOW' NOT NULL); /* дата корректировки */
SQL;
		$this->execute($sql);
        $sql = <<<SQL
ALTER TABLE elgotr ADD constraint FK_elgotr1_elgzst0 FOREIGN KEY (elgotr1) REFERENCES elgzst (elgzst0) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
ALTER TABLE elgotr ADD constraint FK_elgotr4_p1 FOREIGN KEY (elgotr4) REFERENCES p (p1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
CREATE SEQUENCE GEN_elgotr;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151028_162321_create_elgotr does not support migration down.\\n";
		return false;
	}
}