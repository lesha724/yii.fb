<?php

class m150926_162323_alter_ustem8_9 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
        alter table USTEM add USTEM8 dat DEFAULT 'NOW' NOT NULL;
SQL;
		$this->execute($sql);

        $sql = <<<SQL
        alter table USTEM add USTEM9 inte;
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        ALTER TABLE ustem ADD constraint FK_ustem9_p1 FOREIGN KEY (ustem9) REFERENCES p (p1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150926_162323_alter_ustem8_9 does not support migration down.\\n";
		return false;
	}
}