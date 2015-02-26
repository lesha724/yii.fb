<?php
/**
 * @var Gr $models[]
 */


      foreach ($models as $model) :

          $course = Gr::model()->getCourseFor($model->gr1, $year, $sem);
          $name   = Gr::model()->getGroupName($course, $model);
          $students = array();
?>
    <div class="group-box">
        <div class="group-title"><?=$name?></div>
        <div class="group-students">
            <ul>
               <?php foreach($students as $student): ?>
                   <li></li>
               <?php endforeach ?>
            <ul>
        </div>
    </div>
<?php endforeach ?>