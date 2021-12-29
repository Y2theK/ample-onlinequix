<?php
class User{
     //auth
     public static function auth()
     {
         if(isset($_SESSION['user_id'])){
             $user_id = $_SESSION['user_id'];
             return DB::table('users')->where('id',$user_id)->getOne();
         }else{
             return false;
         }
     }
     
     public static function getExamsOfUser($user_id)
     {
         $exams = DB::raw("select * from students_exams 
                           join exams on students_exams.exam_id = exams.id
                           where students_exams.student_id = $user_id")->orderBy('exam_id','desc')->getAll();
         if($exams)
         {
             return $exams;
         }else {
             return false;
         }
     }
     public static function login($request)
    {
        $error = [];
        if(isset($request))
        {
            $email = Helper::filter($request['email']);
             $password = $request['password'];
         //check email
         $user = DB::table('users')->where('email',$email)->getOne();

         //password verify
         if($user)
         {
             $db_password = $user->password;
             if(password_verify($password,$db_password)){
                 $_SESSION['user_id'] = $user->id;
                 return "success";
             }
             else{
                 //wrong password
                 $error[] = "Wrong Password";
             }
            
         }
         else
         {
             //wrong email
             $error[] = "Wrong Email";
             

         }
         return $error;

        }
        
        
    }
    // update
    public static function update($request)
    {
        $user = User::auth();
        $user = DB::update("users",[
            "username" => Helper::filterHtml($request['name']),
            "slug" => Helper::slug($request['name']),
            'email' => Helper::filterHtml($request['email']),
            'phone_no' => Helper::filterHtml($request['phone_no']),
            'address' => Helper::filterHtml($request['address'])
            
        ],$user->id);


        // image upload
        if($_FILES['image'] && !empty($_FILES['image']['name']))
        {
            $image = $_FILES['image'];
            $image_name = $image['name'];
            $tmp_name = $image['tmp_name'];
            $file_path = "assets/images/user-profiles/".$image_name;
            //move image
            move_uploaded_file($tmp_name,$file_path);
            //destroy image
            if($user->image != "assets/images/user-profiles/user.png")
            {
                unlink($user->image);
            }
               

            //update database
            $user = DB::update('users',[
                'image' => Helper::filterHtml($file_path)
            ],$user->id);
        }
       
       if($user)
        return "success";
       else
        return false;
    }
    //register
    public static function register($request)
    {
        $error = [];
        if(isset($request))
        {
            if(empty($request['name'])){
                $error[] = "Name is Required";
            }
            if(empty($request['email'])){
                $error[] = 'Email is Required';
            }
            if(!filter_var($request['email'],FILTER_VALIDATE_EMAIL)){
                $error[] = 'Invaid Email Format';
            }
            if(empty($request['password'])){
                $error[] = 'Password is Required';
            }
            //check email already exist
            $user = DB::table('users')->where('email',$request['email'])->getOne();
            if($user)
            {
                $error[] = "Email already exist";
            }
            if(count($error))
            {
                return $error;
            }else
            {
            
                $user = DB::create("users",[
                    "username" => Helper::filterHtml($request['name']),
                    "slug" => Helper::slug($request['name']),
                    'email' => Helper::filterHtml($request['email']),
                    'password'=> password_hash($request['password'],PASSWORD_BCRYPT),
                    'role' => "Student",
                     'image' => "assets/images/user-profiles/user.png"
                ]);
                $_SESSION['user_id'] = $user->id;
                return "success";
            }
            
        }
      
    }
}