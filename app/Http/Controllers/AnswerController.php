<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\classes;
class AnswerController extends Controller
{
    public function showStudents($id)
    {
        dd('ok');
    // Fetch the quiz details to get the class_id
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return redirect()->back()->with('error', 'Quiz not found.');
        }

        $classId = $quiz->class_id;

    // Fetch the students assigned to the quiz through enrollments
        $assignedStudents = Enrollment::where('class_id', $classId)
        ->pluck('student_id')
        ->toArray();

    // Fetch the student details based on the assigned student IDs
    $students = User::where('role', '3') // Assuming role '3' indicates students
    ->whereIn('id', $assignedStudents)
    ->get();

    // Fetch class details for display purposes
    $class = Classes::find($classId);

    // Prepare data for the view
    $data = [
        'students' => $students,
        'class' => $class,
        'quiz' => $quiz
    ];

    return view('teacher.answers.list', $data);
}
}
