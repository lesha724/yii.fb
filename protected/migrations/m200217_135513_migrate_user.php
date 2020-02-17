<?php

class m200217_135513_migrate_user extends CDbMigration
{
    /**
     * @return bool|void
     * @throws CException
     * @throws Exception
     */
	public function up()
	{
	    if(Yii::app()->core->universityCode != U_PM)
	        return;

	    $stType = Users::ST1;
        $pType = Users::P1;

	    $transaction = Yii::app()->db->beginTransaction();
	    try {
            $sql = <<<SQL
            SELECT st1 as id, st105 as u2, st106 as u3, st107 as u4, {$stType} as u5
                FROM st
                INNER JOIN STD ON (ST.ST1 = STD.STD2)
                WHERE st105 <> '' and st106 <> '' and std7 is null and std11 in (0,5,6,8) and std24=0
            union 
            SELECT p1 as id, p79 as u2,p80 as u3, p81 as u4, {$pType} as u5
                FROM p
                INNER JOIN PD ON (P1=PD2)
                WHERE p79 <> '' and p80 <> '' and PD28 in (0,2,5,9) and PD3=0 and PD13 IS NULL
SQL;
            $command = Yii::app()->db->createCommand($sql);

            foreach ($command->queryAll() as $us) {
                $user = Users::model()->findByAttributes([
                    'u5'=> intval($us['u5']),
                    'u6' => intval($us['id'])
                ]);
                if(empty($user)) {
                    $user = new Users();
                    $user->setAttributes([
                        'u1' => new CDbExpression('GEN_ID(GEN_USERS, 1)'),
                        'u5'=> intval($us['u5']),
                        'u6' => intval($us['id'])
                    ], false);
                }

                $user->setAttributes([
                    'u2' => $us['u2'],
                    'u3' => $us['u3'],
                    'u4' => $us['u4']
                ], false);

                $user->sendChangePasswordMail = false;

                if(!$user->save(false))
                    throw new Exception('Ошибка миграции пользователя '. $user->u2);
            }

            $transaction->commit();

        }catch (Exception $error){
	        $transaction->rollback();
	        throw $error;
        }
	}


	public function down()
	{
		echo "m200217_135513_migrate_user does not support migration down.\n";
		return false;
	}
}