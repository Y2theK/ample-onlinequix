<?php require_once "inc/header.php";
if(!$user)
{
    Helper::redirect('index.php');
}

$user = User::auth();
if($_POST)
{
    // print_r($_FILES);
    $flag = User::update($_POST);
    // print_r($flag);
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
                        <h4 class="page-title">Profile page</h4>
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
                <!-- Row -->
                <div class="row">
                     <?php if(isset($flag) and $flag == false): ?>
                                <div class="alert alert-danger"><?php print_r($questionupd) ?></div>
                            <?php elseif(isset($flag) and $flag == "success"):  ?>
                                <div class="alert alert-success">update successfully</div>
                            <?php endif;   ?>
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?= $user->image ?>">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="<?= $user->image ?>"
                                                class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white mt-2"><?= $user->username ?></h4>
                                        <h5 class="text-white mt-2"><?= $user->email ?></h5>
                                        <h5 class="text-white mt-2"><?= $user->phone_no ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box mt-5 d-sm-flex">
                                <div class="col-md-4 col-sm-4 text-center">
                                   <h3 class="text-center"><?= $user->role ?></h3>
                                </div>
                                
                            </div>
                            
                        </div>
                        <?php if($user->role == "Student"): ?>
                        <div class="user-btm-box m-5 d-sm-flex">
                                <div class="col-md-12 col-sm-12 text-center">

                                   <a href="teacher-apply.php" class="btn btn-primary">Make me teacher</a>
                                </div>
                                
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Full Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?= $user->username ?>"
                                                class="form-control p-0 border-0" name="name"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" value="<?= $user->email ?>"
                                                class="form-control p-0 border-0" name="email"
                                                id="email">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Choose Image</label>
                                        <div class="col-md-12 border-bottom pt-2">
                                            <input type="file"  class="form-control pt-2 ps-2 border-0" name="image">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Phone No</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?= $user->phone_no ?>"
                                                class="form-control p-0 border-0" name="phone_no">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Address</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <textarea rows="3" class="form-control p-0 border-0" name="address"><?= $user->address ?></textarea>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-secondary" value="Update">
                                            <input type="button" class="btn btn-outline-dark" value="Cancel">

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