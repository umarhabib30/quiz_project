<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Students\Answer;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class StudentQuizController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('student');
    // }

    public function dashboard() // Corrected the method name
    {
        return view('student.dashboard');
    }
    public function index($id){
            // $quiz = Quiz::find($id);
            // return to declaimer with quiz id
    }

    // public function start_quiz($id)
    // {
    //     $quiz = Quiz::find($id);

    //     if (!$quiz) {
    //         return redirect()->back()->with('error', 'Quiz not found.');
    //     }

    //     $data['quiz'] = $quiz; // Pass the quiz to the view
    //     $data['questions'] = Question::where('quiz_id', $id)->get(); // Fetch related questions

    //     return view('student.question', $data);
    // }
    public function start_quiz($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return redirect()->back()->with('error', 'Quiz not found.');
        }

    // Fetch the IDs of questions already answered by the authenticated user
        $answeredQuestions = Answer::where('user_id', auth()->id())
        ->where('quiz_id', $id)
        ->pluck('question_id')
        ->toArray();

    // Fetch questions that are not answered
        $data['quiz'] = $quiz;
        $data['questions'] = Question::where('quiz_id', $id)
        ->whereNotIn('id', $answeredQuestions)
        ->get();

        return view('student.question', $data);
    }


                // return to page which says congratulations quiz submitted
                // Auth::logout
//     public function submitQuiz(Request $request, $quizId, $id)
//     {
//     // Validate incoming data
//         $request->validate([
//             'question_id' => 'required|exists:questions,id',
//             'video' => 'required|string',
//         ]);

//         try {
//         // Decode and save the video file
//             $videoData = $request->input('video');
//         $videoData = explode(',', $videoData)[1]; // Extract Base64 data
//         $video = base64_decode($videoData);

//         // Create directory if it doesn't exist
//         $directory = storage_path('app/public/videos');
//         if (!is_dir($directory)) {
//             mkdir($directory, 0755, true);
//         }

//         $fileName = 'quiz_' . $quizId . '_question_' . $request->question_id . '.webm';
//         $filePath = $directory . '/' . $fileName;

//         // Save the video file
//         if (file_put_contents($filePath, $video) === false) {
//             return response()->json(['success' => false, 'message' => 'Failed to save the video file.'], 500);
//         }
//         // dd($request);
//         // Save answer and video path in the database
//         $answer = new Answer();
//         $answer->quiz_id = $quizId;
//         $answer->question_id = $request->question_id;
//         $answer->user_id = Auth::id();
//         $answer->video = 'videos/' . $fileName;
//         $answer->save();

//         // return response()->json(['success' => true, 'message' => 'Answer submitted successfully.']);
//         $response = array('flag'=>true,'msg'=>' Question has been added successfully');
//         echo json_encode($response);  return redirect(url('student/start-quiz', $quizId));
//     } catch (\Exception $e) {
//         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
//     }
// }
    public function submitQuiz(Request $request, $quizId, $id)
    {
    // Validate incoming data
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'video' => 'required|string',
        ]);

        try {
        // Save video to storage
            $videoPath = $this->saveVideoToStorage($request->input('video'), $quizId, $request->question_id);

        // Save answer in the database
            $this->createAnswer($quizId, $request->question_id, Auth::id(), $videoPath);

        // Redirect with success message
            return redirect()->route('student.start_quiz', ['id' => $quizId])
            ->with('success', 'Answer submitted successfully.');
        } catch (\Exception $e) {
            \Log::error('Quiz submission error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while submitting your answer. Please try again.');
        }
    }

/**
 * Save Base64 video to storage
 */
private function saveVideoToStorage($base64Video, $quizId, $questionId)
{
    $videoData = explode(',', $base64Video)[1]; // Extract Base64 data
    $video = base64_decode($videoData);

    // Create directory if it doesn't exist
    $directory = storage_path('app/public/videos');
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }

    $fileName = "quiz_{$quizId}_question_{$questionId}_" . time() . ".mp4";
    $filePath = $directory . '/' . $fileName;

    if (file_put_contents($filePath, $video) === false) {
        throw new \Exception('Failed to save the video file.');
    }

    return 'videos/' . $fileName;
}

/**
 * Create answer record in the database
 */
private function createAnswer($quizId, $questionId, $userId, $videoPath)
{
    $answer = new Answer();
    $answer->quiz_id = $quizId;
    $answer->question_id = $questionId;
    $answer->user_id = $userId;
    $answer->video = $videoPath;
    $answer->save();
}

// public function list(){
//     $student = Auth::user();
//     if (!$student || !$student->class_id) {
//        return redirect()->back()->with('error', 'No associated class found for this student.');
//    }
//             // Fetch quizzes where class_id matches the student's class_id
//    $data['quizzes'] = Quiz::where('class_id', $student->class_id)->get();

//             // Pass quizzes to the view
//    return view('student.quiz', $data);
// }
public function list()
{
    $student = Auth::user();

    if (!$student || !$student->class_id) {
        return redirect()->back()->with('error', 'No associated class found for this student.');
    }

    // Define the timezone (replace 'America/New_York' with your desired timezone)
    $timezone = 'Asia/Karachi'; // Example: Pakistan Standard Time

    // Get the current date and time in the local timezone
    $currentDate = Carbon::now($timezone)->toDateString(); // Current date in local timezone
    $currentTime = Carbon::now($timezone); // Current time in local timezone
    $oneHourAgo = $currentTime->copy()->subHour()->toTimeString(); // Time an hour ago in local timezone

    // Fetch quizzes where class_id matches, start_date is today, and time is within the last hour
    $data['quizzes'] = Quiz::where('class_id', $student->class_id)
        ->where('start_date', $currentDate)
        ->whereBetween('start_time', [$oneHourAgo, $currentTime->toTimeString()])
        ->get();

    // Pass quizzes to the view
    return view('student.quiz', $data);
}
}
