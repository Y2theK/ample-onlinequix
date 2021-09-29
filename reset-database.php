<?php

require_once 'core/autoload.php';
DB::truncate('answers');
DB::truncate('courses');
DB::truncate('courses_exams');
DB::truncate('courses_students');
DB::truncate('courses_users');
DB::truncate('exams');
DB::truncate('questions');
DB::truncate('reviews');
DB::truncate('students_answers');
DB::truncate('students_exams');
DB::truncate('users');
echo "Yay";
Helper::redirect('index.php');

?>