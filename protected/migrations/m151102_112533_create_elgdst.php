<?php

class m151102_112533_create_elgdst extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
/* Электронный журнал Дополнительные балы студента */
CREATE TABLE elgdst (
elgdst0 inte_not_null PRIMARY KEY, /* первичный ключ */
  elgdst1 inte, /* код st1 */
  elgdst2 inte,  /* код elgd0 */
  elgdst3 doub); /* Доп баллы */
SQL;
        $this->execute($sql);
        $sql = <<<SQL
ALTER TABLE elgdst ADD constraint FK_elgdst1_st1 FOREIGN KEY (elgdst1) REFERENCES st (st1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
ALTER TABLE elgdst ADD constraint FK_elgdst2_elgd1 FOREIGN KEY (elgdst2) REFERENCES elgd (elgd0) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
CREATE SEQUENCE GEN_elgdst;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151102_112533_create_elgdst does not support migration down.\\n";
		return false;
	}
}