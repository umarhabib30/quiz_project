<?php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students\Answer;
use App\Models\Quiz;
use App\Models\Classes;
use App\Models\Enrollment;
use App\Models\Question;
use App\Models\User;

class AnswerController extends Controller
{
    private $type   =  "answers";
    private $singular = "Answer";
    private $plural = "Answers";
    private $view = "teachers.answers.";
    private $db_key   =  "id";
    private $action   =  "answers";
    private $directory  =   '/public/images';
    private $perpage   =  10;

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function search($records,$request,&$data) {

        /*
        SET DEFAULT VALUES
        */
        if($request->perpage)
            $this->perpage  =   $request->perpage;
        $data['sindex']     = ($request->page != NULL)?($this->perpage*$request->page - $this->perpage+1):1;

        /*
        FILTER THE DATA
        */
        $params = [];
        if($request->cons_id) {
            $params['cons_id'] = $request->cons_id;
            $records = $records->where("cons_id",$params['cons_id']);
        }
        if($request->is_active) {
            $params['is_active'] = $request->is_active;
            $records = $records->where("is_active",$params['is_active']);
        }

        $data['request'] = $params;
        return $records;
    }
    public function index(Request $request)
    {
        $data   = array();
        $data   = array(
            "page_title"=>$this->plural." List",
            "page_heading"=>$this->plural.' List',
            "breadcrumbs"=>array("#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key],
            "active_module" => "Answer"
        );
        // dd($data);
        /*
        GET RECORDS
        */
        $records   = new Answer;
        $records = $records::with('quiz', 'student', 'question');
        $records   = $this->search($records,$request,$data);
        /*
        GET TOTAL RECORD BEFORE BEFORE PAGINATE
        */

        $data['count']      = $records->count();

        /*
        PAGINATE THE RECORDS
        */
        $records = $records->paginate($this->perpage);
        $data['total'] = $records->total();
        $data['perPage'] = $records->perPage();
        $data['currentPage'] = $records->currentPage();
        $records->appends($request->all())->links();
        $links = $records->links();
        $records = $records->toArray();
                    // print_r($records); die;

        $records['pagination'] = $links;

        /*
        ASSIGN DATA FOR VIEW
        */
        $data['answers']   =   $records;
        // dd($data);
        return view($this->view.'list',$data);
    }
    public function showStudents($id)
    {
        // dd('ok');
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
    $data   = array(
        "active_module" => "Question"
    );
    // Prepare data for the view
    $data = [
        'students' => $students,
        'class' => $class,
        'quiz' => $quiz
    ];

    return view('teachers.answers.list', $data);
}
public function showAnswer($quizId, $studentId)
{
    // Fetch the quiz details
    $quiz = Quiz::find($quizId);

    if (!$quiz) {
        return redirect()->back()->with('error', 'Quiz not found.');
    }

    // Fetch questions for the quiz
    $questions = Question::where('quiz_id', $quizId)->get();

    // Fetch answers submitted by the specific student for this quiz
    $answers = Answer::where('quiz_id', $quizId)
                     ->where('user_id', $studentId)
                     ->get();

    // Map answers to questions for easy lookup
    $answersByQuestion = $answers->groupBy('question_id');

    // Fetch the student details
    $student = User::find($studentId);

    if (!$student) {
        return redirect()->back()->with('error', 'Student not found.');
    }

    // Prepare data for the view
    $data = [
        'quiz' => $quiz,
        'questions' => $questions,
        'answersByQuestion' => $answersByQuestion,
        'student' => $student,
        'active_module' => 'Answer'
    ];

    return view('teachers.answers.quiz_answers', $data);
}


public function cleanData(&$data) {
    $unset = ['q','_token'];
    foreach ($unset as $value) {
        if(array_key_exists ($value,$data))  {
            unset($data[$value]);
        }
    }
    $int = ['Price'];
    foreach ($int as $value) {
        if(array_key_exists ($value,$data))  {
            $data[$value] = (int)str_replace(['(','Rs',')',' ','-','_',','], '', $data[$value]);
        }

    }
}



}
