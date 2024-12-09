<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;
use Auth;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
class DashboardController extends Controller
{
    private $type   =  "instructor";
    private $singular = "Availability";
    private $plural = "Availabilities";
    private $view = "admin.availability.";
    private $db_key   =  "id";
    private $action   =  "instructor.dashboard";
    private $perpage   =  10;
    private $directory  =   '\public\images/';


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
    public function index(){
        return view('admin.dashboard');
    }
    public function availability(Request $request)
    {  
        $data['events'] = Availability::where('user_id', Auth::user()->id)
        ->get(['id', 'start as start', 'end as end', 'title as title'])
        ->toArray();
        return view('instructor.availability.calender', $data);
    }

  public function edit(Request $request, $user_id, $id = NULL)
{
    if ($request->isMethod('post')) {
        // dd($request->event);
        $data['id'] = $request->event['id'];
        $data['title'] = $request->event['title'];
        $data['start'] = date('Y-m-d H:i:s', strtotime($request->event['start']));
        $data['end'] = date('Y-m-d H:i:s', strtotime($request->event['end']));
        $availability = Availability::find($data['id']);
        $this->cleanData($data);
        $data['user_id'] = \Auth::id();
        $availability->update($data);
        $response = array('flag' => true, 'msg' => $this->singular . ' is updated successfully.', 'action' => 'reload');
        return response()->json($response);
    }
     $data   = array();
    $availability = Availability::find($id);

    if (!$availability) {
        $response = array('flag' => false, 'msg' => 'Availability not found.', 'action' => 'error');
        return response()->json($response);
    }
    $data = array(
        "page_title" => "Edit " . $this->singular,
        "page_heading" => "Edit " . $this->singular,
        "breadcrumbs" => array("dashboard" => "Dashboard", "#" => $this->plural . " List"),
        "action" => url('admin/'.$this->action.'/'.$user_id.'/update/'.$id),
        "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'admin/'.$this->action.'/'.$user_id, 'db_key' => $this->db_key]
    );
    $data['row'] = $availability->toArray();
    return view('instructor.availability.calender', $data);
}

    /**
     * Write code on Method
     *
     * @return response()
     */
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
    public function store(Request $request)
    {
        if($request->isMethod('post')){
            $data['title'] = $request->title;
            $data['start'] = date('Y-m-d H:i:s', strtotime($request->start));
            $data['end'] = date('Y-m-d H:i:s', strtotime($request->end));
            $this->cleanData($data);
            $data['user_id'] = Auth::user()->id;

            $Availability = new Availability;
            $Availability->insert($data);
            $records = array('flag'=>true,'msg'=>$this->singular.' is added sucessfully.','action'=>'reload');
            echo json_encode($records); return;
        }
        $data = array(
            "page_title"=>"Add ".$this->singular,
            "page_heading"=>"Add ".$this->singular,
            "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
            "action"=> url('instructor/availability/create'),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>$this->action,'db_key'=>$this->db_key]
        );
        return view('instructor.availability.create',$data);
    }
    public function delete_availability($id) {
        $item = Availability::find($id);
        $item->delete();
        $response = array('flag'=>true,'msg'=>$this->singular.' has been deleted.');
        echo json_encode($response); return;
    }
}
