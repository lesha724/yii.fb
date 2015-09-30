<?php

class m150927_070517_create_stegnp extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
    CREATE TABLE STEGNP(
        STEGNP0  inte_not_null PRIMARY KEY, /*'первичный ключ*/
        STEGNP1 inte, /*stegn0*/
        STEGNP2 smal,  /*тип пропуска 1-без відробок, 2-по хворобі ,3-чергування,4-інше, 5-по оплате   */
        STEGNP3 var20, /* пояснение пропуска, № справки например */
        STEGNP4 var20, /* номер квитанции для STEGNP2=5(по оплате)*/
        STEGNP5 dat); /* дата квитанции для STEGNP2=5(по оплате)*/
SQL;
		$this->execute($sql);
        $sql = <<<SQL
    ALTER TABLE STEGNP ADD constraint FK_stegnp1_stegn0 FOREIGN KEY (STEGNP1) REFERENCES stegn (stegn0) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $sql = <<<SQL
    CREATE SEQUENCE GEN_STEGNP;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m150927_070517_create_stegnp does not support migration down.\\n";
		return false;
	}
}