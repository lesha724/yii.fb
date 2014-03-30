<?php

class m140314_140426_portal_settings extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
 /* настройки портала */
CREATE TABLE PORTAL_SETTINGS (
  PS1 inte_not_null PRIMARY KEY,
  PS2 var1000);
/*
	0-отображать dsej4
	1-имя для dsej4
	2-отображать dsej5
	3-имя для dsej5
	4-отображать dsej6
	5-имя для dsej6
	6-отображать dsej7
	7-имя для dsej7
	8-внешний вид журнала
	9-учитывать min max в журнале
*/
SQL;
		$this->execute($sql);




	}

	public function safeDown()
	{
		echo "m140314_140426_portal_settings does not support migration down.\\n";
		return false;
	}
}