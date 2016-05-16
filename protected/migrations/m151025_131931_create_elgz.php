<?php

class m151025_131931_create_elgz extends CDbMigration
{
	public function safeUp()
	{
		$b15 = $this->getDBConnection()->createCommand(<<<SQL
			select b15 from b where b1=0
SQL
		)->queryScalar();

		if($b15!=6) {
			/* Занятия по электронному журналу */
			$sql = <<<SQL
        CREATE TABLE elgz (
          elgz1 inte_not_null PRIMARY KEY,  /*первичный ключ */
           elgz2 inte,  /* код ELG1 */
           elgz3 smal,  /* номер столбика (занятия) */
           elgz4 smal,  /* 0-занятие   1-субмодуль   2-ПМК */
           elgz5 doub,  /* мин балл столбика */
           elgz6 doub, /* макс балл  столбика */
           elgz7 inte); /* код USTEM1 */
SQL;
			$this->execute($sql);
			$sql = <<<SQL
        ALTER TABLE elgz ADD constraint FK_elgz2_elg1 FOREIGN KEY (elgz2) REFERENCES elg (elg1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
			$this->execute($sql);
			$sql = <<<SQL
        ALTER TABLE elgz ADD constraint FK_elgz7_ustem1 FOREIGN KEY (elgz7) REFERENCES ustem (ustem1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
			$this->execute($sql);
			$sql = <<<SQL
        INSERT INTO elg(elg1) VALUES (0);
SQL;
			$this->execute($sql);
		}
	}

	public function safeDown()
	{
		echo "m151025_131931_create_elgz does not support migration down.\\n";
		return false;
	}
}