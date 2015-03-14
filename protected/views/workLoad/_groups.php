<?php
/**
 * @var Gr $models[]
 */

      foreach ($models as $model) :

          $course = Gr::model()->getCourseFor($model->gr1, $year, $sem);
          $name   = Gr::model()->getGroupName($course, $model);
          $students = St::model()->getStudentsOfNr($nr, $year, $sem);
		 
?>
    <div class="group-box">
        <div class="group-title"><?=$name?></div>
        <div class="group-students">
            <ul>
               <?php foreach($students as $student): ?>
                   <li><?php echo $student['stud'];?></li>
               <?php endforeach ?>
            <ul>
        </div>
    </div>
<?php endforeach ?>