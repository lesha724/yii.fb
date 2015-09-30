<?php

class m150929_110027_alter_stego_5_6 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table stego add stego5 dat DEFAULT 'NOW' NOT NULL,/* дата корректировки */
                  add stego6 inte;/* кто корректировал I1 */
SQL;
		$this->execute($sql);
        $sql = <<<SQL
        ALTER TABLE stego ADD constraint FK_stego6_p1 FOREIGN KEY (stego6) REFERENCES p (p1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150929_110027_alter_stego_5_6 does not support migration down.\\n";
		return false;
	}
}