<?php
namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Classes;
use Auth;
class QuizController extends Controller
{
    private $type   =  "quizes";
    private $singular = "Quiz";
    private $plural = "Quizes";
    private $view = "teachers.quizes.";
    private $db_key   =  "id";
    private $action   =  "quiz";
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
    public function index(Request $request)
    {
        $data   = array();
        $data   = array(
            "page_title"=>$this->plural." List",
            "page_heading"=>$this->plural.' List',
            "breadcrumbs"=>array("#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key],
            "active_module" => "Quiz"
        );
        /*
        GET RECORDS
        */
        $records   = new Quiz;
        $records = $records::with('class');
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
        $data['quizes']   =   $records;
        // $data['list'] = Categories::get()->toArray();

        /*
        DEFAUTL VALUES
        */
        // dd($data['Course']['data']);
        // echo "<pre>"; print_r($data['list']); die();


        return view($this->view.'list',$data);
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
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $this->cleanData($data);

        // Check if the class already has 5 records
        $classId = $data['class_id']; // Assuming `class_id` is a field in the request
        $recordCount = Quiz::where('class_id', $classId)->count();

        if ($recordCount >= 5) {
            $response = [
                'flag' => false,
                'msg' => 'You can only add a maximum of 5 records for this class.',
                'action' => 'reload'
            ];
            echo json_encode($response); return redirect(url('teacher/quiz'));
        }

        // Handle file upload if exists
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Storage::putFile($this->directory, $file);
            $data['image'] = basename($filename);
        }

        // Save the record
        $user = new Quiz;
        $user->fill($data); // Use mass assignment for fillable fields
        $user->save();      // Save the user instance

        $response = [
            'flag' => true,
            'msg' => $this->singular . ' is added successfully.',
            'action' => 'reload'
        ];
        echo json_encode($response); return redirect(url('teacher/quiz'));
    }

    $data = [
        "page_title" => "Add " . $this->singular,
        "page_heading" => "Add " . $this->singular,
        "breadcrumbs" => ["dashboard" => "Dashboard", "#" => $this->plural . " List"],
        "action" => url('teacher/' . $this->action . '/create'),
        "module" => [
            'type' => $this->type,
            'singular' => $this->singular,
            'plural' => $this->plural,
            'view' => $this->view,
            'action' => 'teacher/' . $this->action,
            'db_key' => $this->db_key
        ],
        "active_module" => "Quiz"
    ];
    $data['Class'] = Classes::get();

    return view($this->view . 'create', $data);
}

public function edit(Request $request,$id = NULL)
{
    $data   = array();
    if($request->isMethod('post')){
        $data = $request->all();
        $this->cleanData($data);
        $CourseCategories   = Quiz::find($id);
            // $data['updated_by'] = \Auth::id();
        $CourseCategories->update($data);
        $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.','action'=>'reload');
        echo json_encode($response); return redirect(url('teacher/quiz'));
    }
        // echo $id = $id; die;
    $data   = array(
        "page_title"=>"Edit ".$this->singular,
        "page_heading"=>"Edit ".$this->singular,
        "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
        "action"=> url('admin/'.$this->action.'/edit/'.$id),
        "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key],
        "active_module" => "Quiz"
    );
    $data['row']      = Quiz::find($id)->toArray();
    $data['Class'] = Classes::get();
        // $data['list'] = Categories::get()->toArray();

        // echo "<pre>";print_r($data['row']);die;
    return view($this->view.'edit',$data);
}

public function update(Request $request,$id = NULL)
{
    if($request->input('param')){
        $data['is_active'] = $request->input('param');
        $this->cleanData($data);
        $CourseCategories  = Quiz::find($id);
        $CourseCategories->update($data);
        $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.');
        echo json_encode($response); return redirect(url('teacher/quiz'));
    }

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseCategories  $CourseCategories
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        $item = Quiz::find($id);
        $item->delete();
        $response = array('flag'=>true,'msg'=>$this->singular.' has been deleted.');
        echo json_encode($response); return redirect(url('/teacher/quiz'));
    }
}
