<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StudentController extends Controller
{
    private $numberPage = 10;
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $q = request()->has('q') ? request()->get('q') : '';

        $students = Student::query();

        if ($q) {
            $students->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('last_name', 'like', "%{$q}%")
                    ->orWhere('birth_year', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('created_at', 'like', "%{$q}%")
                    ->orWhere('updated_at', 'like', "%{$q}%");
            });
        }

        $students->orderBy('created_at', 'desc');
        $resp = $students->paginate($this->numberPage);

        return Inertia::render('Student/StudentList', [
            'students' => $resp,
            'q' => $q
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Student/StudentForm', [
            'student' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $student = new Student;
        $student->fill($request->all());
        $student->save();

        return to_route('student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $student->course;
        return Inertia::render('Student/StudentForm', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        $student->fill($request->all());
        $student->save();

        return to_route('student.edit', $student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();
        return to_route('student.index');
    }

    function addCourse(Request $request, Student $student): RedirectResponse
    {
        $courseId = $request->get('course_id');
        $student->course()->syncWithoutDetaching($courseId);
        return to_route('student.edit', $student);
    }

    function deleteCourse(Request $request, Student $student): RedirectResponse
    {
        $courseId = $request->get('course_id');
        $student->course()->detach($courseId);
        return to_route('student.edit', $student);
    }
}
