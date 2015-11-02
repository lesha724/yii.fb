<?php

class m151102_130955_alter_elgdst4_5 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
    alter table elgdst add elgdst4 dat DEFAULT 'NOW' NOT NULL, add elgdst5 inte;
SQL;
		$this->execute($sql);
        $sql = <<<SQL
    ALTER TABLE elgdst ADD constraint FK_elgdst5_p1 FOREIGN KEY (elgdst5) REFERENCES p (p1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151102_130955_alter_elgdst4_5 does not support migration down.\\n";
		return false;
	}
}