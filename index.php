<?php  require_once "inc/header.php";
$user = User::auth();
$counter = 1;
    
//paginate course
$course_pagination = DB::table('courses')->orderBy('id','desc')->paginate(5);
$course = $course_pagination['data'];
//all course
$all_course = DB::table('courses')->orderBy('id','desc')->getAll();
//dashboard card
$course_count = DB::table('courses')->count();
$ins_count = DB::table('users')->where('role',"teacher")->count();
$stu_count = DB::table('users')->where('role',"student")->count();


if($_POST)
{
    print_r($_POST);
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
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <?php if(!User::auth()): ?>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="login.php" class="fw-normal text-danger">Login</a></li>
                            </ol>
                            <a href="register.php"
                                class="btn btn-danger d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Register</a>
                        </div>
                    </div>
                    <?php endif ?>
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
                <!-- Three charts -->
                <!-- ============================================================== -->
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Courses</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                <div><i class="fas fa-chart-area fa-2x text-success"></i></div>
                                </li>
                                <li class="ms-auto"><span class="counter text-success"><?= $course_count; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Instructors</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                <div><i class="fas fa-chart-line fa-2x text-purple"></i></div>
                                </li>
                                <li class="ms-auto"><span class="counter text-purple"><?= $ins_count; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Students</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                <div><i class="fas fa-chart-bar fa-2x text-info"></i></div>
                                    
                                </li>
                                <li class="ms-auto"><span class="counter text-info"><?= $stu_count; ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
               
                <!-- ============================================================== -->
                <!-- RECENT COURSE -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Recently Added Course</h3>
                               
                                <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                                    <select class="form-select shadow-none row border-top">
                                    <?php foreach($all_course as $c): ?>
                                        <option><?= $c->name ?></option>
                                    <?php endforeach; ?>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap text-center">
                                    <thead>
                                    
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Name</th>
                                            <th class="border-top-0">Description</th>
                                            <th class="border-top-0">Instructor</th>
                                            <th class="border-top-0">Learning Platform</th>
                                            <th class="border-top-0">View Outline</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($course as $c):
                                        $ins_id = DB::raw("select * from courses 
                                        left join courses_users on
                                        courses.id = courses_users.course_id
                                        where courses.id = $c->id
                                        ")->getOne()->user_id; 
                                        $ins_name = DB::table('users')->where('id',$ins_id)->getOne()->username; ?>
                                        <tr>
                                            <td><?= $counter; $counter++; ?></td>
                                            <td><?= $c->name; ?></td>
                                            
                                            <td><?= $c->description; ?></td>
                                            <td><?= $ins_name;?></td>
                                            <td><?= $c->platform; ?></td>
                                            
                                            <td>
                                                <a href="" class="text-success">View</a>
                                           
                                            </td>
                                        </tr>
                                       <?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Recent Review -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- .col -->
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="card white-box p-0">
                            <div class="card-body">
                                <h3 class="box-title mb-0">Recent Reviews</h3>
                            </div>
                                        
                            </div>
                            <div class="comment-widgets">
                                <!-- review  -->
                                <?php if($user): ?>
                                <div class="d-flex flex-row comment-row p-3 mt-0">
                                    <div class="p-2"><img src="<?= $user->image ?>" alt="user" width="40" class="rounded-circle"></div>
                                    <div class="comment-text ps-2 ps-md-3 w-100">
                                        <h5 class="font-medium"><?= $user->username ?></h5>
                                        <form action="" class="form-horizontal form-material" method="POST" id="review-form">
                                        <div class="form-group ms-3">
                                            <div class="row">
                                            <div class="col-sm-9 border-bottom p-0">
                                            <input type="text" placeholder="WOW! That php basic course is great. I learned a lot from there"
                                            class="form-control p-0 border-0" name="review" id="review">
                                        </div>
                                            <div class="col-sm-1 p-0">
                                            <button class="btn" type="submit"><i class="far fa-paper-plane pt-2 text-primary" ></i></button>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="comment-footer d-md-flex align-items-center">
                                            <label name="date" class="text-dark fs-2 ms-auto mt-2 mt-md-0"><?= date('M d, Y') ?></label>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <hr>
                                <!--  all reviews  -->
                                <div id="review-list">
                                <?php 
                                $reviews = DB::table('reviews')->orderBy('id','desc')->getAll();
                                if($reviews):
                                    foreach($reviews as $r):
                                        $reviewer = DB::table('users')->where('id',$r->user_id)->getOne();
                                
                                ?>
                                <div class="d-flex flex-row comment-row p-3">
                                    <div class="p-2"><img src="<?= $reviewer->image ?>" alt="user" width="40" class="rounded-circle"></div>
                                    <div class="comment-text ps-2 ps-md-3 active w-100">
                                        <h5 class="font-medium"><?= $reviewer->username; ?></h5>
                                        
                                        <span class="mb-3 d-block col-sm-10"><?= $r->review ?> </span>
                                        
                                       
                                        <div class="comment-footer d-md-flex align-items-center">
                                        
                                            <span class="badge bg-success rounded">5 stars</span>
                                            
                                            
                                            <div class="text-muted fs-2 ms-auto mt-2 mt-md-0"><?= $r->date ?></div>
                                            
                                           
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; endif; ?>
                                </div>
                                <!-- Comment Row
                                <div class="d-flex flex-row comment-row p-3">
                                    <div class="p-2"><img src="template/plugins/images/users/ritesh.jpg" alt="user" width="50" class="rounded-circle"></div>
                                    <div class="comment-text ps-2 ps-md-3 w-100">
                                        <h5 class="font-medium">Johnathan Doeting</h5>
                                        <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.It has survived not only five centuries. </span>
                                        <div class="comment-footer d-md-flex align-items-center">

                                            <span class="badge rounded bg-danger">Rejected</span>
                                            
                                            <div class="text-muted fs-2 ms-auto mt-2 mt-md-0">April 14, 2021</div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- /.col -->
                </div>
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
  <?php require_once "inc/footer.php"; ?>

  <script>
    
        
        var reviewForm = document.querySelector('#review-form');
        var review = document.getElementById('review');
        var reviewList = document.querySelector('#review-list');
      
       
        reviewForm.addEventListener('submit',function(e){
          e.preventDefault();
          var data = new FormData();
          data.append("user_id",<?= $user->id ?>)
          data.append("review",review.value);
          data.append("date",new Date());
          console.log(data);
          axios.post('api.php',data)
          .then(function(res){
              console.log(res.data);
              review.value = "";
              reviewList.innerHTML = res.data;
          });
      });
   
     
  </script>