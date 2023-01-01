<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\User;
use backend\models\Request;



/** @var yii\web\View $this */

$this->title = 'Home';
?>
<div class="site-index">
    <div class="body-content">
                         <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= Url::to(['/site/index'])  ?>">Home</a></li>
                            </ol>
                            </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <?php
                        if (Yii::$app->user->identity->role == 'coach') {
                            
                        echo $this->render('teacher',['ass_count'=>$ass_count,'teacher_ass'=>$teacher_ass,'attendance' => $attendance]);

                        ?>

                        <?php
                        }
                        elseif (Yii::$app->user->identity->role == 'teampreneur' || Yii::$app->user->identity->role == 'team_leader' || Yii::$app->user->identity->role == 'project_leader') {
                            
                        echo $this->render('student',['assignments' => $assignments , 'students'=>$students , 'timetables'=>$timetables , 'student_book_list' => $student_book_list]);
                            
                        }
                        else{
                        ?>
                        <?= $this->render('admin',['ass_count'=>$ass_count])  ?>
                        <?php
                        }
                        ?>
    </div>
</div>
