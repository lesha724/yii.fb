<?php

class m150831_110128_create_stegr_table extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
/* Назначение дней в электронном журнале, для просталения оценок */
CREATE TABLE stegr (
  stegr1 inte, /* код gr1 */
  stegr2 inte,  /* код US1 */
  stegr3 dat_not_nul,  /*дата занятия */
  stegr4 dat  /* дата окончания коректировки */
  );
SQL;
		$this->execute($sql);
        $sql = <<<SQL
ALTER TABLE stegr ADD constraint FK_stegr1_gr1 FOREIGN KEY (stegr1) REFERENCES gr (gr1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
ALTER TABLE stegr ADD constraint FK_stegr2_us1 FOREIGN KEY (stegr2) REFERENCES us (us1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $sql = <<<SQL
alter table stegr add constraint PK_stegr primary key (stegr1,stegr2,stegr3);
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150831_110128_create_stegr_table does not support migration down.\\n";
		return false;
	}
}