<?php

class m151025_132805_create_elgzst extends CDbMigration
{
	public function safeUp()
	{
        /* Электронный журнал успеваемость и посещаемость по занятиям */
        $sql = <<<SQL
        CREATE TABLE elgzst (elgzst0 inte_not_null PRIMARY KEY, /* первичный ключ */
          elgzst1 inte, /* код st1 */
          elgzst2 inte,  /* код ELGZ1 */
          elgzst3 smal,  /* посещаемость ( 0-присутствовал на занятии, 1-пропуск по неуваж. причине, 2-пропуск по уваж. причине ) */
          elgzst4 doub,  /* оценки (от 1 и до ...) */
          elgzst5 doub,  /* переcдача оценки (от 1 и до ...) */
          elgzst6 dat DEFAULT 'NOW' NOT NULL, /* дата корректировки */
          elgzst7 inte);  /* кто корректировал P1 */
SQL;
		$this->execute($sql);
        $sql = <<<SQL
        ALTER TABLE elgzst ADD constraint FK_elgzst1_st1 FOREIGN KEY (elgzst1) REFERENCES st (st1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
        ALTER TABLE elgzst ADD constraint FK_elgzst2_elgz1 FOREIGN KEY (elgzst2) REFERENCES elgz (elgz1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
       ALTER TABLE elgzst ADD constraint FK_elgzst7_p1 FOREIGN KEY (elgzst7) REFERENCES p (p1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
        INSERT INTO elgz (elgz1,elgz2,elgz3) VALUES (0,0,0);
SQL;
        $this->execute($sql);
        /*$sql = <<<SQL
        alter table elgzst add constraint PK_elgzst primary key (elgzst1,elgzst2);
SQL;
        $this->execute($sql);*/
	}

	public function safeDown()
	{
		echo "m151025_132805_create_elgzst does not support migration down.\\n";
		return false;
	}
}