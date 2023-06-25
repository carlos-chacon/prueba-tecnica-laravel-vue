<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    private $numberPage = 10;
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $q = request()->has('q') ? request()->get('q') : '';

        $curses = Course::query();

        if ($q) {
            $curses->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('schedule', 'like', "%{$q}%")
                    ->orWhere('start_date', 'like', "%{$q}%")
                    ->orWhere('end_date', 'like', "%{$q}%")
                    ->orWhere('number_students', 'like', "%{$q}%")
                    ->orWhere('created_at', 'like', "%{$q}%")
                    ->orWhere('updated_at', 'like', "%{$q}%");
            });
        }

        $curses->orderBy('created_at', 'desc');
        $resp = $curses->paginate($this->numberPage);

        return Inertia::render('Course/CourseList', [
            'courses' => $resp,
            'q' => $q,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Course/CourseForm', [
            'course' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $course = new Course;
        $course->fill($request->all());
        $course->save();

        return to_route('course.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return Inertia::render('Course/CourseForm', [
            'course' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->fill($request->all());
        $course->save();

        return to_route('course.edit', $course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {

        $errors = [];
        $delete =  $course->delete();
        if (!$delete) {
            $errors = [
                'delete_course' => 'No fue posible eliminar el curso. El curso esta asignado a estudiantes.'
            ];
        }
        to_route('course.index')->withErrors($errors);
    }

    function listCourse($q)
    {
        $courses = Course::where('name', 'like', "%{$q}%")
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($courses);
    }
}
