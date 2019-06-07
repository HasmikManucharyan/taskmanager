<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user_type = auth()->user()->type;
        if($user_type == 'developer'){
            $mytasks = DB::table('users')
                ->join('assigned_tasks', 'users.id', '=', 'assigned_tasks.users_id')
                ->join('tasks', 'tasks.id', '=', 'assigned_tasks.tasks_id')
                ->select('tasks.*')
                ->where('users.id', '=', $user_id)
                ->get();
            return view('home',['mytasks'=>$mytasks]);
        }

        $data =[];
        $data['unassigned_tasks'] = DB::table('tasks')
            ->select('tasks.*')
            ->where('tasks.assigned_by', '=', 0)
            ->get();

        $data['assigned_tasks_by_me'] = DB::table('tasks')
            ->select('tasks.*')
            ->where('tasks.assigned_by', '=', $user_id)
            ->get();
        return view('manager',['data'=>$data]);
    }

    public function ajaxRequestPost(Request $request)
    {        
        $data = $request->all();
        DB::table('tasks')
            ->where('id', $data['id'])
            ->update(['status' => $data['status']]);
        return redirect()->route('home');
    }

    public function addTaskPost(Request $request) {
        $data = $request->all();
        DB::table('tasks')->insert(
            ['title' => $data['title'], 'deadline' => $data['deadline']]
        );
        return back();
    }

    public function getUsersPost() {
        $users = DB::table('users')
                ->select('users.id','users.name')
                ->where('users.type', '!=', 'manager')
                ->get();
        return $users;
    }

    public function saveUserPost(Request $request) {
        $user_id = auth()->user()->id;
        $data = $request->all();
        DB::table('assigned_tasks')->insert(
            ['assigned_tasks.tasks_id' => $data['task_id'], 'assigned_tasks.users_id' => $data['id']]
        );
        DB::table('tasks')
            ->where('id', $data['task_id'])
            ->update(['assigned_by' => $user_id]);
        $this->index();    
        return back();
    }
}
