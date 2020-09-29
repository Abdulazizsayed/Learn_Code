<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Track;
use App\Photo;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.courses.index')->with('courses', Course::orderBy('id', 'desc')->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create')->with('tracks', Track::all());
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
            'title' => 'required|min:20|max:150',
            'status' => 'required|integer|in:0,1',
            'link' => 'required|url',
            'track_id' => 'required|integer',
        ];

        $this->validate($request, $rules);

        $course = Course::create($request->all());

        if ($course) {
            // insert course image
            if ($file = $request->file('photo')) {
                $filename = $file->getClientOriginalName();
                $fileExt = $file->getClientOriginalExtension();
                $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.' . $fileExt;

                if ($file->move('images', $file_to_store)) {
                    Photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $course->id,
                        'photoable_type' => 'App\Course'
                    ]);
                }
            }
            return redirect('/admin/courses');
        }
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
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'))->with('tracks', Track::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $rules = [
            'title' => 'required|min:20|max:150',
            'status' => 'required|integer|in:0,1',
            'link' => 'required|url',
            'track_id' => 'required|integer',
        ];

        $this->validate($request, $rules);

        $course->update($request->all());

        // insert course image
        if ($file = $request->file('photo')) {
            $filename = $file->getClientOriginalName();
            $fileExt = $file->getClientOriginalExtension();
            $file_to_store = time() . '_' . explode('.', $filename)[0] . '_.' . $fileExt;

            if ($file->move('images', $file_to_store)) {
                $photo = $course->photo;
                if ($photo) {
                    unlink('images/' . $photo->filename);
                    $photo->filename = $file_to_store;
                    $photo->save();
                } else {
                    Photo::create([
                        'filename' => $file_to_store,
                        'photoable_id' => $course->id,
                        'photoable_type' => 'App\Course'
                    ]);
                }
            }
        }
        return redirect('/admin/courses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {

        // delete photo from db
        if ($course->photo) {
            // delete photo from server
            unlink('images/' . $course->photo->filename);
            $course->photo->delete();
        }

        $course->delete();
        return redirect('/admin/courses');
    }
}
