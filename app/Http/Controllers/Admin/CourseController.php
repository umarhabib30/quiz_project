<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Course;
use App\Models\Topics;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Support\Facades\Storage;
use Image;

class CourseController extends Controller
{
    private $type   =  "courses";
    private $singular = "Course";
    private $plural = "Courses";
    private $view = "admin.courses.";
    private $db_key   =  "id";
    private $action   =  "course";
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
        if(!empty(@$request->search)) {
            $params['search'] = $request->search;
            $data['search'] = $request->search;
            $search = $request->search;
            $records = $records->where( function($q) use($search) {
                $q->where("course_name","like",'%'.$search.'%')
                ->orWhere("course_duration","like",'%'.$search.'%')
                ->orWhere("price","like",'%'.$search.'%')
                ->orWhere("discount","like",'%'.$search.'%')
                ->orWhere("is_feature","like",'%'.$search.'%')
                ->orWhere("start_date","like",'%'.$search.'%')
                ->orWhere("end_date","like",'%'.$search.'%');
            });
        }
        if(!empty(@$request->is_feature)) {
            // dd('asd');
            $params['is_feature'] = $request->is_feature;
            $data['is_feature'] = $request->is_feature;
            $records = $records->where("is_feature","like",'%'.$params['is_feature'].'%');
        }
        if(!empty(@$request->cat_id)) {
            // dd('asd');
            $params['cat_id'] = $request->cat_id;
            $data['cat_id'] = $request->cat_id;
            $records = $records->where("cat_id",$params['cat_id']);
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
            "active_module" => "courses"
        );
        /*
        GET RECORDS
        */
        $records   = new Course;
        $records = $records::with('category', 'lessons', 'chapters');
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
        $data['Course']   =   $records;
        $data['list'] = Categories::get()->toArray();
        $data['cat_id'] = $request->cat_id;



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
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);
            $data['created_by'] = \Auth::id();
            //image
            if ($request->hasFile('featured_img')) {
                $sfile=$request->file('featured_img');
                $sfilename=Storage::putFile('/public/upload',$sfile);

                $imagePath = "storage/upload/".basename($sfilename);
                $img = Image::make($imagePath);

                $img->fit(370, 250);
                $img->save('storage/upload/370x250-'.basename($sfilename));

                $img->fit(298, 200);
                $img->save('storage/upload/298x200-'.basename($sfilename));

                $img->fit(270, 200);
                $img->save('storage/upload/270x200-'.basename($sfilename));

                $img->fit(198, 200);
                $img->save('storage/upload/198x200-'.basename($sfilename));

                $img->fit(110, 110);
                $img->save('storage/upload/110x110-'.basename($sfilename));

                $data['featured_img']=basename($sfilename);
            }

            if ($request->hasFile('certification')) {
                $sfile=$request->file('certification');
                $sfilename=Storage::putFile('/public/certificate',$sfile);

                $data['certification']=basename($sfilename);
            }

            $CourseCategories         = new Course;
            $CourseCategories->insert($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is added sucessfully.','action'=>'reload');
            echo json_encode($response); return;
        }
        $data   = array();
        $data   = array(
            "page_title"=>"Add ".$this->singular,
            "page_heading"=>"Add ".$this->singular,
            "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action.'/create'),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key],
            "active_module" => "courses"
        );
        $data['list'] = Categories::get()->toArray();
        $data['instructors'] = User::where("role", "1")->orWhere("role", "2")->get();

        return view($this->view.'create',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseCategories  $CourseCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id = NULL)
    {
        $data   = array();
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);
            //image
            if ($request->hasFile('featured_img')) {
                $sfile=$request->file('featured_img');
                $sfilename=Storage::putFile('/public/upload',$sfile);

                $imagePath = "storage/upload/".basename($sfilename);
                $img = Image::make($imagePath);

                $img->fit(370, 250);
                $img->save('storage/upload/370x250-'.basename($sfilename));

                $img->fit(298, 200);
                $img->save('storage/upload/298x200-'.basename($sfilename));

                $img->fit(270, 200);
                $img->save('storage/upload/270x200-'.basename($sfilename));

                $img->fit(198, 200);
                $img->save('storage/upload/198x200-'.basename($sfilename));

                $img->fit(110, 110);
                $img->save('storage/upload/110x110-'.basename($sfilename));

                $data['featured_img']=basename($sfilename);
            }
            if ($request->hasFile('certification')) {
                $sfile=$request->file('certification');
                $sfilename=Storage::putFile('/public/certificate',$sfile);

                $data['certification']=basename($sfilename);
            }
            $CourseCategories   = Course::find($id);
            // $data['updated_by'] = \Auth::id();
            $CourseCategories->update($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.','action'=>'reload');
            echo json_encode($response);
            return;
        }
        // echo $id = $id; die;
        $data   = array(
            "page_title"=>"Edit ".$this->singular,
            "page_heading"=>"Edit ".$this->singular,
            "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action.'/edit/'.$id),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key],
            "active_module" => "courses"
        );
        $data['row'] = Course::find($id)->toArray();
        $data['list'] = Categories::get()->toArray();
        $data['instructors'] = User::where("role", "1")->orWhere("role", "2")->get();

        // echo "<pre>";print_r($data['row']);die;
        return view($this->view.'edit',$data);
    }

    public function create_step2(Request $request,$id = NULL)
    {
        $data   = array();
        if($request->isMethod('post')){
            $data = $request->all();
            if (!empty($data['topic_id'])) {
                $course_id = $data['course_id'];
                $this->cleanData($data);
                $topic_id = $data['topic_id'];
                unset($data['topic_id']);
                //image
                if ($request->hasFile('video_url')) {
                    $sfile=$request->file('video_url');
                    $sfilename=Storage::putFile('/public/upload',$sfile);
                    $data['video_url']=$sfilename;
                }
                $Topics         = Topics::find($topic_id);
                $Topics->update($data);
                $response = array('flag'=>true,'msg'=>'Training is updated sucessfully.','action'=>'redirect','url'=>url('admin/course/create-step2/'.$course_id));
                echo json_encode($response);
                return;
            }else{

                $course_id = $data['course_id'];
                $this->cleanData($data);
                //image
                if ($request->hasFile('video_url')) {
                    $sfile=$request->file('video_url');
                    $sfilename=Storage::putFile('/public/upload',$sfile);
                    $data['video_url']=$sfilename;
                }
                $data['created_by'] = \Auth::id();
                $Topics         = new Topics;
                $Topics->insert($data);
                $response = array('flag'=>true,'msg'=>'Training is Created sucessfully.','action'=>'redirect','url'=>url('admin/course/create-step2/'.$course_id));
                echo json_encode($response);
                return;
            }
        }
        $data['row']      = Course::find($id)->toArray();
        $data['topics']      = Topics::where("course_id",$id)->get();
        $data['list'] = Categories::get()->toArray();
        $data['active_module'] = "course";

        // echo "<pre>";print_r($data['row']);die;
        return view('admin.courses.course_step2',$data);
    }


    public function create_step3(Request $request,$id = NULL)
    {
        $data   = array();
        if($request->isMethod('post')){
            $data = $request->all();
            if (!empty($data['topic_id'])) {
                $course_id = $data['course_id'];
                $this->cleanData($data);
                $topic_id = $data['topic_id'];
                unset($data['topic_id']);
                //image
                if ($request->hasFile('video_url')) {
                    $sfile=$request->file('video_url');
                    $sfilename=Storage::putFile('/public/upload',$sfile);
                    $data['video_url']=$sfilename;
                }
                $Quiz         = Quiz::find($topic_id);
                $Quiz->update($data);
                $response = array('flag'=>true,'msg'=>'Training is updated sucessfully.','action'=>'redirect','url'=>url('admin/course/create-step3/'.$course_id));
                echo json_encode($response);
                return;
            }else{

                $course_id = $data['course_id'];
                $this->cleanData($data);
                //image
                if ($request->hasFile('video_url')) {
                    $sfile=$request->file('video_url');
                    $sfilename=Storage::putFile('/public/upload',$sfile);
                    $data['video_url']=$sfilename;
                }
                $data['created_by'] = \Auth::id();
                $Quiz         = new Quiz;
                $Quiz->insert($data);
                $response = array('flag'=>true,'msg'=>'Training is Created sucessfully.','action'=>'redirect','url'=>url('admin/course/create-step3/'.$course_id));
                echo json_encode($response);
                return;
            }
        }
        $data['row']      = Course::find($id)->toArray();
        $data['topics']      = Topics::where("course_id",$id)->get();
        $data['list'] = Categories::get()->toArray();
        $data['active_module'] = "course";

        // echo "<pre>";print_r($data['row']);die;
        return view('admin.courses.create_step3',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseCategories  $CourseCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id = NULL)
    {
        if($request->input('param')){
            $data['is_active'] = $request->input('param');
            $this->cleanData($data);
            $CourseCategories  = Course::find($id);
            $CourseCategories->update($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.');
            echo json_encode($response); return;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseCategories  $CourseCategories
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        $item = Course::find($id);
        $item->delete();
        $response = array('flag'=>true,'msg'=>$this->singular.' has been deleted.');
        echo json_encode($response); return redirect(url('admin/course'));
    }
}
