<?php
class Question{
   //all question of one exam
   public static function ofExam($exam_id)
   {
       $course_exam = DB::raw("select questions.*,exams.title from questions
                              join exams on exams.id = questions.exam_id
                              where questions.exam_id =  $exam_id
                              ")->getAll();
       return $course_exam;
   }
   //exam of one question
   public static function getExam($question_id)
   {
      $question = DB::raw("select questions.*,exams.title as exam_title,exams.ins_id from questions
                              join exams on exams.id = questions.exam_id
                              where questions.id =  $question_id
                              ")->getOne();
       return $question;
   }
   public static function delete($slug)
   {
      if($slug)
      {
         $question = DB::table('questions')->where('slug',$slug)->getOne();
         if($question)
         {
            $question_id = $question->id;
            $delans = DB::raw("delete from answers where question_id = $question_id")->getAll();
            $delque = DB::delete('questions',$question_id);
            //need to delete students_answers
               return "success";
           
         }else {
            
            return false;
         }
      }
   }
   public static function getMarkByQuestion($question_id,$student_id)
   {
      $user = User::auth();
      $total_mark = DB::table('questions')->where('id',$question_id)->getOne()->mark;
      $answer = Question::getAnswer($question_id);
      $correct_answer_count = 0;
      foreach($answer as $a)
      {
         if($a->isAnswer == true)
         {
            // $stu_correct_answer = DB::table('students_answers')->where('id',$a->id)->getOne();
            // if($stu_correct_answer)
               $correct_answer_count++;
         }
      }
      $each_answer_mark =  $total_mark/$correct_answer_count;
      $each_answer_mark = round($each_answer_mark,2);
      $stu_mark = 0;
      foreach($answer as $a)
      {
            if($a->isAnswer == true)
            {
               $correct = DB::table('students_answers')->where('answer_id',$a->id)->andWhere('student_id',$student_id)->getOne();
                if($correct)
                   $stu_mark += $each_answer_mark;
            }
            elseif($a->isAnswer == false){
                  $incorrect = DB::table('students_answers')->where('answer_id',$a->id)->andWhere('student_id',$student_id)->getOne();
                  if($incorrect)
                     return 0;
            }else {
               return 0;
            }
             
             
       
      }
      return $stu_mark;

   }
   public static function getAnswer($question_id)
   {
      $answer = DB::table('answers')->where('question_id',$question_id)->getAll();
      return $answer;
   }
   public static function update($request,$question_id)
   {
      $error = [];
     
      if(empty($request['question']))
      {
            $error[] = "Question Required";
      }
      if(empty($request['choiceA']))
      {
         $error[] = "choiceA Required";
      }
      if(empty($request['choiceB']))
      {
         $error[] = "choiceB Required";
      }
      if(empty($request['choiceC']))
      {
         $error[] = "choiceC Required";
      }
      if(empty($request['mark']))
      {
         $error[] = "Mark Required";
      }
      //need to check isAnswer // 
      if(count($error))
      {
          return $error;
      }
      else
      {
         $question = DB::update('questions',[
           
           'question' => $request['question'],
           
           'mark' => $request['mark']


         ],$question_id);   
         
          if($question)
          {
            $delans = DB::raw("delete from answers where question_id = $question_id")->getOne();
           
             
               if($request['choiceA'] && $request['choiceB'] && $request['choiceC'])
            {
               $answer = DB::create('answers',[
              "question_id" => $question->id,
               "answer" => $request['choiceA'],
               'isAnswer' => isset($request['isAnswerA']) ? true : false
               ]);   
               $answer = DB::create('answers',[
                  "question_id" => $question->id,
                   "answer" => $request['choiceB'],
                   'isAnswer' => isset($request['isAnswerB']) ? true : false
                   ]);   
               $answer = DB::create('answers',[
               "question_id" => $question->id,
               "answer" => $request['choiceC'],
               'isAnswer' => isset($request['isAnswerC']) ? true : false
               ]);   
            }
            if($request['choiceD'])
            {
               $answer = DB::create('answers',[
              "question_id" => $question->id,
               "answer" => $request['choiceD'],
               'isAnswer' => isset($request['isAnswerD'])  ? true : false
               ]);   
            }
            if($request['choiceE'])
            {
               $answer = DB::create('answers',[
              "question_id" => $question->id,
               "answer" => $request['choiceE'],
               'isAnswer' => isset($request['isAnswerE']) ? true : false
               ]);   
            }

              return "success";
           
            
         }
          
          else {
            return false;
         }
     }
   }
    public static function create($request,$exam_id)
    {
       $error = [];
       if(empty($exam_id))
       {
        $error[] = "Exam_ID Required";
       }
       if(empty($request['question']))
       {
             $error[] = "Question Required";
       }
       if(empty($request['choiceA']))
       {
          $error[] = "choiceA Required";
       }
       if(empty($request['choiceB']))
       {
          $error[] = "choiceB Required";
       }
       if(empty($request['choiceC']))
       {
          $error[] = "choiceC Required";
       }
       if(empty($request['mark']))
       {
          $error[] = "Mark Required";
       }
      //  if(empty($request['isAnswerA']) || empty($request['isAnswerB']) || empty($request['isAnswerC']) || empty($request['isAnswerD']) || empty($request['isAnswerE'])){
      //     $error[] = "Check correct answer";
      //  }
     
      //  if(!array_key_exists('isAnswerA',$request) || !array_key_exists('isAnswerB',$request) || !array_key_exists('isAnswerC',$request) || !array_key_exists('isAnswerD',$request) || !array_key_exists('isAnswerE',$request))
      //  {
      //    $error[] = "Check";
      //  }
       if(count($error))
       {
           return $error;
       }
       else  if(array_key_exists('isAnswerA',$request) || array_key_exists('isAnswerB',$request) || array_key_exists('isAnswerC',$request) || array_key_exists('isAnswerD',$request) || array_key_exists('isAnswerE',$request))
       {
          $question = DB::create('questions',[
            'exam_id' => $exam_id,
            'question' => Helper::filterHtml($request['question']),
            'slug' => Helper::slug($exam_id),
            'mark' => Helper::filterHtml($request['mark'])


          ]);   
           if($question)
           {
              
            if($request['choiceA'] && $request['choiceB'] && $request['choiceC'])
            {
               $answer = DB::create('answers',[
              "question_id" => $question->id,
               "answer" => Helper::filterHtml($request['choiceA']),
               'isAnswer' => isset($request['isAnswerA']) ? true : false
               ]);   
               $answer = DB::create('answers',[
                  "question_id" => $question->id,
                   "answer" => Helper::filterHtml($request['choiceB']),
                   'isAnswer' => isset($request['isAnswerB']) ? true : false
                   ]);   
               $answer = DB::create('answers',[
               "question_id" => $question->id,
               "answer" => Helper::filterHtml($request['choiceC']),
               'isAnswer' => isset($request['isAnswerC']) ? true : false
               ]);   
            }
            if($request['choiceD'])
            {
               $answer = DB::create('answers',[
              "question_id" => $question->id,
               "answer" => Helper::filterHtml($request['choiceD']),
               'isAnswer' => isset($request['isAnswerD'])  ? true : false
               ]);   
            }
            if($request['choiceE'])
            {
               $answer = DB::create('answers',[
              "question_id" => $question->id,
               "answer" => Helper::filterHtml($request['choiceE']),
               'isAnswer' => isset($request['isAnswerE']) ? true : false
               ]);   
            }

              return "success";
           
           }
      }
      else {
         $error[] = "Error. Check your questions !"; 
         return $error;
      }
    }
}