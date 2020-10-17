<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.questions.index')->with('questions', Question::orderBy('id', 'desc')->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.create')->with('quizzes', Quiz::orderBy('id', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:30|max:1000',
            'answers' => 'required|min:10|max:1000',
            'right_answer' => 'required|min:2|max:50|in:' . str_replace(' ', ',', trim($request->answers)),
            'score' => 'required|integer|in:5,10,15,20,25,30',
            'score' => 'required|string|in:text,checkbox',
            'quiz_id' => 'required|integer',
        ];

        $this->validate($request, $rules);

        Question::create($request->all());

        return redirect('/admin/questions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'))->with('quizzes', Quiz::orderBy('id', 'desc')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $rules = [
            'title' => 'required|min:30|max:1000',
            'answers' => 'required|min:10|max:1000',
            'right_answer' => 'required|min:2|max:50|in:' . str_replace(' ', ',', trim($request->answers)),
            'score' => 'required|integer|in:5,10,15,20,25,30',
            'quiz_id' => 'required|integer',
        ];

        $this->validate($request, $rules);

        $question->update($request->all());

        return redirect('admin/questions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect('admin/questions');
    }
}
