<?php

class m150625_131829_create_stegn_new extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
CREATE TABLE stegn (stegn0 inte_not_null PRIMARY KEY, /* код #*/
  stegn1 inte, /* код st1 */
  stegn2 inte,  /* код US1 */
  stegn3 smal,  /* номер занятия */
  stegn4 smal,  /* посещаемость ( 0-присутствовал на занятии, 1-пропуск по неуваж. причине, 2-пропуск по уваж. причине ) */
  stegn5 doub,  /* оценки (от 1 и до ...) */
  stegn6 doub,  /* переcдача оценки (от 1 и до ...) */
  stegn7 dat DEFAULT 'NOW' NOT NULL, /* дата корректировки */
  stegn8 inte,  /* кто корректировал P1 */
  stegn9 dat,  /* дата занятия */
  stegn10 smal,  /* 0, 1-с отработкой ,2-...   */
  stegn11 var20); /* пояснение пропуска, № справки например */
SQL;
		$this->execute($sql);
		$sql = <<<SQL
ALTER TABLE stegn ADD constraint FK_stegn1_st1 FOREIGN KEY (stegn1) REFERENCES st (st1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
		$this->execute($sql);
		$sql = <<<SQL
ALTER TABLE stegn ADD constraint FK_stegn2_us1 FOREIGN KEY (stegn2) REFERENCES us (us1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
		$this->execute($sql);
		$sql = <<<SQL
ALTER TABLE stegn ADD constraint FK_stegn8_p1 FOREIGN KEY (stegn8) REFERENCES p (p1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
		$this->execute($sql);
		$sql = <<<SQL
alter table stegn add constraint OcenkaDublir Unique (stegn1,stegn2,stegn3);
SQL;
                $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150625_131829_create_stegn_new does not support migration down.\\n";
		return false;
	}
}