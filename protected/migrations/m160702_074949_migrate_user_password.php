<?php

class m160702_074949_migrate_user_password extends CDbMigration
{
	public function safeUp()
	{
		$sql = <<<SQL
			SELECT * FROM USERS
SQL;

		$command = Yii::app()->db->createCommand($sql);
		$users = $command->queryAll();

		foreach($users as $user) {
			$u1 = $user['u1'];

			$salt = openssl_random_pseudo_bytes(12);
			$hex   = bin2hex($salt);
			//$salt = '$2a$%13$' .$hex;
			$salt = '$1$' .$hex;

			$u3 = crypt($user['u3'],$salt);

			$sql = <<<SQL
            update USERS set u3='{$u3}', u9='{$salt}' WHERE u1={$u1}
SQL;
			$command = Yii::app()->db->createCommand($sql);
			$command->execute();
		}
	}

	public function safeDown()
	{
		echo "m160702_074949_migrate_user_password does not support migration down.\\n";
		return false;
	}
}