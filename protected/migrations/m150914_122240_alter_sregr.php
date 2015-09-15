<?php

class m150914_122240_alter_sregr extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
        alter table stegr add stegr5 var50, /* примечание */
                 add stegr6 dat DEFAULT 'NOW' NOT NULL,/* дата корректировки */
                  add stegr7 inte;/* кто корректировал I1 */
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150914_122240_alter_sregr does not support migration down.\\n";
		return false;
	}
}