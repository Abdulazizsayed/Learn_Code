<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Question;
use App\Quiz;

class QuizController extends Controller
{
    public function index($slug, $name)
    {
        $course = Course::where('slug', $slug)->first();
        $quiz = $course->quizzes()->where('title', $name)->first();

        return view('quiz', compact('quiz'));
    }

    public function submit($slug, $name, Request $request)
    {

        $quiz = Quiz::where('title', $name)->first();
        $questions = $quiz->questions;

        $questions_ids = [];
        $questions_right_answers = [];
        $final_score = 0;

        foreach ($questions as $question) {
            $questions_ids[] = $question->id;
            $questions_right_answers[] = $question->right_answer;
            $final_score += $question->score;
        }

        for ($i = 0; $i < count($questions_ids); $i++) {
            $your_answer = trim($request["$questions_ids[$i]"]);
            $the_answer = trim($questions_right_answers[$i]);

            if ($your_answer != $the_answer) {
                session()->flash('failed', "Your answer ($your_answer) is not correct");
                return redirect("/courses/$slug/quizzes/$name");
            }
        }

        $user = auth()->user();
        $user->quizzes()->attach($quiz->id);
        $user->score += $final_score;
        if ($user->save()) {
            session()->flash('success', "Well done! you've solved $quiz->title quiz. you've earned $final_score points");
            return redirect("/courses/{$quiz->course->slug}");
        }
    }
}
