<?php require_once "inc/header.php";
if(!$user)
{
    Helper::redirect('index.php');
}

if(isset($_GET['slug']))
{
    $slug = $_GET['slug'];
    $course = DB::table('courses')->where('slug',$slug)->getOne();
    if(!($course))
    {
        Helper::redirect('404.php');
    }
    else
    {
        $ins_id = DB::table('courses_users')->where('course_id',$course->id)->getOne()->user_id;
        $ins_name = DB::table('users')->where('id',$ins_id)->getOne()->username;
    }
}
else{
    Helper::redirect('404.php');
}
if($_POST and $course)
{
    
    $flag = Course::enroll($_POST,$course->id);
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
                        <h4 class="page-title">Enroll Course</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="index.php" class="fw-normal">Dashboard /</a></li>
                                
                                <li><a href="courses.php" class="fw-normal"> / Courses</a></li>
                               
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
                    <div class="col-lg-10 col-xlg-10 col-md-10 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="" method="POST">
                                <?php if(isset($flag) && $flag == "success"): ?>
                                    <div class="alert alert-success">Enroll successed!</div>
                                    <?php //Helper::redirect('index.php') ?>
                                <?php   elseif(isset($flag) and is_array($flag)): ?>
                                    <div class="alert alert-danger"><?php print_r(array_values($flag))?></div>
                                 <?php endif; ?>
                                 <div class="form-group mb-4">
                                        <h4 for="email" class="col-md-12 p-0">Do you want enroll Instructor <span style="color: red; font-size:25px; "><?= $ins_name ?>'s <?= $course->name ?> Course</span> ?</h4>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label for="email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" placeholder="johnathan@admin.com"
                                                class="form-control p-0 border-0" name="email"
                                                id="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                    <h4 class="col-md-12 p-0">Please kindly obey these rule and regulation !</h4>
                                    <p class="col-md-12 p-0">
                                        1. Behave Properly.<br>
                                        2. Have Respect. <br>
                                        3. Have Fun and Focus on Study. <br>
                                        4. No Blah Blah <br>
                                    </p>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="checkbox" name="isCheck" required> I agree all the term and regulation from this courses.
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-success" value="I agree">
                                            <input type="reset" name="" id="" value="Cancel" class="btn btn-outline-success">
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