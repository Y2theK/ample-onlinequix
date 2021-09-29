<?php require_once "inc/header.php";
if(!$user)
{
    Helper::redirect('index.php');
}



$ins_course = Course::ofThisTeacher($user->id);
$stu_course = Course::ofThisStudent($user->id);


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $exam = Exam::create($_POST);
   
    
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
                        <h4 class="page-title">Make Exam</h4>
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
                            
                            <?php if(isset($exam) and is_array($exam)): ?>
                                <div class="alert alert-danger"><?php print_r($exam) ?></div>
                            <?php elseif(isset($exam) and $exam == "success"): ?>
                                <div class="alert alert-success">Exam created Success</div>
                            <?php endif; ?>
                                <form class="form-horizontal form-material" action="" method="POST">
                                
                                <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Course in Charge</label>
                                    <select class="form-select shadow-none p-1" name="course_id">
                                    <?php foreach($ins_course as $c): ?>
                                        <option value="<?= $c->id ?>"><?= $c->name ?></option>
                                    <?php endforeach; ?>
                                       
                                    </select>
                                </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0" for="title">Topic</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="PHP basic" name="title"
                                                class="form-control p-0 border-0"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="description" class="col-md-12 p-0">Exam Description</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="Basic Logic"
                                                class="form-control p-0 border-0" name="description"
                                                id="description">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="time_limit" class="col-md-12 p-0">Time Limit</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="1:00"
                                                class="form-control p-0 border-0" name="time_limit"
                                                id="time_limit">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="lunch_date" class="col-md-12 p-0">Lunch Date</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="date"  min="<?= date('Y-m-d'); ?>"
                                                class="form-control p-0 border-0" name="lunch_date"
                                                id="lunch_date">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 d-flex">
                                        <div class="col-sm-12">
                                            <input type="submit" value="Create" class="btn btn-success">
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