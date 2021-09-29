<?php
require_once "inc/header.php";
if(!$user)
{
    Helper::redirect('index.php');
}

$course = "";
//course create
if(($_POST) && !isset($_GET['slug']))
{
   
    $flag = Course::create($_POST);
    // print_r($_POST);
   
    
  

}
//course update
if(isset($_GET['slug']))
{
    $user = User::auth();
    $slug = $_GET['slug'];
    $course = DB::table('courses')->where('slug',$slug)->getOne();
    if(empty($course))
    {
        Helper::redirect('404.php');
    }
   
   
    if($course)
    {
       
       if(($_POST))
       {
         $updflag = Course::update($_POST,$course->id);
          
           
       }
    }
    
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
                        <h4 class="page-title">Add Course</h4>
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
                                    <div class="alert alert-success">Course create successed!</div>
                               
                                <?php   elseif(isset($flag) and is_array($flag)): ?>
                                    <div class="alert alert-danger"><?php print_r(array_values($flag))?></div>
                                 <?php endif; ?>

                                 <?php if(isset($updflag) && $updflag == "success"): ?>
                                    <div class="alert alert-success">Course Updated successed!</div>
                               
                                <?php   elseif(isset($updflag) and is_array($updflag)): ?>
                                    <div class="alert alert-danger"><?php print_r(array_values($flag))?></div>
                                 <?php endif; ?>

                                 
                                    <div class="form-group mb-4">
                                        <label for="name" class="col-md-12 p-0">Course Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <?php $course_name = ($course) ? $course->name : ""; ?>
                                            <input type="text" placeholder="Laravel Basic" value="<?= ($course_name) ?>"
                                                class="form-control p-0 border-0" name="name" required
                                                id="name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="user_name" class="col-md-12 p-0">Instructor Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="Sayar Ye" value="<?= User::auth()->username; ?>"
                                                class="form-control p-0 border-0" name="user_name"
                                                id="user_name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="description" class="col-md-12 p-0">Course Description</label>
                                        
                                        <div class="col-md-12 border-bottom p-0">
                                        <?php $course_description = ($course) ? $course->description : ""; ?>
                                            <textarea rows="3" class="form-control p-0 border-0" placeholder="Enter course desciption " name="description"><?=  $course_description ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="outline" class="col-md-12 p-0">Course Outline</label>
                                        
                                        <div class="col-md-12 border-bottom p-0">
                                        <?php $course_outline = ($course) ? $course->outline : ""; ?>
                                            <textarea rows="5" class="form-control p-0 border-0" placeholder="Descibe course outline" name="outline"><?= $course_outline ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="platform" class="col-md-12 p-0">Learning Platform</label>
                                        <div class="col-md-12 border-bottom p-0">
                                        <?php $course_platform = ($course) ? $course->platform : ""; ?>
                                            <input type="text" placeholder="Telegram group"
                                                class="form-control p-0 border-0" name="platform" value="<?= $course_platform ?>"
                                                id="platform">
                                        </div>
                                    </div>
                                    
                                   
                                   
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                        <input type="submit" class="btn btn-success" value="Create">
                                            <input type="reset" class="btn btn-outline-success" value="Cancel">
                                            
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