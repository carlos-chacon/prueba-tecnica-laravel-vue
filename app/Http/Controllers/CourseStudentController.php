<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseStudentRequest;
use App\Http\Requests\UpdateCourseStudentRequest;
use App\Models\CourseStudent;
use App\Models\VCourseStudent;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class CourseStudentController extends Controller
{
    private $numberPage = 10;
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $q = request()->has('q') ? request()->get('q') : '';

        $curse_student = VCourseStudent::query();

        // if ($q) {
        //     $curse_student->where(function ($query) use ($q) {
        //         $query->where('name', 'like', "%{$q}%")
        //             ->orWhere('schedule', 'like', "%{$q}%")
        //             ->orWhere('start_date', 'like', "%{$q}%")
        //             ->orWhere('end_date', 'like', "%{$q}%")
        //             ->orWhere('number_students', 'like', "%{$q}%")
        //             ->orWhere('created_at', 'like', "%{$q}%")
        //             ->orWhere('updated_at', 'like', "%{$q}%");
        //     });
        // }

        $curse_student->orderBy('created_at', 'desc');
        $resp = $curse_student->paginate($this->numberPage);

        return Inertia::render('CourseStudent/CourseList', [
            'course_student' => $resp,
            'q' => $q
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('CourseStudent/CourseForm', [
            'course_student' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseStudentRequest $request): RedirectResponse
    {
        $course_student = new CourseStudent;
        $course_student->fill($request->all());
        $course_student->save();

        return to_route('course_student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(VCourseStudent $course_student)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VCourseStudent $course_student)
    {
        return Inertia::render('CourseStudent/CourseForm', [
            'course_student' => $course_student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseStudentRequest $request, CourseStudent $course_student)
    {
        $course_student->fill($request->all());
        $course_student->save();

        return to_route('course_student.edit', $course_student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseStudent $course_student)
    {
        $course_student->delete();
        to_route('course_student.index');
    }
}
