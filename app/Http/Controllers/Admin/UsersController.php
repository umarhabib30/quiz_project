<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Storage;
use Auth;
class UsersController extends Controller
{
    private $type   =  "admins";
    private $singular = "Admin";
    private $plural = "Admins";
    private $view = "admin.users.";
    private $db_key   =  "id";
    private $action   =  "admin/users";
    private $directory  =   '/public/images';
    private $perpage   =  10;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function search($records,$request,&$data) {
        if($request->perpage)
            $this->perpage  =   $request->perpage;
        $data['sindex']     = ($request->page != NULL)?($this->perpage*$request->page - $this->perpage+1):1;
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
        $data = array(
            "page_title" => $this->plural . " List",
            "page_heading" => $this->plural . ' List',
            "breadcrumbs" => array("#" => $this->plural . " List"),
            "action" => url('admin/' . $this->action),
            "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'admin/' . $this->action, 'db_key' => $this->db_key],
            "active_module" => "Admins"
        );

        $records = User::with('creator')
        ->where('role', '1')
        ->orWhere('role', '0');

        $records = $this->search($records, $request, $data);

        $data['count'] = $records->count();
        $records = $records->paginate($this->perpage);
        $data['total'] = $records->total();
        $data['perPage'] = $records->perPage();
        $data['currentPage'] = $records->currentPage();

    // Add pagination links
        $records->appends($request->all());
    $data['Course'] = $records; // Pass Eloquent object directly

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
public function create(Request $request)
{
    if ($request->isMethod('post')) {
        $data = $request->all();
        $this->cleanData($data);

        // Hash password if provided
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Handle file upload for image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Storage::putFile($this->directory, $file);
            $data['image'] = basename($filename);
        }

        // Create a new User instance
        $user = new User();
        $user->fill($data);

        // Set the created_by field to the current user's ID
        $user->created_by = Auth::user()->id;

        // Save the user
        $user->save();

        // Prepare and return the response
        $response = array('flag' => true, 'msg' => $this->singular . ' is created successfully.');
        echo json_encode($response);
        return redirect(url('admin/users'));
    }

    // Render the "create" form view
    $data = [
        "page_title" => "Add " . $this->singular,
        "page_heading" => "Add " . $this->singular,
        "breadcrumbs" => ["dashboard" => "Dashboard", "#" => $this->plural . " List"],
        "action" => url('admin/users/create'),
        "active_module" => "Admins",
        "module" => [
            'type' => $this->type,
            'singular' => $this->singular,
            'plural' => $this->plural,
            'view' => $this->view,
            'action' => 'admin/' . $this->action,
            'db_key' => $this->db_key
        ]
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
        $CourseCategories   = User::find($id);
        $CourseCategories->update($data);
        $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.','action'=>'reload');
        echo json_encode($response); return redirect(url('admin/users'));
    }
    $data   = array(
        "page_title"=>"Edit ".$this->singular,
        "page_heading"=>"Edit ".$this->singular,
        "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
        "action"=> url('admin/users/edit/'.$id),
        "active_module" => "Admins",
        "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key]
    );
    $data['row']      = User::find($id)->toArray();
    return view($this->view.'edit',$data);
}

public function update(Request $request,$id = NULL)
{
    if($request->input('param')){
        $data['is_active'] = $request->input('param');
        $this->cleanData($data);
        $CourseCategories  = User::find($id);
        $CourseCategories->update($data);
        $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.');
        echo json_encode($response); return;
    }

}
public function delete($id) {
    $item = User::find($id);
    $item->delete();
    $response = array('flag'=>true,'msg'=>$this->singular.' has been deleted.');
    echo json_encode($response); return redirect(url('admin/users'));
}
}
