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
    else if($exam)
    {
      
       
        $exam = Exam::getCourse($exam->id);
    
    }
}else{
    Helper::redirect('404.php');
}
if(($_POST))
{
    $examupd = Exam::update($_POST,$exam->id);

   
    
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
                        <h4 class="page-title">Edit Exam</h4>
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
                <!-- Row -->
               
                
                <div class="row ">
                   
                    <!-- Column -->
                    <div class="col-lg-10 col-xlg-10 col-md-12 mx-auto">
                        <div class="card">
                            <div class="card-body">
                            
                            <?php if(isset($examupd) and is_array($examupd)): ?>
                                <div class="alert alert-danger"><?php print_r($examupd) ?></div>
                            <?php elseif(isset($examupd) and !(is_array($examupd))): 
                                Helper::redirect("edit-exam.php?slug=$examupd->slug"); ?>
                            <?php endif;   ?>
                                <form class="form-horizontal form-material" action="" method="POST">
                                
                                <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Course Name</label>
                                   <input type="text" name="course" value="<?= ($exam->course_name); ?>" class="form-control p-0 border-0" disabled>
                                </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0" for="title">Exam Topic</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text"  name="title"
                                                class="form-control p-0 border-0" value="<?= $exam->title ?>"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="description" class="col-md-12 p-0">Exam Description</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?= $exam->description ?>"
                                                class="form-control p-0 border-0" name="description"
                                                id="description">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="time_limit" class="col-md-12 p-0">Time Limit</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?= $exam->time_limit ?>"
                                                class="form-control p-0 border-0" name="time_limit"
                                                id="time_limit">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="lunch_date" class="col-md-12 p-0">Lunch Date</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="date" value="<?= $exam->lunch_date ?>" min="<?= date('Y-m-d'); ?>"
                                                class="form-control p-0 border-0" name="lunch_date"
                                                id="lunch_date">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 d-flex">
                                        <div class="col-sm-12">
                                            <input type="submit" value="Update" class="btn btn-success">
                                            <input type="reset" value="Cancel" class="btn btn-outline-success">
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