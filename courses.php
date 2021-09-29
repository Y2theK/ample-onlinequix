<?php require_once "inc/header.php";
if(!$user)
{
    Helper::redirect('index.php');
}

$user = User::auth();
$counter = 1;
$course = DB::table('courses')->orderBy('id','desc')->getAll();
$ins_course = Course::ofThisTeacher($user->id);
$stu_course = Course::ofThisStudent($user->id);
$user_notcourse = Course::ofNotThisUser($user->id);
// print_r($user_notcourse);

if(isset($_GET['delete']))
{
    $slug = $_GET['slug'];
   
   
        $flag = Course::delete($slug);
        // print_r($del);
    
   
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
                        <h4 class="page-title">Courses</h4>
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
                <?php $counter =1; 
                if($courseTeacher): ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Your courses in Charge</h3>
                            <?php if(isset($flag) && $flag == "success"): ?>
                                    <div class="alert alert-success">Course DELETE successed!</div>
                               
                                <?php   elseif(isset($flag) and is_array($flag)): ?>
                                    <div class="alert alert-danger"><?php print_r(array_values($flag))?></div>
                                 <?php endif; ?>

                            <div class="table-responsive">
                                <table class="table text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Course name</th>
                                            <th class="border-top-0">Description</th>
                                            <th class="border-top-0">Instructor</th>
                                            <th class="border-top-0">Learning Platform</th>
                                            <th class="border-top-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if($ins_course):
                                        foreach($ins_course as $c): ?>
                                        <tr>
                                            <td><?= $counter++; ?></td>
                                            <td><?= $c->name; ?></td>
                                           
                                            <td><?= $c->description; ?></td>
                                            <td><?= $c->username;?></td>
                                            <td><?= $c->platform; ?></td>
                                            
                                            <td>
                                               
                                           
                                                <!-- <a href="exams.php" class="btn btn-info">Make Exam</a> -->
                                           
                                          
                                                <a href="add-course.php?slug=<?= $c->slug ?>" class="btn"><i class="fas fa-edit text-primary"></i></a>
                                                <a href="courses.php?slug=<?= $c->slug ?>&delete" class="btn"><i class="fas fa-trash text-danger"></i></a>
                                                
                                            </td>

                                        </tr>
                                       <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                 <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <?php $counter =1; 
                if($courseStudent): ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Your enrolled courses</h3>
                            
                            <div class="table-responsive">
                                <table class="table text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Course name</th>
                                            <th class="border-top-0">Description</th>
                                            <th class="border-top-0">Instructor</th>
                                            <th class="border-top-0">Learning Platform</th>
                                            <th class="border-top-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($stu_course as $c):
                                             $ins_id = DB::table('courses_users')->where('course_id',$c->id)->getOne()->user_id;
                                             $ins_name = DB::table('users')->where('id',$ins_id)->getOne()->username;
                                            
                                            
                                        ?>
                                        <tr>
                                            <td><?=  $counter++; ?></td>
                                            <td><?= $c->name; ?></td>
                                           
                                            <td><?= $c->description; ?></td>
                                            <td><?= $ins_name;?></td>
                                            <td><?= $c->platform; ?></td>
                                            
                                            <td>
                                            
                                                <a href="" class="btn btn-outline-primary"> <i class="far fa-folder-open"></i> </a>
                                                <a href="exams.php" class="btn btn-warning text-dark">Exams <i class="far fa-frown "></i> </a>
                                                
                                            </td>
                                            
                                        </tr>
                                       <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

                 <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <?php $counter =1; if($user_notcourse): ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Available Courses</h3>
                            
                            <div class="table-responsive">
                                <table class="table text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Course name</th>
                                            <th class="border-top-0">Description</th>
                                            <th class="border-top-0">Instructor</th>
                                            <th class="border-top-0">Learning Platform</th>
                                            <th class="border-top-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($user_notcourse as $c):
                                             $ins_id = DB::table('courses_users')->where('course_id',$c->id)->getOne()->user_id;
                                             $ins_name = DB::table('users')->where('id',$ins_id)->getOne()->username;
                                            
                                            
                                        ?>
                                        <tr>
                                            <td><?= $counter++; ?></td>
                                            <td><?= $c->name; ?></td>
                                           
                                            <td><?= $c->description; ?></td>
                                            <td><?= $ins_name;?></td>
                                            <td><?= $c->platform; ?></td>
                                            
                                            <td>
                                           
                                                <a href="enroll-course.php?slug=<?= $c->slug ?>" class="btn btn-danger " onclick="">Enroll <i class="fas fa-fire"> </i> </a>
                                                
                                            </td>
                                            
                                        </tr>
                                       <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

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