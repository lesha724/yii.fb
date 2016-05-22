<?php

class m160521_180257_create_users_history extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			CREATE TABLE USERS_HISTORY (
				UH1  INTE_NOT_NULL NOT NULL /* ключ */,
				UH2  INTE /* users u1 */,
				UH3  SMAL /* 0 - desktop, 1-tablet, 2-mobile */,
				UH4  VAR20 /* ip */,
				UH5  DAT_NOT_NUL /* date */,
				UH6  VAR45 /* browser */
			);
SQL;
		$this->execute($sql);

		$sql = <<<SQL
			ALTER TABLE USERS_HISTORY ADD CONSTRAINT PK_USERS_HISTORY PRIMARY KEY (UH1);
SQL;
		$this->execute($sql);

		$sql = <<<SQL
			ALTER TABLE USERS_HISTORY ADD CONSTRAINT FK_USERS_HISTORY_1 FOREIGN KEY (UH2) REFERENCES USERS(U1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
		$this->execute($sql);

		$sql = <<<SQL
			CREATE SEQUENCE GEN_UH;
SQL;
		$this->execute($sql);
	}

	public function safeDown()
	{
		echo "m160521_180257_create_users_history does not support migration down.\\n";
		return false;
	}
}