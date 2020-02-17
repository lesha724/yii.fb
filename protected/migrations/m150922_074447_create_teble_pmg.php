<?php

class m150922_074447_create_teble_pmg extends CDbMigration
{
	public function safeUp()
	{
        $sql = <<<SQL
        CREATE TABLE PMG(
            PMG1  inte_not_null PRIMARY KEY, /*'первичный ключ*/
            PMG2  VAR100, /*навзвание укр*/
            PMG3  VAR100, /*навзвание рус*/
            PMG4  VAR100, /*навзвание анг*/
            PMG5  VAR100, /*навзвание другой*/
            PMG7  SMAL, /*видимость*/
            PMG8  INTE,/*приоритет*/
            PMG9  VAR100); /*bootstap icom*/
SQL;
        $this->execute($sql);
        $sql = <<<SQL
          CREATE SEQUENCE GEN_PMG;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150922_074447_create_teble_pmg does not support migration down.\\n";
		return false;
	}
}