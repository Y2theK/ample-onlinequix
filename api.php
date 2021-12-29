<?php
require_once 'core/autoload.php';
if ($_POST['review']) {
    $review = $_POST['review'];
    $user_id = $_POST['user_id'];
    $date = date('Y-m-d');
    $res = DB::create('reviews', [
       'review' => $review,
       'user_id' => $user_id,
       'date' => $date
   ]);
    if ($res) {
        $reviews = DB::table('reviews')->orderBy('id', 'desc')->getAll();
        $review_list = "";
        foreach ($reviews as $r):
            $reviewer = DB::table('users')->where('id', $r->user_id)->getOne();
        $review_list .= "
            <div class='d-flex flex-row comment-row p-3'>
                <div class='p-2'><img src='{$reviewer->image}' alt='user' width='50' class='rounded-circle'></div>
                <div class='comment-text ps-2 ps-md-3 active w-100'>
                    <h5 class='font-medium'>{$reviewer->username}</h5>
                    <span class='mb-3 d-block'>{$r->review} </span>
                    <div class='comment-footer d-md-flex align-items-center'>

                        <span class='badge bg-success rounded'>5 stars</span>
                        
                        <div class='text-muted fs-2 ms-auto mt-2 mt-md-0'>{$r->date}</div>
                    </div>
                </div>
            </div>
            
            
            ";
            
    

    
    
        endforeach;
        echo $review_list;
    }
}


// echo "leeeeeeeeeeee pl";
