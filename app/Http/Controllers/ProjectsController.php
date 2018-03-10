<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\Company;
use App\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProjectsController extends Controller
{
    
    public function index()
    {
        //show all projects for the login user
        // $projects = Project::all();
        // return view('projects.index', ['projects'=> $projects]); 


        //show only projects whish created by login user
        if(Auth::check())
        {
            $projects = Project::where('user_id', Auth::user()->id)->get();
            return view('projects.index', ['projects'=> $projects]); 
        }
        return view('auth.login');

    }

    
    public function create($company_id = null)
    {
        $companies = null;

        if(!$company_id)
        {
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }
        return view('projects.create', ['company_id' => $company_id, 'companies'=>$companies]);
    }

    
    public function store(Request $request)
    {

        // $input = $request->all();
        // $user = Auth::user();
        // $user->projects()->create($input)->save();
        // Session::flash('created_post', 'The post has been created');
        // return redirect('/projects');

//=================================//

        if(Auth::check())
        {
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'days' => $request->input('days'),
                'company_id' => $request->input('company_id'),
                'user_id' => Auth::user()->id
            ]);

            if($project)
            {
                Session::flash('created_project', 'The project has been created');
                return redirect('/projects');
            }
        }

        return redirect()->back();




    }

    
    public function show(Project $project)
    {
        
        // $project = Project::where('id', $project->id)->first();
        // return view('projects.show', compact('project'));

        $project = Project::findOrFail($project->id);
        return view('projects.show', compact('project'));
    }

    
    public function edit(Project $project)
    {
        $project = Project::findOrFail($project->id);

        return view('projects.edit', compact('project'));
    }

    
    public function update(Request $request, Project $project)
    {
        $projectUpdate = Project::where('id', $project->id);

        $projectUpdate->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description')
        ]);

        Session::flash('updated_project', 'The project has been updated');

        return redirect()->route('projects.index');        
   
    }

   
    public function destroy(Project $project)
    {
        $project = Project::findOrFail($project->id);

        $project->delete();

        Session::flash('deleted_project', 'The project has been deleted successfuly');

        return redirect('/projects');
    }

    public function adduser(Request $request)
    {
        //add user to projects 
        //take a project, add a user to it
        $project = Project::findOrFail($request->input('project_id'));
        if(Auth::user()->id == $project->user_id)
        {
            $user = User::where('id', $request->input('project_id'))->first();
            //check if user is already added to the project
            $projectUser = ProjectUser::where('user_id',$user->id)
                                        ->where('project_id',$project->id)
                                        ->first(); 
            if($projectUser)
            {
                //if user already exists, exit 
                Session::flash('user_exists','User is already a member of this project');
                return redirect()->back();
            }                    
            if($user && $project)
            {
                $project->users()->attach($user->id);
                Session::flash('user_added','User has been added to the project successfuly');
                return redirect()->route('projects.show', ['project' => $project->id]);
            }
        }
        Session::flash('user_notAdded','No users added');
        return redirect()->route('projects.show', ['project' => $project->id]);
    }
}

        //  $project = Project::find($request->input('project_id'));
        //  if(Auth::user()->id == $project->user_id)
        //  {
        //     $user = User::where('id', $request->input('email'))->first(); //single record
        //     //check if user is already added to the project
        //     $projectUser = ProjectUser::where('user_id',$user->id)
        //                                 ->where('project_id',$project->id)
        //                                 ->first();                           
        //         if($projectUser)
        //         {
        //             //if user already exists, exit 
        //             return response()->json(['success' ,  $request->input('email').' is already a member of this project']); 
        //         }
        //         if($user && $project)
        //         {
        //             $project->users()->attach($user->id); 
        //                 return response()->json(['success' ,  $request->input('email').' was added to the project successfully']); 
                            
        //         }         
        //  }
        //  return redirect()->route('projects.show', ['project'=> $project->id])
        //  ->with('errors' ,  'Error adding user to project');
        
         