<?php

class m151102_112511_create_elgd extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
/* Электронный журнал дополнительные колонки */
CREATE TABLE elgd (elgd0 inte_not_null PRIMARY KEY,  /*первичный ключ */
   elgd1 inte,  /* код ELG1 */
   elgd2 inte);  /* код ELGSD1 */
SQL;
		$this->execute($sql);
        $sql = <<<SQL
  ALTER TABLE elgd ADD constraint FK_elgd1_elg1 FOREIGN KEY (elgd1) REFERENCES elg (elg1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
  ALTER TABLE elgd ADD constraint FK_elgd2_elgsd1 FOREIGN KEY (elgd2) REFERENCES elgsd (elgsd1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151102_112511_create_elgd does not support migration down.\\n";
		return false;
	}
}