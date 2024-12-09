<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\OrderItem;
use App\Models\Reviews;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Chapter;
use App\Models\Assessment;
use App\Models\GapAnalysis;
use App\Models\AssessmentAttempt;
use App\Models\AnalysisAttempt;
use App\Models\AssessmentResult;
use App\Models\AnalysisResult;
use App\Models\AssessmentResultDetail;
use App\Models\AnalysisResultDetail;
use App\Models\Answer;
use App\Models\GapAnswer;
use App\Models\CourseProgress;
use App\Models\GapQuestion;
use App\Models\Competency;
use App\Models\UserMeeting;
use App\Models\MeetingEntry;
use App\Models\Availability;
use App\Models\TemporarySavedAnswer;
use App\Events\SendNotification;
use Auth, Hash;
use Stripe;
use Session;
use PDF;
use Illuminate\Support\Facades\Storage;
use ZEGO\ZegoServerAssistant;
use ZEGO\ZegoErrorCodes;

class DashboardController extends Controller
{
    private $directory = '/public/images';
    private $type   =  "ratings";
    private $singular = "Review";
    private $plural = "Reviews";
    private $view = "student.reviews.";
    private $db_key   =  "id";
    private $action   =  "rating";
    private $perpage   =  10;
    /**
     * Show the application Student dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     $order_counter= 0;
    //     $orders = Order::with('orderitems.course')->where("created_by",Auth::user()->id)->orderBy("id","desc")->get();
    //     foreach ($orders as $key => $order) {
    //         foreach ($order->orderitems as $key => $orderitem) {
    //             $order_counter++;
    //         }
    //     }
    //     $data = [
    //         "page_title"=>"Dashboard",
    //         "order_counter"=>$order_counter,
    //     ];
    //     return view('student.dashboard',$data);
    // }

    public function index()
    {
        $order_counter = 0;
        $orders = Order::with('orderitems.course')->where("created_by", Auth::user()->id)->orderBy("id", "desc")->get();
        $orderitems = OrderItem::with('course')->where("created_by", Auth::user()->id)->orderBy("id", "desc")->get()->toArray();

        $order_dash = OrderItem::with('course')->whereHas("course")->where("training_type", "recorded_training")->where("created_by", Auth::user()->id)->orderBy("id", "desc")->take(3)->get();
        $orderitems_count = OrderItem::with("course")->whereHas("course")->where("training_type", "recorded_training")->where("created_by", Auth::user()->id)->count();

        $session = OrderItem::with("course")->whereHas("course")->where("training_type", "session")->where("created_by", Auth::user()->id)->take(3)->get();
        $session_count = OrderItem::with("course")->whereHas("course")->where("training_type", "session")->where("created_by", Auth::user()->id)->count();

        $wishlist = Wishlist::with('course')->whereHas('course')->where("user_id", Auth::user()->id)->orderBy("id", "desc")->take(3)->get();
        $wishlist_count = Wishlist::with('course')->whereHas('course')->where("user_id", Auth::user()->id)->count();

        $gap_analysis = Order::with('GapAnalysis')->where('created_by', Auth::user()->id)->whereNotNull('gap_analysis_id')->orderBy("id", "desc")->get();
        $gap_analysis_count = Order::where('created_by', Auth::user()->id)->whereNotNull('gap_analysis_id')->orderBy("id", "desc")->count();
        // dd($gap_analysis_count);
        // Fetch all courses associated with the orders
        $courses = Course::whereIn('id', $orders->pluck('orderitems.course.id')->unique())->get();
        $data = [
            "page_title" => "Dashboard",
            "order_counter" => $order_counter,
            "courses" => $courses,
            "wishlist" => $wishlist,
            "orders" => $orders,
            "orderitems" => $orderitems,
            "wishlist_count" => $wishlist_count,
            "orderitems_count" => $orderitems_count,
            "session_count" => $session_count,
            "order_dash" => $order_dash,
            "session" => $session,
            "gap_analysis" => $gap_analysis,
            "gap_analysis_count" => $gap_analysis_count,
        ];
        return view('student.dashboard', $data);
    }

    public function courses()
    {
        $order_counter = 0;
        $orders = Order::with('orderitems.course')->whereHas("orderitems", function ($q) {
            $q->where("training_type", "recorded_training");
        })->where("created_by", Auth::user()->id)->orderBy("id", "desc")->get();
        $orderitems = OrderItem::with('course')->where("training_type", "recorded_training")->where("created_by", Auth::user()->id)->orderBy("id", "desc")->get();

        // Fetch all courses associated with the orders
        $courses = Course::whereIn('id', $orders->pluck('orderitems.course.id')->unique())->get();

        $data = [
            "page_title" => "Dashboard",
            "order_counter" => $order_counter,
            "courses" => $courses, // Pass the courses to the view
            "orders" => $orders, // Pass the courses to the view
            "orderitems" => $orderitems, // Pass the courses to the view
        ];
        // dd($data);

        return view('student.courses', $data);
    }

    public function live_sessions()
    {
        $order_counter = 0;
        $orders = Order::with('orderitems', 'orderitems.course')->whereHas("orderitems", function ($q) {
            $q->where("training_type", "session");
        })->where("created_by", Auth::user()->id)->orderBy("id", "desc")->get();
        $orderitems = OrderItem::with('course')->where("training_type", "session")->where("created_by", Auth::user()->id)->orderBy("id", "desc")->get();

        // Fetch all courses associated with the orders
        $courses = Course::whereIn('id', $orders->pluck('orderitems.course.id')->unique())->get();

        $data = [
            "page_title" => "Dashboard",
            "order_counter" => $order_counter,
            "courses" => $courses, // Pass the courses to the view
            "orders" => $orders, // Pass the courses to the view
            "orderitems" => $orderitems, // Pass the courses to the view
        ];
        // dd($data);

        return view('student.live-sessions', $data);
    }

    public function book_session(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $orderitem = OrderItem::where("id", $id)->first();

            if (!empty($orderitem)) {
                OrderItem::where("id", $id)->update([
                    "date" => $data['date'],
                    "start_time" => $data['start_time'],
                    "end_time" => $data['end_time'],
                    "attempted_sessions" => (int)$orderitem->attempted_sessions + 1
                ]);
            }

            return redirect(url("user/live-sessions"));
        }
        $orderitem = OrderItem::with('course')->where('id', $id)->first();
        if (!empty($orderitem)) {
            $all_dates = Availability::where("user_id", $orderitem->course->instructor_id)->get();
            $dates = [];
            foreach ($all_dates as $key => $value) {
                array_push($dates, $value->date);
            }
            $data = [
                "orderitem" => $orderitem,
                "dates" => $dates
            ];

            return view('student.book-session', $data);
        } else {
            return redirect(url('user/dashboard'));
        }
    }

    public function gap_analysis()
    {
        $gap_analysis['leader'] = Order::where("gap_analysis_id", '1')->where("type", "leader")->where("created_by", Auth::user()->id)->first();
        $gap_analysis['medical_rep'] = Order::where("gap_analysis_id", '1')->where("type", "medical_rep")->where("created_by", Auth::user()->id)->first();

        if (!empty($gap_analysis['leader'])) {
            $gap_analysis['leader']->analysis_result = AnalysisResult::orderBy('id', 'DESC')->with("analysis")->whereHas("analysis", function ($q){
                $q->where("type", "leader");
            })->where("analysis_id", @$gap_analysis['leader']->id)->first();
            $gap_analysis['leader']->total_questions = GapQuestion::with("competency")->whereHas("competency", function ($q) {
                $q->where("type", "leader");
            })->where("status", "1")->count();
        }

        if (!empty($gap_analysis['medical_rep'])) {
            $gap_analysis['medical_rep']->analysis_result = AnalysisResult::orderBy('id', 'DESC')->with("analysis")->whereHas("analysis", function ($q){
                $q->where("type", "medical_rep");
            })->where("analysis_id", @$gap_analysis['medical_rep']->id)->first();
            $gap_analysis['medical_rep']->total_questions = GapQuestion::with("competency")->whereHas("competency", function ($q) {
                $q->where("type", "medical_rep");
            })->where("status", "1")->count();
        }

        $gap = GapAnalysis::first();
        if (empty($gap)) {
            $time_duration = 0;
        } else {
            $time_duration = $gap->time_duration;
        }

        $data = [
            "page_title" => "Dashboard",
            "gap_analysis" => $gap_analysis,
            "time_duration" => $time_duration,
        ];

        return view('student.gapanalysis',$data);
    }

    public function course_detail(Request $request, $id)
    {
        if (OrderItem::where("course_id", $id)->where("created_by", \Auth::id())->count() == 0) {
            return redirect(url('user/dashboard'));
        }

        $active = $request->active;

        $courses = Course::where('id', $id)->first();
        if (!empty($active)) {
            $chapter = Chapter::where("id", $active)->first();
            $lesson = Lesson::where("id", @$chapter->lesson_id)->first();
            $courses->lesson = $lesson;
            $courses->chapter = $chapter;
        } else {
            $chapter = Chapter::where("course_id", $id)->first();
            $lesson = Lesson::where("id", @$chapter->lesson_id)->first();
            $courses->lesson = $lesson;
            $courses->chapter = $chapter;
        }
        $order_item = OrderItem::where("course_id", $id)->where("created_by", \Auth::id())->first();
        $order_item->assessment_result = AssessmentResult::orderBy("id", "DESC")->where("course_id", $id)->where("user_id", \Auth::id())->first();

        foreach ($courses->lessons as $key => $value) {
            foreach ($value->chapters as $k => $v) {
                $duration = $v->duration;
                $check_watch_time = CourseProgress::where("chapter_id", $v->id)->where("user_id", \Auth::id())->first();
                $v->is_viewed = "0";
                if (!empty($check_watch_time)) {
                    if ($check_watch_time->watch_time >= $duration) {
                        $v->is_viewed = "1";
                    }
                }
            }
        }

        $user = Auth::user();

        $progressData = CourseProgress::where('user_id', $user->id)->where('chapter_id', @$chapter->id)->first();

        $data = [
            "page_title" => "Dashboard",
            "course" => $courses,
            "order_item" => $order_item,
            "progressData" => $progressData ?? 0
        ];

        return view('student.course_detail', $data);
    }

    public function watch_time(Request $request)
    {
        $data = $request->all();

        $check = CourseProgress::where("course_id", $data['course_id'])->where("chapter_id", $data['chapter_id'])->where("user_id", \Auth::id())->first();
        if (!empty($check)) {
            $watch_time = $check->watch_time;
            if ($data['watch_time'] >= $check->watch_time) {
                CourseProgress::where("course_id", $data['course_id'])->where("chapter_id", $data['chapter_id'])->where("user_id", \Auth::id())->update(["watch_time" => (int)$data['watch_time'], "percent_watched" => (int)$data['percent_watched']]);

                $progress = 0;
                $course_progress = CourseProgress::where("course_id", $data['course_id'])->where("user_id", \Auth::id())->get();
                foreach ($course_progress as $k => $v) {
                    if ($v->watch_time > 0) {
                        $watch_time = $v->watch_time;
                        $all_watch_time = Chapter::where("course_id", $data['course_id'])->sum('duration');
                        if ($all_watch_time > 0) {
                            $latest_progress = ((int)$watch_time / (int)$all_watch_time) * 100;
                            $progress += $latest_progress;
                        }
                    }
                }
                if ($progress <= 100) {
                    OrderItem::where("course_id", $data['course_id'])->where("training_type", "recorded_training")->where("created_by", \Auth::id())->update(["progress" => round($progress)]);
                }
            }
        } else {
            $progress = new CourseProgress;
            $progress->course_id = $data['course_id'];
            $progress->chapter_id = $data['chapter_id'];
            $progress->user_id = \Auth::id();
            $progress->watch_time = (int)$data['watch_time'];
            $progress->percent_watched = (int)$data['percent_watched'];
            $progress->save();
        }

        if (!empty(@$data['next_chapter'])) {
            return json_encode(["flag"=>true, "msg"=>"Watch time added successfully!", "redirect"=>url("user/course-details/".$data['course_id']."?active=".$data['next_chapter'])]);
        } else if (@$data['next_chapter'] == "0") {
            return json_encode(["flag"=>true, "msg"=>"Watch time added successfully!", "redirect"=>url("user/course-details/".$data['course_id']."?active=".$data['chapter_id'])]);
        }

        return json_encode(["flag"=>true, "msg"=>"Watch time added successfully!"]);
    }

    public function start_assessment(Request $request, $id)
    {
        $course = Course::where('id', $id)->first();
        $assessment = Assessment::with('questions')->where('course_id', $id)->first();
        if (!empty($assessment)) {
            $data['total_questions'] = 0;
            if (!empty(@$assessment->questions)) {
                $data['total_questions'] = count($assessment->questions);
            }
            $data['time_duration'] = $assessment->time_duration;
            $data['passing_percentage'] = $assessment->passing_percentage;
        } else {
            $data['total_questions'] = 0;
            $data['time_duration'] = 0;
            $data['passing_percentage'] = 0;
        }
        $data['course'] = $course;

        return view('student.start_assessment', $data);
    }

    public function start_analysis(Request $request, $id)
    {
        $course = Course::where('id', $id)->first();
        $analysis = GapAnalysis::with('questions')->where('course_id', $id)->first();
        $data['total_questions'] = 0;
        if (!empty(@$analysis->questions)) {
            $data['total_questions'] = count($analysis->questions);
        }
        $data['time_duration'] = $analysis->time_duration;
        $data['passing_percentage'] = $analysis->passing_percentage;
        $data['course'] = $course;

        return view('student.start_analysis', $data);
    }

    public function save_answer(Request $request)
    {
        TemporarySavedAnswer::updateOrCreate([
            'user_id' => $request->user_id,
            'question_id' => $request->question_id
        ], [
            'user_id' => $request->user_id,
            'question_id' => $request->question_id,
            'answer_id' => $request->answer_id
        ]);

        return json_encode(["flag" => true]);
    }

    public function download_certificate(Request $request, $id)
    {
        $data['result'] = AssessmentResult::with('course', 'user')->where("id", $id)->first();

        $pdf = PDF::loadView('student.certificate', $data);

        if ($data['result']->course->cpd_certificate == "No") {
            $pdf = $pdf->setPaper('a4', 'landscape');
        }

        return $pdf->download('certificate.pdf');
    }

    public function detail_result(Request $request, $id)
    {
        $data['result'] = AnalysisResult::with('analysis_result_details', 'analysis')->where("id", $id)->first();

        $data['competencies'] = Competency::with('category_competency', 'course', 'questions')->where("type", $data['result']->analysis->type)->get();
        $recommendations = [];
        foreach ($data['competencies'] as $key => $value) {
            $correct_answers = AnalysisResultDetail::where("competency_id", $value->id)->where("analysis_result_id", $id)->where("is_correct", '1')->count();

            $percentage = ($correct_answers / count($value->questions)) * 100;
            $value->percentage = $percentage;

            if ($percentage <= $value->passing_percentage) {
                if ($value->category_competency->title == "Communication Skills") {
                    array_push($recommendations, $value->id);
                }
            }
        }

        if (count($recommendations) == 2) {
            $course = Course::where("course_name", "Assertive selling skills")->first();
            if (!empty($course)) {
                foreach ($data['competencies'] as $key => $value) {
                    if ($value->category_competency->title == "Communication Skills") {
                        $value->course = $course;
                    }
                }
            }
        }

        $pdf = PDF::loadView('student.result', $data);

        return $pdf->download('result.pdf');
    }

    public function assessment(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $assessment = Assessment::where('id', $id)->first();

            $assessment_result = new AssessmentResult;
            $assessment_result->assessment_id = $id;
            $assessment_result->course_id = $assessment->course_id;
            $assessment_result->user_id = \Auth::id();
            $assessment_result->save();

            $correct = 0;
            $wrong = 0;
            $unanswered = 0;
            foreach ($request->questions as $key => $value) {
                if (!empty($data['answer_'.$value])) {
                    $correct_answer = Answer::where("question_id", $value)->where("is_correct", "1")->first();

                    if (@$correct_answer->id == $data['answer_'.$value]) {
                        $is_correct = "1";
                        $correct = $correct + 1;
                    } else {
                        $is_correct = "0";
                        $wrong = $wrong + 1;
                    }

                    $assessment_result_detail = new AssessmentResultDetail;
                    $assessment_result_detail->assessment_result_id = $assessment_result->id;
                    $assessment_result_detail->question_id = $value;
                    $assessment_result_detail->answer_id = $data['answer_'.$value];
                    $assessment_result_detail->is_correct = $is_correct;
                    $assessment_result_detail->save();
                } else {
                    $unanswered = $unanswered + 1;

                    $assessment_result_detail = new AssessmentResultDetail;
                    $assessment_result_detail->assessment_result_id = $assessment_result->id;
                    $assessment_result_detail->question_id = $value;
                    $assessment_result_detail->answer_id = "0";
                    $assessment_result_detail->is_correct = "0";
                    $assessment_result_detail->save();
                }
            }

            $percentage = ($correct / count($request->questions)) * 100;
            if ($percentage >= $assessment->passing_percentage) {
                $status = "Pass";
            } else {
                $status = "Fail";
            }

            AssessmentResult::where("id", $assessment_result->id)->update([
                "total_questions" => count($request->questions),
                "total_correct" => $correct,
                "total_wrong" => $wrong,
                "total_unanswered" => $unanswered,
                "status" => $status,
            ]);

            return redirect(url("user/assessment-result", $assessment_result->id));
        }
        $course = Course::where('id', $id)->first();
        $assessment = Assessment::with('questions', 'questions.answers')->where('course_id', $id)->first();
        $data = [
            "page_title" => "Dashboard",
            "course" => $course,
            "assessment" => $assessment
        ];

        if (!Session::has("assessment_attempt_id")) {
            $assessment_attempt = new AssessmentAttempt;
            $assessment_attempt->assessment_id = $assessment->id;
            $assessment_attempt->course_id = $id;
            $assessment_attempt->user_id = \Auth::id();
            $assessment_attempt->save();

            Session::put("assessment_attempt_id", $assessment_attempt->id);
        } else {
            $attempt_id = Session::get('assessment_attempt_id');

            $assessment_attempt = AssessmentAttempt::where("id", $attempt_id)->first();
            if (!empty($assessment_attempt) && $id == $assessment_attempt->course_id) {
                $start_date = new \DateTime($assessment_attempt->created_at);
                $since_start = $start_date->diff(new \DateTime(date("Y-m-d H:i:s")));
                $minutes = $since_start->i;
                $assessment->time_duration = (int)$assessment->time_duration - (float)$minutes;
                // dd($assessment->time_duration);

                if ($assessment->time_duration < 0) {
                    Session::forget('assessment_attempt_id');
                }
            }
        }

        return view('student.assessment', $data);
    }

    public function analysis(Request $request, $id = NULL)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            TemporarySavedAnswer::where("user_id", \Auth::user()->id)->delete();

            $analysis = GapAnalysis::first();

            $analysis_result = new AnalysisResult;
            $analysis_result->analysis_id = $id;
            $analysis_result->user_id = \Auth::id();
            $analysis_result->save();

            $correct = 0;
            $wrong = 0;
            $unanswered = 0;
            $competencies = [];
            foreach ($request->questions as $key => $value) {
                // dd($data['answer_'.$value]);
                $gap_analysis = GapQuestion::where("id", $value)->first();
                if (empty($competencies[$gap_analysis->competency_id])) {
                    $competencies[$gap_analysis->competency_id] = 0;
                }
                if (!empty($data['answer_'.$value])) {
                    $correct_answer = GapAnswer::where("question_id", $value)->where("is_correct", "1")->first();

                    if (@$correct_answer->id == $data['answer_'.$value]) {
                        $is_correct = "1";
                        $correct = $correct + 1;
                        if (!empty($competencies[$gap_analysis->competency_id]) || $competencies[$gap_analysis->competency_id] == 0) {
                            $competencies[$gap_analysis->competency_id] = $competencies[$gap_analysis->competency_id] + 1;
                        }
                    } else {
                        $is_correct = "0";
                        $wrong = $wrong + 1;
                    }

                    $analysis_result_detail = new AnalysisResultDetail;
                    $analysis_result_detail->analysis_result_id = $analysis_result->id;
                    $analysis_result_detail->question_id = $value;
                    $analysis_result_detail->competency_id = $gap_analysis->competency_id;
                    $analysis_result_detail->answer_id = $data['answer_'.$value];
                    $analysis_result_detail->is_correct = $is_correct;
                    $analysis_result_detail->save();
                } else {
                    $unanswered = $unanswered + 1;

                    $analysis_result_detail = new AnalysisResultDetail;
                    $analysis_result_detail->analysis_result_id = $analysis_result->id;
                    $analysis_result_detail->question_id = $value;
                    $analysis_result_detail->competency_id = $gap_analysis->competency_id;
                    $analysis_result_detail->answer_id = "0";
                    $analysis_result_detail->is_correct = "0";
                    $analysis_result_detail->save();
                }
            }

            $recommendations = [];
            $other_recommendations = [];
            foreach ($competencies as $key => $value) {
                $competency = Competency::with('category_competency', 'questions')->where("id", $key)->first();

                $percentage = ($value / count($competency->questions)) * 100;
                if ($percentage < $competency->passing_percentage) {
                    if ($competency->category_competency->title == "Communication Skills") {
                        array_push($other_recommendations, $competency->course_id);
                    } else {
                        array_push($recommendations, $competency->course_id);
                    }
                }
            }

            if (count($other_recommendations) == 2) {
                $course = Course::where("course_name", "Assertive selling skills")->first();
                if (!empty($course)) {
                    array_push($recommendations, $course->id);
                }
            } else {
                foreach ($other_recommendations as $key => $value) {
                    array_push($recommendations, $value);
                }
            }

            AnalysisResult::where("id", $analysis_result->id)->update([
                "total_questions" => count($request->questions),
                "total_correct" => $correct,
                "total_wrong" => $wrong,
                "total_unanswered" => $unanswered,
                "recommendations" => json_encode($recommendations)
            ]);

            return redirect(url("user/analysis-result", $analysis_result->id));
        }
        $check = Order::where("gap_analysis_id", '1')->where("type", @$request->type)->where("created_by", Auth::user()->id)->first();
        if (empty($check)) {
            return redirect(url('user/dashboard'));
        }
        if (!empty($request->start)) {
            TemporarySavedAnswer::where("user_id", \Auth::user()->id)->delete();
            return redirect(url('user/analysis?type='.@$request->type));
        }
        $analysis = GapAnalysis::first();

        $questions = GapQuestion::with("competency", "answers")->whereHas("competency", function ($q) use($check) {
            $q->where("type", @$check->type);
        })->where("status", '1')->get();

        if (!Session::has("analysis_attempt_id")) {
            $analysis_attempt = new AnalysisAttempt;
            $analysis_attempt->user_id = \Auth::id();
            $analysis_attempt->save();

            Session::put("analysis_attempt_id", $analysis_attempt->id);
        } else {
            $attempt_id = Session::get('analysis_attempt_id');

            $analysis_attempt = AnalysisAttempt::orderBy("id", "DESC")->where("id", $attempt_id)->first();
            if (!empty($analysis_attempt)) {
                $start_date = new \DateTime($analysis_attempt->created_at);
                $since_start = $start_date->diff(new \DateTime(date("Y-m-d H:i:s")));
                $minutes = $since_start->i;
                if (((int)$analysis->time_duration - (float)$minutes) < 0) {
                    $analysis_attempt = new AnalysisAttempt;
                    $analysis_attempt->user_id = \Auth::id();
                    $analysis_attempt->save();

                    Session::put("analysis_attempt_id", $analysis_attempt->id);
                } else {
                    $analysis->time_duration = (int)$analysis->time_duration - (float)$minutes;
                }

                if ($analysis->time_duration < 0) {
                    Session::forget('analysis_attempt_id');
                }
            }
        }
        $saved_answers = TemporarySavedAnswer::where("user_id", \Auth::user()->id)->get();

        $data = [
            "page_title" => "Dashboard",
            "analysis" => $analysis,
            "questions" => $questions,
            "gap_analysis" => $check,
            "saved_answers" => $saved_answers
        ];

        return view('student.analysis', $data);
    }

    // public function training(Request $request, $id)
    // {
    //     $orderItem = OrderItem::where("id", $id)->first();

    //     $meeting = Auth::user()->getUserMeetingInfo()->first();
    //     $name = 'agora'.rand(1111, 9999);
    //     if (!isset($meeting->id)) {
    //         $meetingData = createAgoraProject($name);

    //         if (isset($meetingData->project->id)) {
    //             $meeting = new UserMeeting;
    //             $meeting->user_id = Auth::user()->id;
    //             $meeting->app_id = $meetingData->project->vendor_key;
    //             $meeting->appCertificate = $meetingData->project->sign_key;
    //             $meeting->channel = $meetingData->project->name;
    //             $meeting->uid = rand(11111, 99999);
    //             $meeting->in_meeting = '1';
    //             $meeting->save();
    //         } else {
    //             echo "Project not created";
    //         }
    //     } else {
    //         UserMeeting::where("id", $meeting->id)->update(['in_meeting' => '1']);
    //     }
    //     $meeting = Auth::user()->getUserMeetingInfo()->first();
    //     $token = createToken($meeting->app_id, $meeting->appCertificate, $meeting->channel);
    //     $meeting->token = $token;
    //     $meeting->url = $orderItem->meeting_url;
    //     $meeting->event = generateRandomString(5);
    //     $meeting->save();

    //     if (Auth::user()->id == $meeting->user_id) {
    //         Session::put('meeting', $meeting->url);
    //     }

    //     return redirect('join-training/'.$orderItem->course_id.'/'.$orderItem->meeting_url);
    // }

    public function training(Request $request, $id)
    {
        $id = base64_decode($id);
        if (@\Auth::user()->role !== '1') {
            $check = OrderItem::where("id", $id)->where("created_by", \Auth::user()->id)->count();
            if ($check == 0) {
                return redirect(url('user/dashboard'));
            }
        }

            // $orderItem = OrderItem::where("id", $id)->first();
            // if (date("Y-m-d", strtotime(@$orderItem['date'])).' '.@$orderItem['start_time'] <= date("Y-m-d H:i:s") && date("Y-m-d", strtotime(@$orderItem['date'])).' '.@$orderItem['end_time'] >= date("Y-m-d H:i:s")) {
            //     $data['course'] = Course::where("id", $orderItem->course_id)->first();

            //     return view('student.training', $data);
            // } else {
            //     return redirect(url('notice'));
            // }
        // } else {
        $orderItem = OrderItem::where("id", $id)->first();

        $data['course'] = Course::where("id", $orderItem->course_id)->first();

        return view('student.training', $data);
        // }
    }

    public function get_token(Request $request)
    {

        $userId = strval(\Auth::user()->id);
        $appId = intval(env('zegoAppId'));
        $userId = $userId;
        $secret = env('zegoAppSecret');
        $payload = '';

        $token = ZegoServerAssistant::generateToken04($appId,$userId,$secret,14400,$payload);
        if( $token->code == ZegoErrorCodes::success ){
            return json_encode(["flag" => true, "token" => $token->token]);
        } else {
            return json_encode(["flag" => false]);
        }
    }

    public function ask_to_join(Request $request)
    {
        $meeting = UserMeeting::where("url", $request->url)->first();

        $data = ['random_user' => $request->random, 'title' => \Auth::user()->name.' wants to enter in the meeting'];
        event(new SendNotification($data, $meeting->channel, $meeting->event));
    }

    public function meeting_approve(Request $request)
    {
        $saveName = MeetingEntry::where(['random_user' => $request->random, 'url' => $request->url])->first();

        $data = ['status' => $request->type];
        event(new SendNotification($data, $saveName->channel, $saveName->event));
    }

    public function join_training($id, $url='')
    {
        if (@\Auth::user()->role !== '1') {
            $check = OrderItem::where("course_id", $id)->where("created_by", \Auth::user()->id)->count();
            if ($check == 0) {
                return redirect(url('/'));
            }
        }

        Session::forget('random_user');
        $meeting = UserMeeting::where("url", $url)->first();

        if (isset($meeting->id)) {
            $meeting->app_id = trim($meeting->app_id);
            $meeting->appCertificate = trim($meeting->appCertificate);
            $meeting->channel = trim($meeting->channel);
            $meeting->token = trim($meeting->token);

            if (Auth::user() && Auth::user()->id == $meeting->user_id) {
                $channel = $meeting->channel;
                $event = $meeting->event;
            } else {
                if (!Auth::user()) {
                    $random_user = rand(111111, 999999);
                    Session::put('random_user', $random_user);
                    $event = generateRandomString(5);
                    $this->createEntry($meeting->user_id, $random_user, $meeting->url, $event, $meeting->channel);
                    $channel = $meeting->channel;
                } else {
                    $random_user = rand(111, 999);
                    $event = generateRandomString(5);
                    $this->createEntry($meeting->user_id, $random_user.Auth::user()->id, $meeting->url, $event, $meeting->channel);
                    $channel = $meeting->channel;
                    Session::put('random_user', $random_user.Auth::user()->id);
                }
            }
            return view('student.training', get_defined_vars());
        } else {
            return redirect(url('/notice'));
        }
    }

    public function createEntry($user_id, $random_user, $url, $event, $channel)
    {
        $entry = new MeetingEntry;
        $entry->user_id = $user_id;
        $entry->random_user = $random_user;
        $entry->url = $url;
        $entry->status = 0;
        $entry->channel = $channel;
        $entry->event = $event;
        $entry->save();
    }

    public function user_left(Request $request)
    {
        UserMeeting::where("id", $request->meeting_id)->update(['in_meeting' => '0']);

        return json_encode(['flag' => true, "msg" => "Success"]);
    }

    public function assessment_result($id)
    {
        Session::forget('assessment_attempt_id');

        $data['assessment_result'] = AssessmentResult::with('assessment_result_details', 'assessment_result_details.question', 'assessment_result_details.answer', 'course')->where("id", $id)->first();

        if (count($data['assessment_result']->assessment_result_details) > 0) {
            foreach ($data['assessment_result']->assessment_result_details as $key => $value) {
                $correct_answer = Answer::where("question_id", $value->question->id)->where("is_correct", "1")->first();
                $value->correct_answer = $correct_answer;
            }
        }

        return view('student.assessment_result',$data);
    }

    public function analysis_result($id)
    {
        Session::forget('analysis_attempt_id');

        $data['analysis_result'] = AnalysisResult::with('analysis_result_details', 'analysis_result_details.question', 'analysis_result_details.answer')->where("id", $id)->first();

        if (\Auth::user()->id !== $data['analysis_result']->user_id) {
            return redirect(url('user/dashboard'));
        }

        $recommend = [];
        if (!empty($data['analysis_result']->recommendations)) {
            $recommendations = json_decode($data['analysis_result']->recommendations);
            foreach ($recommendations as $key => $value) {
                $course = Course::where("id", $value)->first();
                array_push($recommend, $course);
            }
        }
        if (empty($recommend)) {
            $courses = Course::where("id", "13")->orWhere("id", "14")->orWhere("id", "15")->get();
            foreach ($courses as $key => $value) {
                array_push($recommend, $value);
            }
        }
        $data['recommend'] = $recommend;

        return view('student.analysis_result', $data);
    }

    public function recommendation($id){
        $result = AnalysisResult::orderBy("id", "DESC")->where("id", $id)->first();
        $recommend = [];
        if (!empty($result->recommendations)) {
            $recommendations = json_decode($result->recommendations);
            foreach ($recommendations as $key => $value) {
                $course = Course::where("id", $value)->first();
                array_push($recommend, $course);
            }
        }
        if (empty($recommend)) {
            $courses = Course::where("id", "13")->orWhere("id", "14")->orWhere("id", "15")->get();
            foreach ($courses as $key => $value) {
                array_push($recommend, $value);
            }
        }
        $data['recommend'] = $recommend;

        return view('student.recommended-courses', $data);
    }

    public function wishlist()
    {
        $wishlist = Wishlist::with('course')->whereHas('course')->where("user_id", Auth::user()->id)->orderBy("id", "desc")->get()->toArray();

        $data = [
            "wishlist" => $wishlist
        ];

        return view('student.wishlist',$data);
    }

     public function remove($id)
    {
        if(!Auth::check()){
            echo json_encode(array("flag"=>false,"msg"=>"Login First!"));
            die;
        }
        $req = $request->all();
        $data = [
            "course_id"=>$req['course_id'],
            "user_id"=>$req['user_id'],
        ];
        if(Wishlist::where($data)->get()->count() == 0){
            echo json_encode(array("flag"=>true,"msg"=>"Course removed from Wishlist!","action"=>"reload")); die;
        }
        Wishlist::where($data)->delete();
        echo json_encode(array("flag"=>true,"msg"=>"Course removed from Wishlist!","action"=>"reload"));
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
            // if ($request->has('skills')) {
            //     foreach ($request->input('skills') as $skill) {
            //         $skill->skillAssessments()->create([
            //             'skill_name' => $skill['name'],
            //             'assessment_date' => now(),
            //             'skill_level' => $skill['level'],
            //         ]);
            //     }
            // }
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
        return view('student.profile');
    }

    public function createreviews(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $data['created_by'] = Auth::user()->id;
            $course_id = $data['course_id'];

        // Check if the user has already reviewed this course
        $existingReview = Reviews::where('created_by', Auth::user()->id)
            ->where('course_id', $course_id)
            ->first();

        // If the user has already reviewed the course, show an error
        if ($existingReview) {
            $response = [
                'flag' => false,
                'msg' => 'You have already reviewed this course.',
            ];
            return response()->json($response);
        }
            $this->cleanData($data);
            $CourseCategories         = new Reviews;
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
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key]
        );
        return view($this->view.'create',$data);
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

    public function listreviews(Request $request)
    {
        $data   = array();
        $data   = array(
            "page_title"=>$this->plural." List",
            "page_heading"=>$this->plural.' List',
            "breadcrumbs"=>array("#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key],
            "active_module" => "services"
        );
        /*
        GET RECORDS
        */
        $records   = new Review;
        // $records   = $records::with('accessoryType');
        $records   = $this->search($records,$request,$data);
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
        $data['ratings']   =   $records;
        /*
        DEFAUTL VALUES
        */
        // dd($data['list']);
        // echo "<pre>"; print_r($data['list']); die();


        return view($this->view.'list',$data);
    }

    public function editreviews(Request $request,$id = NULL)
    {
        $data   = array();
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);
            $services   = Review::find($id);
            // $data['updated_by'] = \Auth::id();
            $Reviews->update($data);
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
                    "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key]
                );
        $data['row']      = Review::find($id)->toArray();
        // echo "<pre>";print_r($data['row']);die;
        return view($this->view.'edit',$data);
    }

    public function editupdate(Request $request,$id = NULL)
    {
        if($request->input('param')){
            $data['is_active'] = $request->input('param');
            $this->cleanData($data);
            $services  = Review::find($id);
            $services->update($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.');
            echo json_encode($response); return;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\services  $services
     * @return \Illuminate\Http\Response
     */
    public function deletereviews($id) {
        $item = Review::find($id);
        $item->delete();
        $response = array('flag'=>true,'msg'=>$this->singular.' has been deleted.');
        echo json_encode($response); return;
    }
}
