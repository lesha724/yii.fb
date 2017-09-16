<?php

class m170916_084855_alter_grants8 extends CDbMigration
{
    public function safeUp()
    {
        $sql = <<<SQL
        alter table grants add grants8 smal;    /* доступ к нагрузуке 0 -нет 1 -да*/
SQL;
        $this->execute($sql);
    }

    public function safeDown()
    {
        echo "m141129_080805_grants6 does not support migration down.\\n";
        return false;
    }
}