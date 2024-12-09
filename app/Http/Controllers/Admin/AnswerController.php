<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Question;
use App\Models\Answer;

class AnswerController extends Controller
{
    private $type   =  "answer";
    private $singular = "Answer";
    private $plural = "Answers";
    private $view = "admin.answers.";
    private $db_key   =  "id";
    private $action   =  "answer";
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

    //random number generator
    

    public function index(Request $request, $question_id)
    {
        $data   = array();
        $data   = array(
            "page_title"=>$this->plural." List",
            "page_heading"=>$this->plural.' List',
            "breadcrumbs"=>array("#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action.'/'.$question_id),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key],
            "active_module" => "chapters"
        );
        /*
        GET RECORDS
        */
        $records = new Answer;
        $records   = $records::with('question')->where('question_id', $question_id);
        $records = $this->search($records,$request,$data);
        /*
        GET TOTAL RECORD BEFORE BEFORE PAGINATE
        */

        $data['count'] = $records->count();

        /*
        PAGINATE THE RECORDS
        */
        $records = $records->paginate($this->perpage);
        $records->appends($request->all())->links();
        $links = $records->links();
        $records = $records->toArray();
                    // print_r($records); die;

        $records['pagination'] = $links;

        /*
        ASSIGN DATA FOR VIEW
        */
        $data['Answers'] = $records;
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
    public function create(Request $request, $question_id)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);

            $data['created_by'] = \Auth::id();
            $data['question_id'] = $question_id;
            if (!empty($data["is_correct"])) {
            	Answer::where("question_id", $question_id)->update(["is_correct" => "0"]);
            }
            $Answers = new Answer;
            $Answers->insert($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is added sucessfully.','action'=>'reload');
            echo json_encode($response); return;
        }
        $data = array();
        $data = array(
            "page_title"=>"Add ".$this->singular,
            "page_heading"=>"Add ".$this->singular,
            "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action.'/'.$question_id.'/create'),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action.'/'.$question_id,'db_key'=>$this->db_key]
        );

        return view($this->view.'create',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $Answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $question_id, $id = NULL)
    {
        $data = array();
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);
            if (!empty($data["is_correct"])) {
            	Answer::where("question_id", $question_id)->update(["is_correct" => "0"]);
            }
            $Answer = Answer::find($id);
            // $data['updated_by'] = \Auth::id();
            $Answer->update($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.','action'=>'reload');
            echo json_encode($response); 
            return;
        }
        // echo $id = $id; die;
        $data = array(
                    "page_title"=>"Edit ".$this->singular,
                    "page_heading"=>"Edit ".$this->singular,
                    "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
                    "action"=> url('admin/'.$this->action.'/'.$question_id.'/edit/'.$id),
                    "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action.'/'.$question_id,'db_key'=>$this->db_key]
                );        
        $data['row'] = Answer::find($id)->toArray();
        // echo "<pre>";print_r($data['row']);die;
        return view($this->view.'edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $Answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id = NULL)
    {
        if($request->input('param')){
            $data['is_active'] = $request->input('param');        
            $this->cleanData($data);
            $Answers  = Answer::find($id);
            $Answers->update($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.');
            echo json_encode($response); return;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $Answer
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        $item = Answer::find($id);
        $item->delete();
        $response = array('flag'=>true,'msg'=>$this->singular.' has been deleted.');
        echo json_encode($response); return;
    }
}
