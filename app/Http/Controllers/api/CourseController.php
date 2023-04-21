<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses  = Course::all();
        return response()->json($courses, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $course = Course::create($data);        
        return response()->json($course, 201);
 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $course = Course::findOrFail($id);
            return response()->json($course, 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Curso no encontrado'], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $course->update($data);

        return response()->json($course, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json(['message' => 'Curso eliminado con exito'], 200);
    }
}
