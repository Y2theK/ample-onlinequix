<?php require_once "inc/header.php";
if(!$user)
{
    Helper::redirect('index.php');
}

$user = User::auth();
$ins_course = Course::ofThisTeacher($user->id);
$stu_course = Course::ofThisStudent($user->id);

if(isset($_GET['delete']))
{
    
    $slug = $_GET['slug'];
   $flag = Exam::delete($slug);
  

    
}
?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="min-height: 250px;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Manage Exam</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="index.php" class="fw-normal">Dashboard</a></li>
                            </ol>
                            <a href="index.php" target="_blank"
                                class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Upgrade
                                to Pro</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
               
              
                <!-- ============================================================== -->
                <!-- Instructor COURSE -->
                <!-- ============================================================== -->
                <?php if($courseTeacher): ?>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Exam Lists as Teacher</h3>
                                <?php if(isset($flag) && $flag == "success"): ?>
                                    <div class="alert alert-success">Exam DELETE successed!</div>
                               
                                <?php   elseif(isset($flag) and is_array($flag)): ?>
                                    <div class="alert alert-danger"><?php print_r(array_values($flag))?></div>
                                 <?php endif; ?>
                                <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                               
                                    <select class="form-select shadow-none row border-top">
                                    <?php if(empty($ins_course)): ?>
                                             <option value="">No Course</option>
                                    <?php else:
                                          foreach($ins_course as $c):
                                            ?>
                                        <option value=""><?= $c->name ?></option>
                                    <?php endforeach; 
                                    endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap text-center">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Course</th>
                                            <th class="border-top-0">Questioner</th>
                                            <th class="border-top-0">Exam Topic</th>
                                            <th class="border-top-0">Total Questions</th>
                                            <th class="border-top-0">Marks</th>
                                            <th class="border-top-0">Time Limit</th>
                                            <th class="border-top-0">Actions to Exams</th>
                                            <th class="border-top-0">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  $count = 1;
                                        if(($ins_course)):
                                            foreach($ins_course as $c):
                                                $course_name = $c->name;
                                                $course_exam = Exam::ofCourse($c->id);
                                                foreach($course_exam as $ex):
                                                   
                                                    
                                                     ?>
                                                                        
                                                        <tr>
                                                                <td><?= $count++;  ?></td>
                                                                <td class="txt-oflo"><?= $course_name ?></td>
                                                                <td class="txt-oflo"><?= DB::table('users')->where('id',$ex->ins_id)->getOne()->username; ?></td>
                                                                <td class="txt-oflo"><?= $ex->title ?></td>
                                                                <td class="txt-oflo"><?= Exam::getTotalQuestions($ex->id) ?></td>
                                                                <td class="txt-oflo"><?= Exam::getTotalMark($ex->id) ?></td>
                                                                <td><span class="text-danger"><?= $ex->time_limit ?></span></td>
                                                                <td>
                                                                    <a href="add-questions.php?slug=<?= $ex->slug ?>" class="text-primary btn">Add Q <i class="fas fa-plus-circle"></i></a>
                                                                    <a href="questions.php?exam_slug=<?= $ex->slug ?>" class="text-dark btn">Review Q <i class="fas fa-cubes"></i></a>
                                                                   
                                                                </td>
                                                                <td>
                                                                <a href="edit-exam.php?slug=<?= $ex->slug ?>" class="btn"><i class="fas fa-edit text-info"></i></a>
                                                                <a href="exams.php?slug=<?= $ex->slug ?>&delete=true" class="btn"><i class="fas fa-trash text-danger"></i></a>
                                                                </td>
                                                        </tr>
                                                <?php endforeach;
                                               
                                               
                                            endforeach;    
                                        endif; 

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                 <!-- Instructor COURSE -->
               
                 <!-- ============================================================== -->
                <!-- Student COURSE -->
                <!-- ============================================================== -->
                <?php if($courseStudent): ?>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Exam Lists</h3>
                                <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                               
                                    <select class="form-select shadow-none row border-top">
                                    <?php if(empty($stu_course)): ?>
                                             <option value="">No Course</option>
                                    <?php else:
                                          foreach($stu_course as $c): ?>
                                        <option value=""><?= $c->name ?></option>
                                    <?php endforeach; 
                                    endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap text-center">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Course</th>
                                            <th class="border-top-0">Questioner</th>
                                            <th class="border-top-0">Exam Topic</th>
                                            <th class="border-top-0">Total Questions</th>
                                            <th class="border-top-0">Marks</th>
                                            <th class="border-top-0">Time Limit</th>
                                            <th class="border-top-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php $count = 1;
                                      if(($stu_course)):
                                            foreach($stu_course as $c):
                                                $course_name = $c->name;
                                                $course_exam = Exam::ofCourse($c->id);
                                                foreach($course_exam as $ex):
                                                    
                                                    
                                                     ?>
                                                                        
                                                        <tr>
                                                                <td><?= $count++; ?></td>
                                                            
                                                                <td class="txt-oflo"><?= $course_name ?></td>
                                                                <td class="txt-oflo"><?= DB::table('users')->where('id',$ex->ins_id)->getOne()->username; ?></td>
                                                                <td class="txt-oflo"><?= $ex->title ?></td>
                                                                <td class="txt-oflo"><?= $total_question = Exam::getTotalQuestions($ex->id); ?></td>
                                                                <td class="txt-oflo"><?= Exam::getTotalMark($ex->id) ?></td>
                                                                <td><span class="text-danger"><?= $ex->time_limit ?></span></td>
                                                                <td>
                                                                    <?php if($ex->lunch_date <= date('Y-m-d')):
                                                                            $stu_exam = DB::table('students_exams')->where('exam_id',$ex->id)->andWhere('student_id',$user->id)->getOne();
                                                                            if(!$stu_exam):
                                                                    ?>
                                                                    <a href="answer-exam.php?slug=<?= $ex->slug ?>" class="text-primary btn">Answer <i class="fas fa-cubes"></i></a>
                                                                            <?php else: ?>
                                                                        <a href="answer-exam.php?slug=<?= $ex->slug ?>" class="text-success btn">Review <i class="fas fa-bolt"></i></a>
                                                                            <?php endif; ?>
                                                                        <?php else: ?>
                                                                    <a href="exams.php" class="text-dark btn btn-warning">Exam At <?= $ex->lunch_date ?> <i class="far fa-meh"></i></a>
                                                                    <?php endif; ?>
                                                                    
                                                                
                                                                </td>
                                                        </tr>
                                                <?php endforeach;
                                               
                                               
                                            endforeach;    
                                        endif; 

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <!-- ============================================================== -->
                <!-- Student COURSE -->
                <!-- ============================================================== -->
              

                <!-- ============================================================== -->
                <!-- Student COURSE -->
                <!-- ============================================================== -->
                <?php if(!$courseStudent && !$courseTeacher): ?>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box bg-white">
                           <h4 class="text-center text-primary ">You have No Enrolled Course ! Try enrolled One !</h4>
                            
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <!-- ============================================================== -->
                <!-- Student COURSE -->
                <!-- ============================================================== -->
               
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2021 © Ample Admin brought to you by <a
                    href="https://www.wrappixel.com/">wrappixel.com</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
<?php require_once "inc/footer.php" ?>