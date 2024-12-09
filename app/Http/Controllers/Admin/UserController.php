<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
Use Hash;
Use Storage;
class UserController extends Controller
{
   private $type   =  "users";
    private $singular = "User";
    private $plural = "Users";
    private $view = "admin.users.";
    private $db_key   =  "id";
    private $action   =  "user";
    private $perpage   =  10;
    private $directory  =   '\public\images/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function search($records,$request,&$data) 
    {
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
            "active_module" => "users"
        );
        /*
        GET RECORDS
        */
        $records   = new User;
        // $records = $records::with('category');
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
        $records['pagination'] = $links;
        /*
        ASSIGN DATA FOR VIEW
        */
        $data['users']   =   $records;
        // $data['list'] = Categories::get()->toArray();
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
    public function profile(Request $request, $id = NULL){
        $data   = array();
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = Storage::putFile($this->directory, $file);
                $data['profile'] = basename($filename);
            }
            $users   = User::where("id",auth()->user()->id)->update($data);;
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.','action'=>'reload');
            echo json_encode($response);
            return redirect()->back();
        }
        $data   = array(
                    "page_title"=>"Edit ".$this->singular,
                    "page_heading"=>"Edit ".$this->singular,
                    "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
                    "action"=> url('admin/'.$this->action.'/profile/'),
                    "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key]
                );
        $data['row']      = User::where('id', auth()->user()->id)->get();
        return view($this->view.'profile',$data);
    }
    public function create(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);
            $data['password'] = Hash::make('12345678');
            $CourseCategories         = new User;
            $CourseCategories->insert($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is added sucessfully.','action'=>'reload');
            echo json_encode($response); return redirect()->back();
        }
        $data   = array();
        $data   = array(
            "page_title"=>"Add ".$this->singular,
            "page_heading"=>"Add ".$this->singular,
            "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action.'/create'),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key]
        );
        return view($this->view.'create',$data);
    }
    public function edit(Request $request,$id = NULL)
    {
        $data   = array();
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);
            $users   = User::find($id);
            $users->update($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.','action'=>'reload');
            echo json_encode($response);
            return redirect(url('admin/user'));
        }
        $data   = array(
                    "page_title"=>"Edit ".$this->singular,
                    "page_heading"=>"Edit ".$this->singular,
                    "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
                    "action"=> url('admin/'.$this->action.'/edit/'.$id),
                    "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key]
                );
        $data['row']      = User::find($id)->toArray();
        return view($this->view.'edit',$data);
    }
    public function delete($id) {
        $item = User::find($id);
        $item->delete();
        $response = array('flag'=>true,'msg'=>$this->singular.' has been deleted.');
        echo json_encode($response); return redirect()->back();
    }
}
