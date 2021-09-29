<?php

class Exam{
    //give all exams of this course
    public static function ofCourse($course_id)
    {
        $course_exam = DB::raw("select exams.*,courses.name from courses_exams
                                 join courses on courses_exams.course_id = courses.id
                                 join exams on courses_exams.exam_id = exams.id 
                                 where courses.id =  $course_id
                                
                        ")->orderBy('id','desc')->getAll();
        return $course_exam;
    }
    //give one course which belongs to this exams
    public static function getCourse($exam_id)
    {
        $exam = DB::raw("select exams.*,courses.name as course_name from courses_exams
        join courses on courses_exams.course_id = courses.id
        join exams on courses_exams.exam_id = exams.id 
        where exams.id =  $exam_id
       
    ")->getOne();
    return $exam;
    }
    public static function getTotalMark($exam_id)
    {
        $total_mark = 0;
        $mark = DB::table('questions')->where('exam_id',$exam_id)->getAll();
        foreach($mark as $m)
        {
            $total_mark += ($m->mark);
        }
        return $total_mark;
    }
    
    public static function getYourMark($exam_id,$student_id)
    {
        $count = 0; 
        $questions = Question::ofExam($exam_id);
        foreach($questions as $q)
        {
           
           $count += Question::getMarkByQuestion($q->id,$student_id);
          
        }
        return $count;
    }
    public static function getTotalQuestions($exam_id)
    {
        return DB::table('questions')->where('exam_id',$exam_id)->count(); 
    }
    public static function update($request,$exam_id)
    {
        $error = [];
        
        if(empty($request['title']))
        {
            $error[] = "Exam Title is Required";
        }
        if(empty($request['description']))
        {
            $error[] = "Exam Description is Required";
        }
        if(count($error))
        {
            return $error;
        }else
        {
            $examupd = DB::update('exams',[
                    
                "title" => Helper::filterHtml($request['title']),
                "slug" => Helper::slug($request['title']),
                "description" => Helper::filterHtml($request['description']),
                "time_limit" => Helper::filterHtml($request['time_limit']),
            
                'lunch_date' => Helper::filterHtml($request['lunch_date'])
            ],$exam_id);
            if($examupd)
            {
                return $examupd;
             
            }else {
                return false;
            }
           
        }
    }
    public static function delete($slug)
    {
        if($slug)
        {
            $exam = DB::table('exams')->where('slug',$slug)->getOne();
            if($exam)
            {
                $exam_id = $exam->id;
                $questions = DB::table('questions')->where('exam_id',$exam_id)->getAll();
                foreach($questions as $q)
                {
                   
                    $delques = Question::delete($q->slug);
                }
                    $delCourse_exam = DB::raw("delete from courses_exams where exam_id = $exam_id")->getAll();
                    $delstudent_exam = DB::raw("delete from students_exams where exam_id = $exam_id")->getAll();
                    $delExam = DB::delete('exams',$exam_id);
                    
                    if($delCourse_exam && $delExam && $delques)
                    {
                        return "success";
                    }
                    else {
                        return false;
                    }
                
            }else {
                return false;
            }
           
           
        }
    }
    public static function create($request)
    {
        

        $error = [];
        if(empty($request['course_id']))
        {
            $error[] = "Course Required";
        }
        if(empty($request['title']))
        {
            $error[] = "Exam Title is Required";
        }
        if(empty($request['description']))
        {
            $error[] = "Exam Description is Required";
        }
        if(count($error))
        {
            return $error;
        }else
        {
            $exam = DB::create('exams',[
                "ins_id" => User::auth()->id,
                "title" => Helper::filterHtml($request['title']),
                "slug" => Helper::slug($request['title']),
                "description" => Helper::filterHtml($request['description']),
                "time_limit" => Helper::filterHtml($request['time_limit']),
                "create_date" => Helper::filterHtml(date('Y-m-d')),
                'lunch_date' => Helper::filterHtml($request['lunch_date'])
            ]);
            if($exam)
            {
               
                $flag = DB::create('courses_exams',[
                    "course_id" => $request['course_id'],
                    'exam_id' => $exam->id,
                ]);
                if($flag)
                {
                    return "success";
                }

            }else{
                return false;
            }
        }
    }
}