<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\User;
use backend\models\Tasks;
use backend\models\Course;
use backend\models\Student;
use backend\models\BookList;
use backend\models\Assignment;
use backend\models\Programme;
use backend\models\StudentCourse;

?>
<div class="container-xxl p-0">
    <div class="row">
        <div class="row">
            <div class="card text-center">
                <div class="card-body">
                    <div class="text-start mt-3">
                        <div id="student-profile-1">
                            <h4 class="mb-0 mt-2">STUDENT INFO</h4>
                            <hr>

                            <?php
                            $model = new Student();
                            $info = User::findOne(Yii::$app->user->identity->id);
                            $student_info = Student::findOne(['student_id'=>Yii::$app->user->identity->id]);
                            if (!$student_info) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Student Info unavailable - </strong> Please register on the "REGISTER" tab
                                below!
                            </div>
                            <?php
                            }else{
                            ?>
                            <div class="col">

                                <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span
                                        class="ms-2"><?= Html::encode(User::getUsername(Yii::$app->user->identity->id))  ?></span>
                                </p>

                                <p class="text-muted mb-2 font-13"><strong>Programme :</strong><span
                                        class="ms-2"><?= Html::encode($student_info->programme0->program_name)  ?></span>
                                </p>

                                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span
                                        class="ms-2 "><?= Html::encode($info->email)  ?></span></p>

                                <p class="text-muted mb-1 font-13"><strong>Phone :</strong> <span
                                        class="ms-2"><?= Html::encode($info->phone)  ?></span></p>
                            </div>

                            <?php
                                                    }
                                                    ?>

                        </div>
                        <div id="student-profile">

                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->

        </div> <!-- end col-->

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                        <li class="nav-item">
                            <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false"
                                class="nav-link rounded-0 active">
                                Works
                            </a>
                        </li>
                        <?php
                                            if (Yii::$app->user->identity->role == 'team_leader') {

                                            ?>

                        <li class="nav-item">
                            <a href="#attendance" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Attendance
                            </a>
                        </li>
                        <?php

                                            }
                                            
                                            ?>
                        <li class="nav-item">
                            <a href="#register" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Register
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#timetables" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Timetables
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#book-list" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Books
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#projects" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            Projects
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="aboutme">
                            <div class="row">
                                <!-- // display success message -->
                                <?php if (Yii::$app->session->hasFlash('success')) : ?>
                                <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show mt-2"
                                    role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <strong><i class='mdi mdi-check-all'></i> </strong>
                                    <?= Yii::$app->session->getFlash('success') ?>
                                </div>
                                <?php endif; ?>
                                <div class="col-md-6">
                                    <h5 class="text-uppercase"><i class="mdi mdi-clock-outline me-1 text-warning"></i>
                                        Recent Submitted works</h5>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?=  Url::to(['/assignment/create']) ?>"
                                        class="btn btn-sm btn-primary float-end mb-0"><i
                                            class="mdi mdi-plus-circle-outline me-1"></i> Submit</a>
                                </div>
                            </div>

                            <hr>

                            <div class="timeline-alt pb-0">
                                <?php
                                    foreach ($assignments as $assignment) {
                                ?>
                                <div class="timeline-item">
                                    <i class="mdi mdi-circle bg-info-lighten text-info timeline-icon"></i>
                                    <div class="timeline-item-info">
                                        <h5 class="mt-0 mb-1"><?= Html::encode($assignment->assCat->cat_name) ?></h5>
                                        <p class="font-14">
                                            <?=

                                            ($assignment->status == 1) ? '<span class="text-success">Received</span>' : '<span class="text-danger">Pending</span>';

                                            ?>
                                            <span class="ms-2 font-12">Submitted:
                                                <?= Html::encode(Assignment::getDate($assignment->sub_date)) ?></span>
                                        </p>

                                        <div class="card mb-2 shadow-none border">
                                            <div class="p-1">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <div class="avatar-sm">
                                                            <?php
                                                                                // $path = '\uploads' . $assignment->assignmen;
                                                                                $filepath = '../../uploads/' . $assignment->assignment;

                                                                                $extension = pathinfo($filepath, PATHINFO_EXTENSION);
                                                                                ?>
                                                            <span class="avatar-title rounded bg-primary">
                                                                .<?= Html::encode(strtoupper($extension)) ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col ps-0">
                                                        <a href="javascript:void(0);"
                                                            class="text-muted fw-bold"><?= Html::encode(substr($assignment->assignment, 0, 17). " ... ") ?></a>
                                                        <!-- <p class="mb-0">2.3 MB</p> -->
                                                    </div>
                                                    <div class="col-auto" id="tooltip-container9">
                                                        <!-- Button -->
                                                        <a href="<?= Url::to(['assignment/download','id'=>$assignment->id]) ?>"
                                                            data-bs-container="#tooltip-container9"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Download" class="btn btn-link text-muted btn-lg p-0">
                                                            <i class='uil uil-cloud-download'></i>
                                                        </a>

                                                        <?= Html::a('<i class="uil uil-multiply text-danger ml-1"></i>', ['/assignment/delete','class' => 'action-icon' ,'id' =>  $assignment->id], [
                                                                                'data' => [
                                                                                    'confirm' => 'Are you sure you want to delete this assignment?',
                                                                                    'method' => 'post',
                                                                                ],
                                                        ]) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php
                                }
                                ?>

                            </div>
                            <!-- end timeline -->

                        </div> <!-- end tab-pane -->
                        <div class="tab-pane student-course" id="register">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="text-uppercase"><i class="mdi mdi-account-group me-1 text-warning"></i>
                                        Register Program & Courses</h5>
                                </div>
                                <div class="col-md-4">

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div class="course_registration_div">
                                        <?php
                                        if (!$student_info) {
                                            # code...
                                        echo $this->render('/student/create',['model'=>$model]);

                                        }
                                        ?>
                                        <br>
                                        <?php
                                        $is_student_course = StudentCourse::findOne(['student_id' => Yii::$app->user->identity->id]);
                                        if (!$is_student_course) {
                                         ?>
                                         
                                        <label for="">Select courses</label>
                                        <hr>
                                        <input type="hidden" value="<?= Html::encode(Yii::$app->user->identity->id) ?>" id="register-course-student-id">
                                        <?php
                                        $courses = Course::find()->all();
                                        foreach ($courses as $course) {
                                        ?>

                                        <div class="form-check form-check-inline mb-2">
                                            <input type="checkbox" class="form-check-input" id="register_own_course_id"
                                                value="<?= Html::encode($course->id) ?>">
                                            <label class="form-check-label"
                                                for="customCheck3"><?= Html::encode($course->course_name) ?></label>
                                        </div>

                                        <?php
                                        }
                                        ?>
                                        <button class="btn btn-sm btn-primary mt-5 float-end" id="course-registration-submit-btn">Submit Courses</button>

                                         <?php
                                        }
                                        ?>
                                       <?php
                                       if ($student_info && $is_student_course) {
                                      ?>
                                      <div class="alert alert-success" role="alert">
                                       Already registered, for any changes please contact the Admin.
                                      </div>
                                      <?php
                                       }
                                       ?>
                                  </div>
                                    <div class="row mt-3">
                                        <h4 class="text-center mb-2"><strong class="course_registration_loading-gif"
                                                style="display: none;">Submiting courses...</strong></h4>
                                        <div class="d-flex justify-content-center">
                                            <div class="spinner-border text-success course_registration_loading-gif-spin"
                                                role="status" style="display: none;"></div>
                                        </div>
                                    </div>

                                    <div class="row course_registration_success-msg" style="display: none;">
                                        <div class="col">
                                            <div class="text-center">
                                                <h2 class="mt-0"><i class="mdi mdi-check-all text-success"></i></h2>
                                                <h3 class="mt-0 text-primary">Thank you !</h3>

                                                <p class="">Courses registered sucessful.</p>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane" id="attendance">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="text-uppercase"><i class="mdi mdi-account-group me-1 text-primary"></i>
                                        Class attendance</h5>
                                </div>
                                <div class="col-md-4">
                                    <!-- <button type="submit" class="btn btn-success btn-sm float-end" id="attendance-view-btn"><i class="mdi mdi-eye-outline"></i> View attendance</button> -->
                                </div>
                            </div>
                            <hr>
                            <div class="attendance-div" style="display: inline;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="task" class="form-label">Programme</label>
                                            <select class="form-control select2" data-toggle="select2"
                                                id="attendance_program">
                                                <option>Select</option>
                                                <?php
                                                foreach (Programme::find()->all() as $programme) {
                                                ?>
                                                <option value="<?=  Html::encode($programme->id) ?>">
                                                    <?= Html::encode($programme->program_name).'('.Html::encode($programme->yos) .')' ?>
                                                </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="task" class="form-label">Course</label>
                                            <select class="form-control select2" data-toggle="select2"
                                                id="attendance_course">
                                                <option>Select</option>
                                                <?php
                                                foreach (Course::find()->all() as $course) {
                                                ?>
                                                <option value="<?=  Html::encode($course->id) ?>">
                                                    <?= Html::encode($course->course_name) ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="task" class="form-label">Teacher</label>
                                            <select class="form-control select2" data-toggle="select2"
                                                id="attendance_teacher">
                                                <option>Select</option>
                                                <?php
                                                foreach (User::find()->where(['role'=>'coach'])->all() as $teacher) {
                                                ?>
                                                <option value="<?=  Html::encode($teacher->id) ?>">
                                                    <?= Html::encode(User::getUsername($teacher->id)) ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                                <div class="row">
                                    <label for="task" class="form-label">Student List</label>
                                    <div class="col-md-12" style="flex:content" id="attendance_list">




                                    </div>
                                </div>


                                <div class="text-end">
                                    <button type="submit" class="btn btn-success mt-2 btn-sm" id="attendance_submit"><i class="mdi mdi-content-save"></i> Submit</button>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row">
                                <div class="attendance-table" style="display: none;">

                                </div>
                            </div>
                            <div class="row mt-3">
                                <h4 class="text-center mb-2"><strong class="loading-gif" style="display: none;">Submiting attendance...</strong></h4>
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border text-success loading-gif-spin" role="status" style="display: none;"></div>
                                </div>
                            </div>

                            <div class="row success-msg" style="display: none;">
                                <div class="col">
                                    <div class="text-center">
                                        <h2 class="mt-0"><i class="mdi mdi-check-all text-success"></i></h2>
                                        <h3 class="mt-0 text-primary">Thank you !</h3>

                                        <p class="">Attendance sent sucessful.</p>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div>
                        <!-- end settings content-->

                        <div class="tab-pane student-course" id="timetables">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="text-uppercase"><i class="mdi mdi-calendar-month-outline me-1 text-danger"></i> Timetables</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="timeline-alt pb-0">
                                    <?php
                                    foreach ($timetables as $timetable) {
                                    ?>
                                    <div class="timeline-item">
                                        <i class="mdi mdi-circle bg-info-lighten text-info timeline-icon"></i>
                                        <div class="timeline-item-info">
                                            <h5 class="mt-0 mb-1"><?= Html::encode($timetable->tittle) ?></h5>
                                            <p></p>
                                            <div class="card mb-2 shadow-none border">
                                                <div class="p-1">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar-sm">
                                                                <?php
                                                                                // $path = '\uploads' . $timetable->assignmen;
                                                                                $filepath = '../../uploads/timetables/' . $timetable->timetable;

                                                                                $extension = pathinfo($filepath, PATHINFO_EXTENSION);
                                                                                ?>
                                                                <span class="avatar-title rounded bg-primary">
                                                                    .<?= Html::encode(strtoupper($extension)) ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col ps-0">
                                                            <a href="javascript:void(0);"
                                                                class="text-muted fw-bold"><?= Html::encode($timetable->tittle) ?></a>
                                                        </div>
                                                        <div class="col-auto" id="tooltip-container9">
                                                            <!-- Button -->
                                                            <a href="<?= Url::to(['timetable/download','id'=>$timetable->id]) ?>"
                                                                data-bs-container="#tooltip-container9"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Download"
                                                                class="btn btn-link text-muted btn-lg p-0">
                                                                <i class='uil uil-cloud-download'></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>

                                </div>
                                <!-- end timeline -->
                            </div>
                        </div>


                        <div class="tab-pane" id="book-list">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="text-uppercase"><i class="mdi mdi-book-open-page-variant me-1 text-primary"></i> Book List</h5>
                                </div>
                                <div class="col-md-4">
                                    <button id="show-add-book-list-form" class="btn btn-success btn-sm float-end"><i class="mdi mdi-plus-circle-outline me-1"></i> Add Book</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div id="book-list-show-form">
                                    <?php
                                        $book_list_model = new BookList();
                                        echo $this->render('/book-list/create',['book_list_model'=>$book_list_model]);   
                                    ?>
                                    </div>
                                    <div id="book-list-table-view">
                                    <table class="table table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Book Name</th>
                                                <th>Author</th>
                                                <th>Coach</th>
                                                <th>Status</th>
                                                <th>Complete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($student_book_list as $book) {
                                            ?>
                                            <tr>
                                                <td><?= Html::encode($book->book_title)  ?></td>
                                                <td><?= Html::encode($book->book_author)  ?></td>
                                                <td><?= Html::encode(User::getUsername($book->coach))  ?></td>
                                                <td><?= Html::encode($book->status) ? '<span class="badge bg-success">Complete</span>' : '<span class="badge bg-warning">On progress</span>'  ?></td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input reading-book-id" value="<?= Html::encode($book->id)  ?>" id="customCheck1" <?= Html::encode($book->status) ? 'checked' : '' ?>>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                    }
                                    ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <!-- end timeline -->
                            </div>
                        </div>


                        <div class="tab-pane" id="projects">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="text-uppercase"><i
                                            class="mdi mdi-calendar-month-outline me-1 text-danger"></i> Projects
                                    </h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                        <a href="<?= Url::to(['/project/index']) ?>" class="btn text-muted d-none d-sm-inline-block btn-link fw-semibold">
                                        <i class="mdi mdi-arrow-right"></i> Go to projects page </a>
                                </div>
                                <!-- end timeline -->
                            </div>
                        </div>

                    </div> <!-- end tab-content -->

                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row-->


</div>