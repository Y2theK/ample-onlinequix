<?php require_once "inc/header.php";
if(!$user)
{
    Helper::redirect('index.php');
}

if(isset($_GET['slug']))
{
    $user = User::auth();
    $slug = $_GET['slug'];
    $question = DB::table('questions')->where('slug',$slug)->getOne();
    if(empty($question))
    {
        Helper::redirect('404.php');
    }
    else if($question)
    {
      
       
        $question = Question::getExam($question->id);
        $answer = Question::getAnswer($question->id);
        // print_r($question);
        // print_r($answer);
    
    }
}else{
    Helper::redirect('404.php');
}
if(($_POST))
{
    $questionupd = Question::update($_POST,$question->id);
    // print_r($questionupd);
    // print_r($_POST);

   
    
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
                        <h4 class="page-title">Make Questions</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="index.php" class="fw-normal">Dashboard /</a></li>
                                
                                <li><a href="exams.php" class="fw-normal"> / Exams /</a></li>
                                <li><a href="questions.php?exam_slug=<?= $_GET['exam_slug'] ?>" class="fw-normal"> / Questions</a></li>
                               
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
                        <h4 class="page-title">Exam Name - <?= $question->exam_title; ?></h4>
                    </div>
                   
                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                        <h4 class="page-title">Instructor Name - <?= DB::table('users')->where('id',$question->ins_id)->getOne()->username; ?></h4>
                    </div>
                    
                </div>
                
                <div class="row ">
                   
                 
                  
                     <!-- Column -->
                     <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="" method="POST">
                                
                            <?php if(isset($questionupd) and is_array($questionupd)): ?>
                                <div class="alert alert-danger"><?php print_r($questionupd) ?></div>
                            <?php elseif(isset($questionupd) and !(is_array($questionupd))):  ?>
                                <div class="alert alert-success">update successfully</div>
                            <?php endif;   ?>
                                 
                                    <div class="form-group">
                                        <label class="col-md-12 p-0" for="question">Question : </label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?= $question->question ?>"
                                                class="form-control p-0 border-0" name="question" id="question"> </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="choiceA" class="col-sm-12 p-0">Option A : </label>
                                       <div class="col-sm-12 border-bottom p-0">
                                           <input type="text" value="<?= isset($answer[0]->answer) ? $answer[0]->answer : "" ?>"  placeholder="Add new Option"
                                               class="form-control p-0 border-0" name="choiceA"
                                               id="choiceA">
                                       </div>
                                    </div>
                                     <div class="form-group col-sm-12">
                                        <label for="choiceB" class="col-sm-12 p-0">Option B :</label>
                                       <div class="col-sm-12 border-bottom p-0">
                                           <input type="text" value="<?= isset($answer[1]->answer) ? $answer[1]->answer : "" ?>"  placeholder="Add new Option"
                                               class="form-control p-0 border-0" name="choiceB"
                                               id="choiceB">
                                       </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="choiceC" class="col-sm-12 p-0">Option C : </label>
                                       <div class="col-sm-12 border-bottom p-0">
                                           <input type="text" value="<?= isset($answer[2]->answer) ? $answer[2]->answer : "" ?>"  placeholder="Add new Option"
                                               class="form-control p-0 border-0" name="choiceC"
                                               id="choiceC">
                                       </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="choiceD" class="col-sm-12 p-0">Option D :</label>
                                       <div class="col-sm-12 border-bottom p-0">
                                           <input type="text" value="<?= isset($answer[3]->answer) ? $answer[3]->answer : "" ?>"
                                               class="form-control p-0 border-0" name="choiceD" placeholder="Add new Option"
                                               id="choiceD">
                                       </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="choiceE" class="col-sm-12 p-0">Option E : </label>
                                       <div class="col-sm-12 border-bottom p-0">
                                           <input type="text" placeholder="Add new Option" value="<?= isset($answer[4]->answer) ? $answer[4]->answer : "" ?>"
                                               class="form-control p-0 border-0" name="choiceE"
                                               id="choiceE">
                                       </div>
                                    </div>
                                    
                                    <label for="" class="col-sm-12 p-0">Choose the right one : </label>
                                    <div class="row">
                                        <div class="form-group col-sm-1">
                                        <div class="col-md-12 border-bottom p-0">
                                            <label for="isAnwerA">Option A</label>
                                             <?php $checked = (isset($answer[0]->isAnswer) &&  $answer[0]->isAnswer == true) ? "checked" : ""; ?>
                                             <input type="checkbox" class="form" name="isAnswerA" id="isAnswerA" <?= $checked ?>>
                                        </div>
                                        </div>
                                        <div class="form-group col-sm-1">
                                        <div class="col-md-12 border-bottom p-0">
                                            <label for="isAnwerB">Option B</label>
                                            <?php $checked = (isset($answer[1]->isAnswer) &&  $answer[1]->isAnswer == true) ? "checked" : ""; ?>
                                             <input type="checkbox" class="form" name="isAnswerB" id="isAnswerB" <?= $checked ?>>
                                        </div>
                                        </div>
                                        <div class="form-group col-sm-1">
                                        <div class="col-md-12 border-bottom p-0">
                                            <label for="isAnwerC">Option C</label>
                                            <?php $checked = (isset($answer[2]->isAnswer) &&  $answer[2]->isAnswer == true) ? "checked" : ""; ?>
                                             <input type="checkbox" class="form" name="isAnswerC" id="isAnswerC" <?= $checked ?>>
                                        </div>
                                        </div>
                                        <div class="form-group mb-4 col-sm-1">
                                        <div class="col-md-12 border-bottom p-0">
                                            <label for="isAnwerD">Option D</label>
                                            <?php $checked = (isset($answer[3]->isAnswer) &&  $answer[3]->isAnswer == true) ? "checked" : ""; ?>
                                             <input type="checkbox" class="form" name="isAnswerD" id="isAnswerD" <?= $checked ?>>
                                        </div>
                                        </div>
                                        <div class="form-group col-sm-1">
                                        <div class="col-md-12 border-bottom p-0">

                                            <label for="isAnwerE">Option E</label>
                                            <?php $checked = (isset($answer[4]->isAnswer) && $answer[4]->isAnswer == true) ? "checked" : ""; ?>
                                             <input type="checkbox" class="form" name="isAnswerE" id="isAnswerE" <?= $checked ?>>
                                        </div>
                                        </div>
                                   </div>
                                   <div class="form-group">
                                        <label for="mark" class="col-md-12 p-0">Mark</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number"
                                                class="form-control p-0 border-0" name="mark" value="<?= $question->mark ?>"
                                                id="mark">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <input type="reset" class="btn btn-outline-success" value="Cancel">
                                            <input type="submit" class="btn btn-success" value="Save">
                                            <a href="questions.php?exam_slug=<?= $_GET['exam_slug'] ?>" class="btn btn-danger">Back</a>
                                          
                                            
                                            
                                            
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