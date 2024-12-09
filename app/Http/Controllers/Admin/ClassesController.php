<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use Auth;
class ClassesController extends Controller
{
	private $type   =  "classes";
	private $singular = "Class";
	private $plural = "Classes";
	private $view = "admin.classes.";
	private $db_key   =  "id";
	private $action   =  "classes";
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
        $data = [
            "page_title" => $this->plural . " List",
            "page_heading" => $this->plural . ' List',
            "breadcrumbs" => ["#" => $this->plural . " List"],
            "action" => url('admin/' . $this->action),
            "module" => [
                'type' => $this->type,
                'singular' => $this->singular,
                'plural' => $this->plural,
                'view' => $this->view,
                'action' => 'admin/' . $this->action,
                'db_key' => $this->db_key
            ],
            "active_module" => "classes"
        ];

    // Fetch records with creator relationship
        $records = Classes::with('creator');
        $records = $this->search($records, $request, $data);

    // Get total record count before pagination
        $data['count'] = $records->count();

    // Paginate the records
        $records = $records->paginate($this->perpage);
        $data['total'] = $records->total();
        $data['perPage'] = $records->perPage();
        $data['currentPage'] = $records->currentPage();
        $records->appends($request->all())->links();
        $links = $records->links();
        $records = $records->toArray();
        $records['pagination'] = $links;
        $data['classes'] = $records;

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
    public function create(Request $request)
    {
    	if($request->isMethod('post')){
    		$data = $request->all();
    		$this->cleanData($data);
    		if ($request->hasFile('image')) {
    			$file = $request->file('image');
    			$filename = Storage::putFile($this->directory, $file);
    			$data['image'] = basename($filename);
    		}
    		$user = new Classes;
        $user->fill($data); // Use mass assignment for fillable fields
        $user->created_by = Auth::user()->id;
        $user->save();      // Save the user instance

        $response = [
        	'flag' => true,
        	'msg' => $this->singular . ' is added successfully.',
        	'action' => 'reload'
        ];
        echo json_encode($response); return redirect(url('admin/classes'));
    }

    $data = [
    	"page_title" => "Add " . $this->singular,
    	"page_heading" => "Add " . $this->singular,
    	"breadcrumbs" => ["dashboard" => "Dashboard", "#" => $this->plural . " List"],
    	"action" => url('admin/' . $this->action . '/create'),
    	"module" => [
    		'type' => $this->type,
    		'singular' => $this->singular,
    		'plural' => $this->plural,
    		'view' => $this->view,
    		'action' => 'admin/' . $this->action,
    		'db_key' => $this->db_key
    	],
    	"active_module" => "classes"
    ];

    return view($this->view . 'create', $data);
}
public function edit(Request $request,$id = NULL)
{
	$data   = array();
	if($request->isMethod('post')){
		$data = $request->all();
		$this->cleanData($data);
		if (isset($data['password'])) {
			$data['password'] = Hash::make($data['password']);
		}
		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$filename = Storage::putFile($this->directory, $file);
			$data['image'] = basename($filename);
		}
		$CourseCategories   = Classes::find($id);
            // $data['updated_by'] = \Auth::id();
		$CourseCategories->update($data);
		$response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.','action'=>'reload');
		echo json_encode($response); return redirect(url('admin/classes'));
	}
        // echo $id = $id; die;
	$data   = array(
		"page_title"=>"Edit ".$this->singular,
		"page_heading"=>"Edit ".$this->singular,
		"breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
		"action"=> url('admin/'.$this->action.'/edit/'.$id),
		"module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key],
		"active_module" => "classes"
	);
	$data['row']      = Classes::find($id)->toArray();
        // $data['list'] = Categories::get()->toArray();

        // echo "<pre>";print_r($data['row']);die;
	return view($this->view.'edit',$data);
}

public function update(Request $request,$id = NULL)
{
	if($request->input('param')){
		$data['is_active'] = $request->input('param');
		$this->cleanData($data);
		$CourseCategories  = Classes::find($id);
		$CourseCategories->update($data);
		$response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.');
		echo json_encode($response); return redirect(url('admin/classes'));
	}

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseCategories  $CourseCategories
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
    	$item = Classes::find($id);
    	$item->delete();
    	$response = array('flag'=>true,'msg'=>$this->singular.' has been deleted.');
    	echo json_encode($response); return redirect(url('admin/classes'));
    }
}
