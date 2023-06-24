<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseStudentRequest;
use App\Models\Course;
use App\Models\Student;
use App\Models\VCourseStudent;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $numberPage = 10;
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {

        $q = request()->has('q') ? request()->get('q') : '';

        $curses = VCourseStudent::query();

        if ($q) {
            $curses->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('last_name', 'like', "%{$q}%")
                    ->orWhere('name_course', 'like', "%{$q}%");
            });
        }

        $curses->orderBy('name', 'asc');
        $resp = $curses->paginate($this->numberPage);


        // // Enable query logging
        // DB::connection()->enableQueryLog();

        $date = Carbon::now()->subMonths(6);

        $topCourses = Course::withCount(['students' => function (Builder $query) use ($date) {
            $query->where('students.created_at', '>=', $date);
        }])->orderBy('students_count', 'desc')->limit(3)->get();

        // // Get the logged queries
        // $queries = DB::getQueryLog();
        // \Log::info($queries);


        return Inertia::render('Dashboard', [
            'course_students' => $resp,
            'q' => $q,
            'top_courses' => $topCourses,
        ]);
    }

    function store(StoreCourseStudentRequest $request): RedirectResponse
    {
        $courseId = $request->get('course_id');
        $studentId = $request->get('student_id');
        $student = Student::find($studentId);
        $student->course()->syncWithoutDetaching($courseId);

        return to_route('dashboard');
    }

    function destroy(Request $request, Student $student): RedirectResponse
    {
        $courseId = $request->get('course_id');
        if ($courseId) {
            $student->course()->detach($courseId);
        }

        return to_route('dashboard');
    }
}
