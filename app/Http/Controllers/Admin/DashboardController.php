<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\GapAnalysis;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Classes;
use App\Models\Categories;
use Auth, Hash, Storage, Excel;
use App\Exports\ArrayExport;

class DashboardController extends Controller
{
    private $directory  =   '/public/images';
    private $perpage   =  10;
    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['active_module'] = "home";
        $data['teachers'] = User::where('role', '2')->get()->count();
        $data['students'] = User::where('role', '3')->get()->count();
        $data['classes'] = Classes::get()->count();
        // Log::info('Dashboard accessed by user: ', ['id' => Auth::id()]);
        // dd($data);
        return view('admin.dashboard', $data);
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
    public function profile(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            $this->cleanData($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Storage::putFile($this->directory, $file);
                $data['image'] = basename($filename);
            }
           // Remove unnecessary fields
            unset($data['confirm_password']);

        // Check if password is not empty before hashing
            if (!empty($data['password'])) {
            // Check if password and confirm_password match
                if ($data['password'] == $data['confirm_password']) {
                    $data['password'] = Hash::make($data['password']);
                } else {
                    $response = array('flag' => false, 'msg' => 'Password does not match.', 'action' => 'reload');
                    echo json_encode($response);
                    return;
                }
            } else {
            // Remove the 'password' field from the update if it's empty
                unset($data['password']);
            }

        // Remove the 'confirm_password' field before updating
            unset($data['confirm_password']);
            User::where("id",auth()->user()->id)->update($data);
            echo json_encode(array("flag"=>true,"msg"=>"Profile updated successfully!","action"=>"reload"));
            return redirect()->back();
        }
        $data['active_module'] = "home";
        return view('admin.profile', $data);
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
        // if(!empty(@$request->search)) {
        //     $params['search'] = $request->search;
        //     $data['search'] = $request->search;
        //     $search = $request->search;
        //     $records = $records->where( function($q) use($search) {
        //         $q->where("course_name","like",'%'.$search.'%')
        //         ->orWhere("course_duration","like",'%'.$search.'%')
        //         ->orWhere("price","like",'%'.$search.'%')
        //         ->orWhere("discount","like",'%'.$search.'%')
        //         ->orWhere("is_feature","like",'%'.$search.'%')
        //         ->orWhere("start_date","like",'%'.$search.'%')
        //         ->orWhere("end_date","like",'%'.$search.'%');
        //     });
        // }
        $total_sales = new OrderItem;
        if(!empty($request->course_id) && $request->course_id !== "all") {
            $params['course_id'] = $request->course_id;
            $data['course_id'] = $request->course_id;
            $records = $records->where("course_id", $request->course_id);
            $total_sales = $total_sales->where("course_id", $request->course_id);
        }
        if(!empty($request->user_id) && $request->user_id !== "all") {
            $params['user_id'] = $request->user_id;
            $data['user_id'] = $request->user_id;
            $records = $records->where("created_by", $request->user_id);
            $total_sales = $total_sales->where("created_by", $request->user_id);
        }
        if(!empty($request->training_type) && $request->training_type !== "all") {
            $params['training_type'] = $request->training_type;
            $data['training_type'] = $request->training_type;
            $records = $records->where("training_type", $request->training_type);
        }
        if(!empty($request->payment_type) && $request->payment_type !== "all") {
            $params['payment_type'] = $request->payment_type;
            $data['payment_type'] = $request->payment_type;
            $payment_type = $request->payment_type;
            $records = $records->whereHas("orders", function($q) use($payment_type) {
                $q->where("payment_type", $payment_type);
            });
            $total_sales = $total_sales->whereHas("orders", function($q) use($payment_type) {
                $q->where("payment_type", $payment_type);
            });
        }
        if(!empty($request->month_year) && $request->month_year !== "all") {
            $params['month_year'] = $request->month_year;
            $data['month_year'] = $request->month_year;
            $month_year = explode("-", $request->month_year);
            $records = $records->whereMonth('created_at', $month_year[1])->whereYear('created_at', $month_year[0]);
            $total_sales = $total_sales->whereMonth('created_at', $month_year[1])->whereYear('created_at', $month_year[0]);
        }
        if(!empty($request->from) && $request->from !== "all") {
            $params['from'] = $request->from;
            $data['from'] = $request->from;
            $records = $records->where("created_at", ">=", $request->from);
            $total_sales = $total_sales->where("created_at", ">=", $request->from);
        }
        if(!empty($request->to) && $request->to !== "all") {
            $params['to'] = $request->to;
            $data['to'] = $request->to;
            $records = $records->where("created_at", "<=", $request->to);
            $total_sales = $total_sales->where("created_at", "<=", $request->to);
        }
        $data["total_sales"] = $total_sales->sum("amount");
        $data['request'] = $params;
        return $records;
    }

    public function course_report(Request $request)
    {
        $data = array();
        $data = array(
            "active_module" => "reports"
        );
        /*
        GET RECORDS
        */
        $records = new OrderItem;
        $records = $records::with('course', 'course.category', 'orders', 'user');
        $records = $this->search($records, $request, $data);
        /*
        GET TOTAL RECORD BEFORE BEFORE PAGINATE
        */

        $data['count'] = $records->count();

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
        $data['Course'] = $records;
        $data['courses'] = Course::all();
        $data['users'] = User::where("role", "3")->get();
        $data['cat_id'] = $request->cat_id;

        return view('admin.reports.course-report', $data);
    }

    public function sales_report(Request $request)
    {
        $data = array();
        $data = array(
            "active_module" => "reports"
        );
        /*
        GET RECORDS
        */
        $records = new OrderItem;
        $records = $records::with('course', 'course.category', 'orders', 'user');
        $records = $this->search($records, $request, $data);
        /*
        GET TOTAL RECORD BEFORE BEFORE PAGINATE
        */

        $data['count'] = $records->count();

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
        $data['Course'] = $records;
        $data['courses'] = Course::all();
        $data['users'] = User::where("role", "3")->get();
        $data['cat_id'] = $request->cat_id;

        return view('admin.reports.sales-report', $data);
    }

    public function download_order_report(Request $request)
    {
        $order_data = OrderItem::with('course', 'course.category', 'orders', 'user');
        if(!empty($request->course_id) && $request->course_id !== "all") {
            $order_data = $order_data->where("course_id", $request->course_id);
        }
        if(!empty($request->user_id) && $request->user_id !== "all") {
            $order_data = $order_data->where("created_by", $request->user_id);
        }
        if(!empty($request->training_type) && $request->training_type !== "all") {
            $order_data = $order_data->where("training_type", $request->training_type);
        }
        if(!empty($request->month_year) && $request->month_year !== "all") {
            $month_year = explode("-", $request->month_year);
            $order_data = $order_data->whereMonth('created_at', $month_year[1])->whereYear('created_at', $month_year[0]);
        }
        if(!empty($request->from) && $request->from !== "all") {
            $order_data = $order_data->where("created_at", ">=", $request->from);
        }
        if(!empty($request->to) && $request->to !== "all") {
            $order_data = $order_data->where("created_at", "<=", $request->to);
        }
        $order_data = $order_data->get();
        $data_array[] = array('#', 'Course Name', 'Training Type', 'User Name', 'Enroll Date', 'Progress');
        foreach($order_data as $key => $order)
        {
            $data_array[] = array(
                '#' => $key + 1,
                'Course Name' => $order->course->course_name,
                'Training Type' => (($order->training_type == "session") ? "One-to-One Session" : "Recorded Training"),
                'User Name' => $order->user->name,
                'Enroll Date' => date("d, M Y", strtotime($order->created_at)),
                'Progress' => $order->progress."%"
            );
        }
        return Excel::download(new ArrayExport($data_array), 'course_report.xlsx');
    }

    public function download_sales_report(Request $request)
    {
        $order_data = OrderItem::with('course', 'course.category', 'orders', 'user');
        if(!empty($request->course_id) && $request->course_id !== "all") {
            $order_data = $order_data->where("course_id", $request->course_id);
        }
        if(!empty($request->user_id) && $request->user_id !== "all") {
            $order_data = $order_data->where("created_by", $request->user_id);
        }
        if(!empty($request->payment_type) && $request->payment_type !== "all") {
            $payment_type = $request->payment_type;
            $order_data = $order_data->whereHas("orders", function($q) use($payment_type) {
                $q->where("payment_type", $payment_type);
            });
        }
        if(!empty($request->month_year) && $request->month_year !== "all") {
            $month_year = explode("-", $request->month_year);
            $order_data = $order_data->whereMonth('created_at', $month_year[1])->whereYear('created_at', $month_year[0]);
        }
        if(!empty($request->from) && $request->from !== "all") {
            $order_data = $order_data->where("created_at", ">=", $request->from);
        }
        if(!empty($request->to) && $request->to !== "all") {
            $order_data = $order_data->where("created_at", "<=", $request->to);
        }
        $order_data = $order_data->get();
        $data_array[] = array('#', 'User Name', 'Course Name', 'Training Type', 'Price', 'Payment Date', 'Payment Method');
        foreach($order_data as $key => $order)
        {
            $data_array[] = array(
                '#' => $key + 1,
                'User Name' => $order->user->name,
                'Course Name' => $order->course->course_name,
                'Training Type' => (($order->training_type == "session") ? "One-to-One Session" : "Recorded Training"),
                'Price' => "$".$order->amount,
                'Payment Date' => date("d, M Y", strtotime($order->created_at)),
                'Payment Method' => (($order->orders->payment_type == "online") ? "Credit Card" : "Paypal")
            );
        }
        return Excel::download(new ArrayExport($data_array), 'sales_report.xlsx');
    }
}
