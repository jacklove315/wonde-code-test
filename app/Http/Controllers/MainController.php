<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    /*------------------------ Page functions ------------------------*/
    /*
     * Return main page
     *
     * Reasons i dont load in teachers here:
     * 1 - Need to make pagination requests to an api function anyway
     * 2 - page will load faster and can show a loader when fetching the parents on initial load
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

       //Catch exception of user tries to enter employee key that doesnt exist
        try {
            //get teacher with their classes and lessons
            $teacherClasses = $school->employees->get($request->id, ['classes.lessons']);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            abort(404);
        }

        //collection to hold weekly classes
        $weeklyClasses = collect();
        //loop through teachers classes
        foreach ($teacherClasses->classes->data as $tc) {
            //loo through teachers lessons
            foreach ($tc->lessons->data as $lesson) {
                $class = collect($tc);
                $class->put('week_day', Carbon::parse($lesson->start_at->date)->dayOfWeekIso);

                //if the class is already in the collection, dont push it (in some cases a class may have lessons on the same day)
                if (!$weeklyClasses->contains($class)) {
                    $weeklyClasses->push($class);
                }
            }
        }
        //sort by week_day to ensure the correct order of weekdays from 1-5
        //group by week_day so that all classes fall within a key representing their day of the week
        $weeklyClasses = $weeklyClasses
            ->sortBy('week_day')
            ->groupBy('week_day');

        return view('classes')
            ->with('classes', $weeklyClasses)
            ->with('teacherName', $teacherClasses->legal_forename . ' ' . $teacherClasses->legal_surname);


        //===================== Below shows an older approach to the above code =====================//
        //        $classes = array();
//        //loop through class and divide by day
//        foreach ($teacherClasses->classes->data as $tc) {
//            foreach ($tc->lessons->data as $lesson) {
//
//                //get day string of lesson
//                $date = Carbon::parse($lesson->start_at->date)->englishDayOfWeek;
//
//                //push class to the day it falls in the array
//                if (array_key_exists($date, $classes)) {
//                    //push new object to existing array at the specific day key
//                    if (!in_array($tc, $classes[$date])) {
//                        array_push($classes[$date], $tc);
//                    }
//                } else {
//                    //create new key and array and push object to array
//                    $classes[$date] = array($tc);
//                }
//            }
//        }
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

        return $classStudents->students;
    }

    /*
     * Get additional student details
     */
    public function getStudentDetails(Request $request)
    {
        $client = new \Wonde\Client(env('WONDE_API_KEY'));
        $school = $client->school('A1930499544');
        return $school->students->get($request->id, ['extended_details']);
    }
}



