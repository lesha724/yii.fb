<?php

Yii::import('system.cli.commands.MigrateCommand');
 
class ChMigrateCommand extends MigrateCommand
{
    public function run($args)
    {
        tt('123');
        parent::run($args);
 
        $this->flushCache();
    }
 
    public function flushCache()
    {
        $db = $this->getDbConnection();
 
        if ($db->schemaCachingDuration > 0) {
            $cacher = Yii::app()->getComponent($db->schemaCacheID);
            if ($cacher)
                $cacher->flush();
        }
    }
}
