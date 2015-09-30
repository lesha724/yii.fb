<?php

class m150929_110132_alter_stegnp_6_7 extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
alter table stegnp add stegnp6 dat DEFAULT 'NOW' NOT NULL,/* дата корректировки */
                  add stegnp7 inte;/* кто корректировал p1 */
SQL;
		$this->execute($sql);
        $sql = <<<SQL
        ALTER TABLE STEGNP ADD constraint FK_STEGNP7_p1 FOREIGN KEY (STEGNP7) REFERENCES p (p1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150929_110132_alter_stegnp_6_7 does not support migration down.\\n";
		return false;
	}
}