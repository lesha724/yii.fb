<?php

class m180312_150436_create_users_email extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
		/*Таблица для подтвреждения почты пользвателем*/
        CREATE TABLE USERS_EMAIL (
            UE1  VAR100 PRIMARY KEY /*Почта для подвреждения*/,
            UE2  INTE /*пользователь*/,
            UE3  VAR45 /*Токен*/
        );
SQL;
        $this->execute($sql);

        $sql = <<<SQL
        ALTER TABLE USERS_EMAIL ADD CONSTRAINT FK_USERS_EMAIL_1 FOREIGN KEY (UE2) REFERENCES USERS (U1) ON DELETE CASCADE ON UPDATE CASCADE;
SQL;
        $this->execute($sql);
	}

	public function safeDown()
	{
		echo "m180312_150436_create_users_email does not support migration down.\\n";
		return false;
	}
}