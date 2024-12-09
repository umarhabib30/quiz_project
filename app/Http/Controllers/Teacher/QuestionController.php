<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use Auth;
class QuestionController extends Controller
{
   private $type   =  "questions";
   private $singular = "Question";
   private $plural = "Questions";
   private $view = "teachers.questions.";
   private $db_key   =  "id";
   private $action   =  "questions";
   private $directory  =   '/public/images';
   private $perpage   =  10;


   public function __construct()
   {
    $this->middleware('auth');
}
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
    public function index(Request $request, $quizid = null)
    {
        $data = array(
            "page_title" => $this->plural . " List",
            "page_heading" => $this->plural . ' List',
            "breadcrumbs" => array("#" => $this->plural . " List"),
            "action" => url('teacher/' . $this->action),
            "module" => [
                'type' => $this->type,
                'singular' => $this->singular,
                'plural' => $this->plural,
                'view' => $this->view,
                'action' => 'teacher/' . $this->action,
                'db_key' => $this->db_key
            ],
            "active_module" => "Question",
        "quizid" => $quizid, // Add the quiz ID here
    );

    // Retrieve records associated with the quiz
        $records = Question::with('quiz')->where('quiz_id', $quizid);

    // Apply search filters if needed
        $records = $this->search($records, $request, $data);

    // Get record count before pagination
        $data['count'] = $records->count();

    // Paginate the records
        $records = $records->paginate($this->perpage);
        $data['total'] = $records->total();
        $data['perPage'] = $records->perPage();
        $data['currentPage'] = $records->currentPage();

    // Add pagination links
        $links = $records->appends($request->all())->links();
        $records = $records->toArray();
        $records['pagination'] = $links;

    // Assign data for the view
        $data['questions'] = $records;

    // Return the view with the data
        return view($this->view . 'list', $data);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $quizid)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

        // Sanitize input data
            $this->cleanData($data);

        // Check if the quiz exists
            $quiz = Quiz::find($quizid);
            if (!$quiz) {
                return response()->json([
                    'flag' => false,
                    'msg' => 'Quiz not found.',
                    'action' => 'reload'
                ]);
            }

        // Check if the quiz already has 5 questions
            $recordCount = Question::where('quiz_id', $quizid)->count();
            if ($recordCount >= 5) {
                return response()->json([
                    'flag' => false,
                    'msg' => 'You can only add a maximum of 5 questions for this quiz.',
                    'redirect' => url('/teacher/questions/' . $quizid),
                ]);
            }

        // Save question
            $data['quiz_id'] = $quizid;
            $question = new Question;
            $question->fill($data);
            $question->save();
            $response = array('flag'=>true,'msg'=>' Question has been added successfully');
            echo json_encode($response); return redirect(url('/teacher/questions/' . $quizid));

            /*return response()->json([
                'flag' => true,
                'msg' => 'Question has been added successfully.',
                'redirect' => url('/teacher/questions/' . $quizid),
            ]);*/
        }

        $data = [
            "page_title" => "Add " . $this->singular,
            "page_heading" => "Add " . $this->singular,
            "breadcrumbs" => ["dashboard" => "Dashboard", "#" => $this->plural . " List"],
            "action" => url('teacher/questions/' . $quizid . '/create'),
        "Quiz" => Quiz::find($quizid), // Pass quiz details if needed
        "quizid" => $quizid, // Ensure this is included
        "active_module" => "Question"
    ];
    return view($this->view . 'create', $data);
}


public function edit(Request $request, $quizid, $id = null)
{
    $data = array();

    if ($request->isMethod('post')) {
        $data = $request->all();
        $this->cleanData($data); // Optional sanitization method
        $question = Question::find($id);

        if ($question) {
            $question->update($data);
            $response = array('flag'=>true,'msg'=>' Question has been Updated successfully');
            echo json_encode($response); return redirect(url('/teacher/questions/' . $quizid));
        } else {
            return response()->json([
                'flag' => false,
                'msg' => 'Question not found.'
            ]);
        }
    }

    $data = [
        "page_title" => "Edit " . $this->singular,
        "page_heading" => "Edit " . $this->singular,
        "breadcrumbs" => ["dashboard" => "Dashboard", "#" => $this->plural . " List"],
        "action" => url('teacher/questions/' . $quizid . '/edit/' . $id),
        "module" => [
            'type' => $this->type,
            'singular' => $this->singular,
            'plural' => $this->plural,
            'view' => $this->view,
            'action' => 'teacher/' . $this->action,
            'db_key' => $this->db_key
        ],
        "active_module" => "Question",
        "row" => Question::find($id)->toArray(),
        "quizid" => $quizid
    ];

    return view($this->view . 'edit', $data);
}


public function update(Request $request,$id = NULL)
{
    if($request->input('param')){
        $data['is_active'] = $request->input('param');
        $this->cleanData($data);
        $CourseCategories  = Question::find($id);
        $CourseCategories->update($data);
        $response = array('flag'=>true,'msg'=>' Question has been Updated successfully');
            echo json_encode($response); return redirect(url('/teacher/questions/' . $quizid));
    }

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseCategories  $CourseCategories
     * @return \Illuminate\Http\Response
     */
    public function delete($quizid, $id)
    {
        $question = Question::find($id);

        if ($question) {
            $question->delete();
            $response = array('flag'=>true,'msg'=>$this->singular.' has been deleted.');
            echo json_encode($response); return redirect(url('/teacher/questions/' . $quizid));
        } else {
            return response()->json([
                'flag' => false,
                'msg' => 'Question not found.'
            ]);
        }
    }

}
