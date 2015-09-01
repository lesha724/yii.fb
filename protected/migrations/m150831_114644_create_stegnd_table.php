<?php

class m150831_114644_create_stegnd_table extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
CREATE TABLE stegnd (
  stegnd1 inte, /* код p1 */
  stegnd2 inte, /* доступ ко всем дисциплинам  K1  кафедры  */
  stegnd3 inte, /* доступ ко всем дисциплинам  F1  факультета */
  stegnd4 inte, /* доступ ко всем дисциплинам  D1  */
  stegnd5 inte, /* 1-доступ ко всем дисциплинам админ */
  stegnd6 smal, /* 0-чтение 1-полный */
  stegnd7 dat DEFAULT 'NOW' NOT NULL, /* дата входа */
  stegnd8 inte);  /* кто назначил P1 */
SQL;
		$this->execute($sql);
        $sql = <<<SQL
alter table stegnd add constraint PK_stegnd primary key (stegnd1,stegnd2,stegnd3,stegnd4,stegnd5,stegnd6);
SQL;
        $this->execute($sql);
        $sql = <<<SQL
ALTER TABLE stegnd ADD constraint FK_stegnd1_p1 FOREIGN KEY (stegnd1) REFERENCES p (p1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
ALTER TABLE stegnd ADD constraint FK_stegnd2_k1 FOREIGN KEY (stegnd2) REFERENCES k (k1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $sql = <<<SQL
ALTER TABLE stegnd ADD constraint FK_stegnd3_f1 FOREIGN KEY (stegnd3) REFERENCES f (f1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $sql = <<<SQL
ALTER TABLE stegnd ADD constraint FK_stegnd4_d1 FOREIGN KEY (stegnd4) REFERENCES d (d1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $sql = <<<SQL
ALTER TABLE stegnd ADD constraint FK_stegnd8_p1 FOREIGN KEY (stegnd8) REFERENCES p (p1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150831_114644_create_stegnd_table does not support migration down.\\n";
		return false;
	}
}