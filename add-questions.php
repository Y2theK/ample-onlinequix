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
if(($_POST))
{
    if($exam)
    {
        $flag = Question::Create($_POST,$exam->id);
        // print_r($_POST);
       
    }
    
}
   
   
}else{
    Helper::redirect('404.php');
}

$question_count = DB::table('questions')->where('exam_id',$exam->id)->count();
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
                        <h4 class="page-title">Make Questions</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                            <li><a href="index.php" class="fw-normal">Dashboard /</a></li>
                                
                                <li><a href="exams.php" class="fw-normal"> / Exams /</a></li>
                                <li><a href="questions.php?exam_slug=<?= $_GET['slug'] ?>" class="fw-normal"> / Questions</a></li>
                               
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
                <!-- Row -->
                <div class="row align-items-center bg-white pt-3 pb-2 my-2">
                  
                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                        <h4 class="page-title">Exam Name - <?= $exam->title; ?></h4>
                    </div>
                   
                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                        <h4 class="page-title">Instructor Name - <?= DB::table('users')->where('id',$exam->ins_id)->getOne()->username; ?></h4>
                    </div>
                    
                </div>
                
                <div class="row ">
                   
                 
                  
                     <!-- Column -->
                     <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="" method="POST">
                                
                                <?php if(isset($flag) && $flag == "success"): ?>
                                    <div class="alert alert-success">
                                    Question <?= $question_count ?> created successfully
                                    </div>
                                    <?php //Helper::redirect('index.php') ?>
                                <?php   elseif(isset($flag) and is_array($flag)): ?>
                                    <div class="alert alert-danger"><?php print_r(array_values($flag))?></div>
                                 <?php endif; ?>
                                 <h4 class="text-danger"><?= "Question Number - ".$question_count+1; ?></h4>
                                    <div class="form-group">
                                        <label class="col-md-12 p-0" for="question">Question : </label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="What does PHP stand for?"
                                                class="form-control p-0 border-0" name="question" id="question"> </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="choiceA" class="col-sm-12 p-0">Option A : </label>
                                       <div class="col-sm-12 border-bottom p-0">
                                           <input type="text" placeholder="Personal Home Page"
                                               class="form-control p-0 border-0" name="choiceA"
                                               id="choiceA">
                                       </div>
                                    </div>
                                     <div class="form-group col-sm-12">
                                        <label for="choiceB" class="col-sm-12 p-0">Option B :</label>
                                       <div class="col-sm-12 border-bottom p-0">
                                           <input type="text" placeholder="Personal Home Page"
                                               class="form-control p-0 border-0" name="choiceB"
                                               id="choiceB">
                                       </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="choiceC" class="col-sm-12 p-0">Option C : </label>
                                       <div class="col-sm-12 border-bottom p-0">
                                           <input type="text" placeholder="Personal Home Page"
                                               class="form-control p-0 border-0" name="choiceC"
                                               id="choiceC">
                                       </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="choiceD" class="col-sm-12 p-0">Option D :</label>
                                       <div class="col-sm-12 border-bottom p-0">
                                           <input type="text" placeholder="Personal Home Page"
                                               class="form-control p-0 border-0" name="choiceD"
                                               id="choiceD">
                                       </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="choiceE" class="col-sm-12 p-0">Option E : </label>
                                       <div class="col-sm-12 border-bottom p-0">
                                           <input type="text" placeholder="Personal Home Page"
                                               class="form-control p-0 border-0" name="choiceE"
                                               id="choiceE">
                                       </div>
                                    </div>
                                    
                                    <label for="" class="col-sm-12 p-0">Choose the right one : </label>
                                    <div class="row">
                                        <div class="form-group col-sm-1">
                                        <div class="col-md-12 border-bottom p-0">
                                            <label for="isAnwerA">Option A</label>
                                             <input type="checkbox" class="form" name="isAnswerA" id="isAnswerA" >
                                        </div>
                                        </div>
                                        <div class="form-group col-sm-1">
                                        <div class="col-md-12 border-bottom p-0">
                                            <label for="isAnwerB">Option B</label>
                                             <input type="checkbox" class="form" name="isAnswerB" id="isAnswerB">
                                        </div>
                                        </div>
                                        <div class="form-group col-sm-1">
                                        <div class="col-md-12 border-bottom p-0">
                                            <label for="isAnwerC">Option C</label>
                                             <input type="checkbox" class="form" name="isAnswerC" id="isAnswerC">
                                        </div>
                                        </div>
                                        <div class="form-group mb-4 col-sm-1">
                                        <div class="col-md-12 border-bottom p-0">
                                            <label for="isAnwerD">Option D</label>
                                             <input type="checkbox" class="form" name="isAnswerD" id="isAnswerD">
                                        </div>
                                        </div>
                                        <div class="form-group col-sm-1">
                                        <div class="col-md-12 border-bottom p-0">
                                            <label for="isAnwerE">Option E</label>
                                             <input type="checkbox" class="form" name="isAnswerE" id="isAnswerE">
                                        </div>
                                        </div>
                                   </div>
                                   <div class="form-group">
                                        <label for="mark" class="col-md-12 p-0">Mark</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number" value="1"
                                                class="form-control p-0 border-0" name="mark"
                                                id="mark">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <input type="reset" class="btn btn-outline-success" value="Cancel">
                                            <input type="submit" class="btn btn-success" value="Next">
                                            <a href="exams.php" class="btn btn-danger">End</a>
                                            
                                            
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
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