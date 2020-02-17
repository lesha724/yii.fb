<?php

class m140412_094841_modules_extra_columns extends CDbMigration
{
	public function safeUp()
	{

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(10, '1');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(11, '');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(12, '1');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(13, '');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(14, '1');
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        insert into PORTAL_SETTINGS(PS1, PS2) values(15, '');
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140412_094841_modules_extra_columns does not support migration down.\\n";
		return false;
	}
}