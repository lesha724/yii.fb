<?php

class m151025_144922_alter_r8 extends CDbMigration
{
	public function safeUp()
	{
        /*$sql = <<<SQL
        alter table r drop R8 inte;
SQL;*/
        $sql = <<<SQL
        alter table r add R8 inte;
SQL;
		$this->execute($sql);
        $sql = <<<SQL
        ALTER TABLE r ADD constraint FK_r8_elgz1 FOREIGN KEY (r8) REFERENCES elgz (elgz1) ON DELETE SET DEFAULT ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m151025_144922_alter_r8 does not support migration down.\\n";
		return false;
	}
}