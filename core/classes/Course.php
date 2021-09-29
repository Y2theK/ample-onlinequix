<?php

class Course{
    public static function ofThisTeacher($user_id)
    {
        $ins_course = DB::raw("select courses.*,users.username from courses_users 
         join courses on courses_users.course_id = courses.id 
         join users on users.id = courses_users.user_id
         where users.id = $user_id
        ")->orderBy('id','desc')->getAll();
        return $ins_course;
    }
    public static function ofThisStudent($user_id)
    {
        $stu_course = DB::raw("select courses.*,users.username from courses_students
        join courses on courses.id = courses_students.course_id
        join users on courses_students.student_id = users.id
        where users.id = $user_id
        ")->orderBy('id','desc')->getAll();
        return $stu_course;
    }
    public static function ofNotThisUser($user_id)
    {

        $user_notcourse = DB::raw("select * from courses
                                where courses.id != 
                                all(select courses.id from courses_users
                                join courses on courses_users.course_id = courses.id
                                where courses_users.user_id = $user_id)
                                and courses.id != 
                                all(select courses.id from courses_students
                                join courses on courses_students.course_id = courses.id
                                where courses_students.student_id = $user_id)
                                ")->getAll();
                return $user_notcourse;
    }
    public static function enroll($request,$course_id)
    {
        if(isset($course_id))
        {
            $x = DB::create('courses_students',[
                'course_id' => $course_id,
                'student_id' => User::auth()->id
            ]);
            if($x)
            {
                return "success";
            }else
            {
                return false;
            }
           
        }
    }
    public static function delete($slug)
    {
        $course = DB::table('courses')->where('slug',$slug)->getOne();
        if($course)
        {
            $course_id = $course->id;
            if($course_id)
            {
                $exam = Exam::ofCourse($course_id);
                if($exam)
                {
                    foreach($exam as $e)
                    {
                        $del = Exam::delete($e->slug);
                        
                    }
                }
                $delcourse_user = DB::raw("delete from courses_users where course_id = $course_id")->getAll();
                $delcourse_student = DB::raw("delete from courses_students where course_id = $course_id")->getAll();
                $delcourse = DB::delete('courses',$course_id);
              
                if($delcourse)
                {
                    return "success";
                }
            }else {
                return false;
            }
        }else {
            return false;
        }
    }
    public static function update($request,$course_id)
    {
        if(isset($request))
       {

        $course = DB::update('courses',
        [
            "name" => Helper::filterHtml($request['name']),
            "slug" => Helper::slug($request['name']),
            "platform" => Helper::filterHtml($request['platform']),
            "description" => Helper::filterHtml($request['description']),
            "outline" => Helper::filterHtml($request['outline']),
           
        ]
        ,$course_id);
        return "success";

        
       }else
       {
           return false;
       }
    }
    public static function create($request)
    {
        
       if(isset($request))
       {

        $course = DB::create('courses',
        [
            "name" => Helper::filterHtml($request['name']),
            "slug" => Helper::slug($request['name']),
            "platform" => Helper::filterHtml($request['platform']),
            "description" => Helper::filterHtml($request['description']),
            "outline" => Helper::filterHtml($request['outline']),
            "create_date" => date('Y-m-d')
        ]
        );

        if($course){
            $course_id = $course->id;
            DB::create('courses_users',[
                'course_id' => $course_id,
                'user_id' => User::auth()->id
            ]);
            return "success";
        }
        
       }else
       {
           return false;
       }
       
    }
    public static function lee()
    {
        echo "lee";
    }
}

?>