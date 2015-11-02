<?php

class m151025_131153_create_elg extends CDbMigration
{
	public function safeUp()
	{
        /* Электронный журнал */
        $sql = <<<SQL
        CREATE TABLE elg (
           elg1 inte_not_null PRIMARY KEY,  /*первичный ключ */
           elg2 inte,  /* код UO1 */
           elg3 inte,  /* код SEM1 */
           elg4 smal); /* 0-лк 1-пз/сем/лб */
SQL;
		$this->execute($sql);
        $sql = <<<SQL
        ALTER TABLE elg ADD constraint FK_elg2_uo1 FOREIGN KEY (elg2) REFERENCES uo (uo1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
        $sql = <<<SQL
        ALTER TABLE elg ADD constraint FK_elg3_sem1 FOREIGN KEY (elg3) REFERENCES sem (sem1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151025_131153_create_elg does not support migration down.\\n";
		return false;
	}
}