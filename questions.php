<?php require_once "inc/header.php";
if(!$user)
{
    Helper::redirect('index.php');
}

 if(isset($_GET['delete']))
{
     $slug =$_GET['question_slug'];
     $delflag = Question::delete($slug);
    
}
if(isset($_GET['exam_slug']))
{
   
    
        $user = User::auth();
            $slug = $_GET['exam_slug'];
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
            <div class="row align-items-center bg-white pt-3 pb-2 my-2">
                  
                  <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                      <h4 class="page-title">Exam Name - <?= $exam->title; ?></h4>
                      <h4 class="page-title">Lunch Date - <?= $exam->lunch_date; ?></h4>
                  </div>
                 
                  <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                      <h4 class="page-title">Instructor Name - <?= DB::table('users')->where('id',$exam->ins_id)->getOne()->username; ?></h4>
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
                        <?php if(isset($delflag) && $delflag == "success"): ?>
                                <div class="alert alert-success">Question delete successfully</div>
                                   
                        <?php   elseif(isset($delflag) && $delflag == false): ?>
                                <div class="alert alert-danger">Please Try again</div>
                        <?php endif; ?>
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="" method="POST">
                                  <?php  $counter = 1;
                                  if($question):
                                            foreach($question as $q): ?>
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <label for="">Question N0 - <?= $counter++; ?></label>
                                            <label for="">Question Mark - <?= $q->mark; ?></label>
                                            
                                        </div>
                                    </div>        
                                    <!-- question -->
                                    <div class="form-group">
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?= $q->question; ?>"
                                                class="form-control p-0 border-0" name="question[]" style="font-size: 20px;"
                                                id="question" disabled>
                                        </div>
                                    </div>
                                        <!-- answer -->
                                        <?php
                                        $ans_count = "A";
                                        $answer = DB::table('answers')->where('question_id',$q->id)->getAll();
                                       
                                        foreach($answer as $a):?>
                                        <div class="form-group">
                                            <div class="col-md-12 border-bottom p-0">
                                                <div class="row">
                                                    <div class="col-sm-3 p-0">
                                                    <p for="answer">Choice <?= $ans_count++ ?> | </p>
                                                    </div>
                                                    
                                                    
                                                    <div class="col-sm-8 p-0">
                                                    <input  type="text" class="form-control border-0" name="<?= $a->id ?>" value="<?= $a->answer ?>" style="font-size: 16px; padding-left:15px" disabled>
                                                    </div>
                                                    <div class="col-sm-1  p-0">
                                                    <?php $checked = ($a->isAnswer)? "checked" : ""; ?>
                                                    <input type="checkbox" class="" name=""  value="" <?= $checked ?> >
                                                    
                                                    </div>
                                                
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <?php endforeach ?>
                                       
                                   

                                    <?php if($courseTeacher): ?>
                                    <div class="form-group mb-4">
                                    
                                        <div class="col-sm-12">
                                       
                                           <a href="edit-question.php?exam_slug=<?= $exam->slug ?>&slug=<?= $q->slug ?>" class="btn btn-secondary">Update</a>
                                           <a href="questions.php?exam_slug=<?= $exam->slug ?>&question_slug=<?= $q->slug ?>&delete=true" class="btn btn-outline-danger" >Delete</a>
                                            
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                     <hr style="border: 1px dashed red;">


                                    <?php endforeach; endif; ?>
                                    <!-- <hr style="border: 1px dashed black;"> -->
                                   <a href="exams.php" class="btn btn-dark">Back</a>
                                  
                                  
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <?php else: ?>
                    <div class="alert alert-danger">No Questions exist!</div>
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