<?php
class Answer{
    public static function byStudent($answer_id)
    {
        $answer = DB::raw("select * from students_answers
                            join answers on students_answers.answer_id = answers.id
                            where answers.id = $answer_id");
        return $answer;
    }
    public static function added($request,$exam_id)
    {
        $user = User::auth();
        $dateNow = date('Y-m-d');
        
       // $del = DB::raw("delete from students_answers where student_id = $user->id")->getAll();
        $answer = $request['answer'];
        if($answer)
        {
                foreach($answer as $a)
                {
                   
                    $ans = DB::create('students_answers',[
                        'student_id' => $user->id,
                        'answer_id' => $a
                    ]);
                    
                }
            if($ans)
            {
                $exam = DB::create('students_exams',[
                    'exam_id' => $exam_id,
                    'student_id' => $user->id,
                    "submit_date" => date('Y-m-d'),
                ]);
                if($exam && $ans)
                {
                    return "success";
                }
            }
        }else
        {
            return false;
        }
       
        
    }
}