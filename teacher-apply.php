<?php require_once "inc/header.php";
if(!$user)
{
    Helper::redirect('index.php');
}

if(isset($_POST))
{
    $user = User::auth(); 
    $user = DB::update('users',[
    'role' => "Teacher",
],$user->id);

if($user)
{
    $flag = "success";
}else {
    $flag = false;
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
                        <h4 class="page-title">Teacher Application</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="index.php" class="fw-normal">Dashboard</a></li>
                            </ol>
                            
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
                <div class="row">
                    
                    <!-- Column -->
                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                            <?php if(isset($flag) && $flag == "success"): ?>
                                <div class="alert alert-success">Submittion successed!</div>
                                
                             <?php   elseif(isset($flag) and $flag==false): ?>
                                <div class="alert alert-danger">Submittion successfully failed</div>
                             <?php endif; ?>
                            
                                <form class="form-horizontal form-material" action="" method="POST">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0" for="field">Your Expert Field</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="Web Develpoment"
                                                class="form-control p-0 border-0" name="field"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="experience" class="col-md-12 p-0" >Experience</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="2 years as developer"
                                                class="form-control p-0 border-0" name="experience"
                                                id="experience">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0" for="Education">Educations</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="Education" placeholder="B.E (Hons)" 
                                                class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group mb-4">
                                        <div class="col-sm-4">
                                            <input type="reset" value="Cancel" class="btn btn-outline-success">
                                           <input type="submit" value="Submit" class="btn btn-success">
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