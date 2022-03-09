<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Wonde\Exceptions\InvalidInputException;

class MainController extends Controller
{
    /*------------------------ Page functions ------------------------*/
    /*
     * Return main page
     *
     * The index vue component then calls the teachers API function to get teachers
     */
    public function index()
    {
        return view('teachers');
    }

    /*
     * Return teacher with their classes and a new page
     *
     * This gets called when a user clicks on a specific teacher
     */
    public function classes(Request $request)
    {
        //connect to wonde SDK client
        $client = new \Wonde\Client(env('WONDE_API_KEY'));
        $school = $client->school('A1930499544');
        //get teacher with their classes and lessons
        try {
            $teacherClasses = $school->employees->get($request->id, ['classes.lessons']);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            abort(404);
        }

        if (!$teacherClasses) {
            abort(404);
        }

        //associative array to hold week data
        $classes = array();

        //loop through class and divide by day
        foreach ($teacherClasses->classes->data as $tc) {
            foreach ($tc->lessons->data as $lesson) {

                //get day string of lesson
                $date = Carbon::parse($lesson->start_at->date)->englishDayOfWeek;

                //push class to the day it falls in the array
                if (array_key_exists($date, $classes)) {
                    //push new object to existing array at the specific day key
                    if (!in_array($tc, $classes[$date])) {
                        array_push($classes[$date], $tc);
                    }
                } else {
                    //create new key and array and push object to array
                    $classes[$date] = array($tc);
                }
            }
        }

        return view('classes')
            ->with('classes', $classes)
            ->with('teacherName', $teacherClasses->legal_forename . ' ' . $teacherClasses->legal_surname);
    }


    /*------------------------ API functions ------------------------*/
    /*
     * Return teachers
     */
    public function teachers(Request $request)
    {
        return Http::withToken(env('WONDE_API_KEY'))
            ->get('https://api.wonde.com/v1.0/schools/A1930499544/employees?has_class=true&per_page=5&page=' . $request->page);
    }


    /*
     * View students in particular class
     */
    public function students(Request $request)
    {
        $client = new \Wonde\Client(env('WONDE_API_KEY'));
        $school = $client->school('A1930499544');

        //get students in requested class
        $classStudents = $school->classes->get($request->id, ['students']);

        //======================== Load time too long - additional details probably not needed for teacher? ========================//
//        $studentsList = array();
//        foreach ($classStudents->students->data as $student) {
//            $studentDetails = $school->students->get($student->id, ['extended_details']);
//            array_push($studentsList, $studentDetails);
//        }

        return $classStudents->students;
    }
}



