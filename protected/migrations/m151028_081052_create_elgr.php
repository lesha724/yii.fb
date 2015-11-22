<?php

class m151028_081052_create_elgr extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
    CREATE TABLE elgr (
      elgr1 inte NOT NULL, /* код gr1 */
      elgr2 inte NOT NULL,  /* код elgz1 */
      elgr3 dat,  /* дата окончания коректировки */
      elgr4 var50, /* примечание */
      elgr5 dat DEFAULT 'NOW' NOT NULL, /* дата корректировки */
      elgr6 inte);  /* кто корректировал I1 */
SQL;
		$this->execute($sql);
        $sql = <<<SQL
ALTER TABLE elgr ADD constraint FK_elgr1_gr1 FOREIGN KEY (elgr1) REFERENCES gr (gr1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
ALTER TABLE elgr ADD constraint FK_elgr2_elgz1 FOREIGN KEY (elgr2) REFERENCES elgz (elgz1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
alter table elgr add constraint PK_elgr primary key (elgr1,elgr2);
SQL;
        $this->execute($sql);
        $sql = <<<SQL
ALTER TABLE elgr ADD constraint FK_elgr_i1 FOREIGN KEY (elgr6) REFERENCES i (i1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151028_081052_create_elgr does not support migration down.\\n";
		return false;
	}
}