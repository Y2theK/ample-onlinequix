<?php require_once "inc/header.php";
if(!$user)
{
    Helper::redirect('index.php');
}

if(isset($_GET['slug']))
{
    $user = User::auth();
    $slug = $_GET['slug'];
    $exam = DB::table('exams')->where('slug',$slug)->getOne();
    if(empty($exam))
    {
        
        Helper::redirect('404.php');
    }

    if($exam)
    {
      
      $question = Question::ofExam($exam->id);
    
       
    }
    

   
   
}else{
    Helper::redirect('404.php');
}

if($_POST && $question)
{
 $flag = Answer::added($_POST,$exam->id);
 
}
?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Question Room</h4>
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
            <div class="row align-items-center bg-white pt-3 pb-2 my-2 ">
                  
                  <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                      <h4 class="page-title">Exam Name - <?= $exam->title; ?></h4>
                     
                  </div>
                 
                  <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                      <h4 class="page-title">Instructor Name - <?= DB::table('users')->where('id',$exam->ins_id)->getOne()->username; ?></h4>
                      <p class="text-danger fixed-left" id="display">Time -</p>
                      <p class="text-danger fixed-left" id="time" hidden><?=  $exam->time_limit ?></p>
                  </div>
                  
              </div>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <?php if($question): ?>
                <!-- Row -->
                <div class="row ">
                    
                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 col-md-12 mx-auto">
                        <div class="card">
                            <div class="card-body">
                            <?php if(isset($flag) && $flag == "success"): ?>
                                    <div class="alert alert-success">Answers submitted successfully</div>
                                    <div><?php //Helper::redirect('index.php'); ?></div>
                                    
                                <?php   elseif(isset($flag) and is_array($flag)): ?>
                                    <div class="alert alert-danger"><?php print_r(array_values($flag))?></div>
                                 <?php endif; ?>
                                <form class="form-horizontal form-material" action="" method="POST" id="formAns">
                                  <?php  $counter = 1;
                                  if($question):
                                            foreach($question as $q): ?>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="" class="me-5">Question N0 - <?= $counter++; ?></label>
                                            <label for="" class="text-danger fw-bold mx-5">Mark - <?= $q->mark ?></label>
                                             
                                        </div>
                                    </div>        
                                    <!-- question -->
                                    <div class="form-group">
                                        <div class="col-md-12 border-bottom p-0">
                                        
                                            <input type="text" value="<?= $q->question; ?>"
                                                class="form-control p-0 border-0" name="" style="font-size: 18px;"
                                                id="question">
                                        </div>
                                    </div>
                                        <!-- answer -->
                                        <?php
                                        $ans_count = "A";
                                        $answer = DB::table('answers')->where('question_id',$q->id)->getAll();
                                       
                                        foreach($answer as $a):?>
                                        <div class="form-group" >
                                            <div class="col-md-12 border-bottom p-0">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                    <p for="answer">Choice <?= $ans_count++ ?> | </p>
                                                    </div>
                                                    <?php 
                                                    $stu_answer = DB::table('students_answers')->where('student_id',$user->id)->andWhere('answer_id',$a->id)->getOne();
                                                    $checked = $stu_answer ? "checked" : "";
                                                    
                                                    ?>
                                                    <div class="col-sm-1 ">
                                                    <input type="checkbox" class="" name="answer[]" value="<?= $a->id ?>" <?= $checked; ?>>
                                                    </div>
                                                    <div class="col-sm-8 "><?= $a->answer ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach ?>
                                    

                                        <hr style="border: 1px dashed black;">
                                    <?php endforeach; endif; ?>
                                    <?php if($courseStudent): ?>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                        <?php 
                                             $stu_exam = DB::table('students_exams')->where('exam_id',$exam->id)->andWhere('student_id',$user->id)->getOne();
                                            if(!$stu_exam): ?>
                                            <input type="submit" class="btn btn-success" value="Submit" id="submit">
                                            <input type="reset" class="btn btn-outline-success" value="Reset">
                                            <?php else: ?>
                                            <a href="exam-result.php" class="btn btn-dark">Back</a>
                                            <?php endif; ?>
                                            <hr style="border: 1px dashed black;">
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                   
                                  
                                  
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <?php else: ?>
                    <div class="alert alert-danger">No Questions exist !</div>
                <?php endif; ?>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
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
<script>
    var time = document.getElementById('time').innerText.split(':');
    var display = document.querySelector('#display');
    var formAns = document.getElementById('formAns');
    var btnSub = document.getElementById('submit');
   var h = time[0]; //hour
   var m = time[1]; //minute
   var s = time[2]; //second

   setInterval(() => {
       s -= 1;
       if(s == -1)
       {
           m -= 1;
           s = 59;
       }
       if(m == -1)
       {
           h -= 1;
           m = 59;
       }
       if(h == -1)
       {
        //    document.formAns.submit();
           window.location.href = "exams.php";
          
       }
       var sec = s < 10 ? "0"+s : s;
       var min = m < 10 ? "0"+m : m;
       var hour = h < 10 ? h : h;
       display.textContent = `${hour} : ${min} : ${sec}`;
   }, 1000);
</script>