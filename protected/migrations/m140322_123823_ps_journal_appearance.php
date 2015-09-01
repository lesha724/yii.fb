<?php

class m140322_123823_ps_journal_appearance extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(8, '0');
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140322_123823_ps_journal_appearance does not support migration down.\\n";
		return false;
	}
}