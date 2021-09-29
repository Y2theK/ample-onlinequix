<?php require_once "inc/header.php";
if(!$user)
{
    Helper::redirect('index.php');
}

$user = User::auth();
$ins_course = Course::ofThisTeacher($user->id);
$stu_course = Course::ofThisStudent($user->id);
$stu_exam = User::getExamsOfUser($user->id);
// print_r($stu_exam);

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
                        <h4 class="page-title">Exam Results</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="index.php" class="fw-normal">Dashboard /</a></li>
                                
                                <li><a href="exams.php" class="fw-normal"> / Exams</a></li>
                               
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
                <!-- Student exam view-->
                <!-- ============================================================== -->
                <div class="row">
                <?php if($stu_course): ?>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Exam Lists</h3>
                                <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                               
                                    <select class="form-select shadow-none row border-top">
                                    <?php if(empty($stu_course)): ?>
                                             <option value="">No Exam submmited</option>
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
                                            <th class="border-top-0">Your Marks</th>
                                            <th class="border-top-0">Total Marks</th>
                                            
                                            <th class="border-top-0">Time Limit</th>
                                            <th class="border-top-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if($stu_exam):
                                    $count = 1;
                                    
                                    foreach($stu_exam as $ex):
                                         $ex = Exam::getCourse($ex->exam_id);      
                                         $s_ex = DB::table('students_exams')->where('exam_id',$ex->id)->andWhere('student_id',$user->id)->getOne();
                                         if($s_ex):  
                                                    
                                                    ?>
                                                                       
                                                       <tr>
                                                               <td><?= $count++; ?></td>
                                                           
                                                               <td class="txt-oflo"><?= $ex->course_name ?></td>
                                                               <td class="txt-oflo"><?= DB::table('users')->where('id',$ex->ins_id)->getOne()->username; ?></td>
                                                               <td class="txt-oflo"><?= $ex->title ?></td>
                                                               <td class="txt-oflo"><?= $total_question = Exam::getTotalQuestions($ex->id); ?></td>
                                                               <td class="txt-oflo text-danger"><?= Exam::getYourMark($ex->id,$user->id) ?></td>
                                                               <td class="txt-oflo"><?= Exam::getTotalMark($ex->id) ?></td>
                                                               
                                                               <td class="txt-oflo"><?= $ex->time_limit ?></td>
                                                               <td>
                                                                  
                                                                       <a href="answer-exam.php?slug=<?= $ex->slug ?>" class="text-success btn">Review <i class="fas fa-bolt"></i></a>
                                                                           <?php endif; ?>
                                                                      
                                                                   
                                                               
                                                               </td>
                                                       </tr>
                                               <?php endforeach; endif;?>
                                   
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="alert alert-danger text-center">No answered Exam! Try Enrolled One...</div>
                <?php endif; ?>

                </div>
                <!-- ============================================================== -->
                <!-- student exam -->
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