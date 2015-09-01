<?php

class m140207_083949_users extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
CREATE TABLE USERS (
  U1 inte_not_null PRIMARY KEY,
  U2 var50,           /* login  */
  U3 var50,	          /* password  */
  U4 var100,	      /* email  */
  U5 SMALLINT DEFAULT NULL,   /* 0-st1, 1-p1, 2-parent   */
  U6 INTEGER DEFAULT NULL,   /* ID: parent->st1, st1 or p1 */
  U7 smal);           /* 0-user 1-admin */
SQL;
		$this->execute($sql);

        $sql = <<<SQL
        CREATE SEQUENCE GEN_USERS;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m140207_083949_users does not support migration down.\\n";
		return false;
	}
}