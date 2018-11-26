<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Controllers\Controller;
use App\Project;
use App\Customer;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function filter(Request $request){

        $projects = Project::where('name', $request->input('search_field'))->get();
        if ($projects->count() != 0){
            $projects->toJson();
            return view('viewAll', ['projects' => $projects]);
        }
        else{
            $customers = Customer::where('first_name', $request->input('search_field'))->get();
            foreach ($customers as $customer){
                $projects = $customer->projects;    
            }
            if ($projects->count() != 0){
                $projects->toJson();
                return view('viewAll', ['projects' => $projects]);
            }
            else{
                $customers = Customer::where('last_name', $request->input('search_field'))->get();
                foreach ($customers as $customer){
                    $projects = $customer->projects;
                }
                if ($projects->count() != 0){
                    $projects->toJson();
                    return view('viewAll', ['projects' => $projects]);
                }
                else{
                    $data_arr = explode(" ", $request->input('search_field'));
                    if (count($data_arr) === 2){
                        $customers = Customer::where('first_name', $data_arr[0])->where('last_name', $data_arr[1])->get();
                        foreach ($customers as $customer){
                            $projects = $customer->projects;
                        }
                        $projects->toJson();
                        return view('viewAll', ['projects' => $projects]);
                    }
                    else{
                        return view('viewAll', ['projects' => $projects]);
                    }
                }
            }
        }
    }

    public function index(){
        $projects =  Project::get();
        return view('viewAll', ['projects' => $projects]);
    }

    public function new(){
        $customers = Customer::get();
        return view('newProject', ['customers' => $customers]);
    }

    public function view($id){
        $project = Project::find($id);
        return view('viewProject', ['project' => $project]);
    }

    public function edit($id){
        $project = Project::find($id);
        $customers = Customer::get();
        return view('editProject', ['project' => $project, 'customers' => $customers]);
    }

    public function confirm($id){
        $project = Project::find($id);
        return view('confirmation', ['project' => $project]);
    }

    public function store(ProjectStoreRequest $request){

        $validatedData = $request->validated();

        $project = new Project;
        
        $project->name = $request->input('name');
        $project->customer_id = $request->input('customer_id');
        $project->start_date = Carbon::parse($request->input('start_date'))->format('Y-m-d');
        $project->end_date = Carbon::parse($request->input('end_date'))->format('Y-m-d');
        $project->active = $request->input('active');
        $project->budget = $request->input('budget');
        $project->description = $request->input('description');

        $project->save();
        return redirect('index');
    }

    public function update($id , ProjectUpdateRequest $request){
        
        $validatedData = $request->validated();

        $project = Project::find($id);

        $project->name = $request->input('name');
        $project->customer_id = $request->input('customer_id');
        $project->start_date = Carbon::parse($request->input('start_date'))->format('Y-m-d');
        $project->end_date = Carbon::parse($request->input('end_date'))->format('Y-m-d');
        $project->active = $request->input('active');
        $project->budget = $request->input('budget');
        $project->description = $request->input('description');

        $project->save();
        return redirect('index');
    }

    public function delete($id){
        $project = Project::find($id);
        $project->delete();
        return redirect('index');
    }
}