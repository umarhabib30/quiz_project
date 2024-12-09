<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    private $type   =  "question";
    private $singular = "Question";
    private $plural = "Questions";
    private $view = "admin.questions.";
    private $db_key   =  "id";
    private $action   =  "question";
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
    public function index(Request $request, $id)
    {
        $data   = array();
        $data   = array(
            "page_title"=>$this->plural." List",
            "page_heading"=>$this->plural.' List',
            "breadcrumbs"=>array("#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action.'/'.$id),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key],
            "active_module" => "lessons"
        );
        /*
        GET RECORDS
        */
        $records = new Question;
        $records = $records::with('assessment', 'answers')->where('assessment_id', $id);
        $records = $this->search($records,$request,$data);
        /*
        GET TOTAL RECORD BEFORE BEFORE PAGINATE
        */

        $data['count']      = $records->count();

        /*
        PAGINATE THE RECORDS
        */
        $records            = $records->paginate($this->perpage);
        $records->appends($request->all())->links();
        $links = $records->links();
        $records = $records->toArray();
                    // print_r($records); die;

        $records['pagination'] = $links;

        /*
        ASSIGN DATA FOR VIEW
        */
        $data['Questions']   =   $records;
        /*
        DEFAUTL VALUES
        */        
        // dd($data['list']);
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
    public function create(Request $request, $id)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);
            $data['created_by'] = \Auth::id();
            // if(empty($data['top'])){
            //     $data['top'] = 0;
            // }
            //image 
            if ($request->hasFile('image')) {
                $sfile=$request->file('image');
                $sfilename=Storage::putFile('/public/upload',$sfile);
                $data['image']=$sfilename;
            }
            $data['assessment_id'] = $id;
            $Questions = new Question;
            $Questions->insert($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is added sucessfully.','action'=>'reload');
            echo json_encode($response); return;
        }
        $data = array();
        $data = array(
            "page_title"=>"Add ".$this->singular,
            "page_heading"=>"Add ".$this->singular,
            "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action.'/'.$id.'/create'),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action.'/'.$id,'db_key'=>$this->db_key]
        );

        return view($this->view.'create',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $assessment_id, $id = NULL)
    {
        $data   = array();
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);
            //image 
            if ($request->hasFile('image')) {
                $sfile=$request->file('image');
                $sfilename=Storage::putFile('/public/upload',$sfile);
                $data['image']=$sfilename;
            }
            $Questions   = Question::find($id);
            // $data['updated_by'] = \Auth::id();
            $Questions->update($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.','action'=>'reload');
            echo json_encode($response); 
            return;
        }
        // echo $id = $id; die;
        $data = array(
                    "page_title"=>"Edit ".$this->singular,
                    "page_heading"=>"Edit ".$this->singular,
                    "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
                    "action"=> url('admin/'.$this->action.'/'.$assessment_id.'/edit/'.$id),
                    "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action.'/'.$assessment_id,'db_key'=>$this->db_key]
                );
        $data['row'] = Question::find($id)->toArray();
        // echo "<pre>";print_r($data['row']);die;
        return view($this->view.'edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id = NULL)
    {
        if($request->input('param')){
            $data['is_active'] = $request->input('param');        
            $this->cleanData($data);
            $Questions  = Question::find($id);
            $Questions->update($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.');
            echo json_encode($response); return;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        $item = Question::find($id);
        $item->delete();
        $response = array('flag'=>true,'msg'=>$this->singular.' has been deleted.');
        echo json_encode($response); return;
    }
}
