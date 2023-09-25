<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::orderByDesc('id')->get();
        $technologies = Technology::orderByDesc('id')->get();



        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    { {
            //validate the req
            $val_data = $request->validated();
            //generate title slug
            $slug = Project::generateSlug($val_data['title']);

            $val_data['slug'] = $slug;

            //$val_data['user_id'] = Auth::id();

            if($request->hasFile('image')) {
                $image_path = Storage::put("uploads", $val_data["image"]);
                $val_data['image'] = $image_path;
            }

            //create new proj
            $new_project = Project::create($val_data);

            //attach requested technologies  
            if ($request->has('technologies')) {
                $new_project->technologies()->attach($request->technologies);
            }

            //attaching image in storage/app/public
            //to fix
            //$img_path = Storage::put('uploads', $val_data['image']);

            //redirect back to route
            return to_route('admin.projects.index')->with("message", "Project created successfully");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();

        /* TO IMPLEMENT
            //edit only if user checked
            if (Auth::id() === $project->user_id) {
            } 
            abort(403);
            */
            
            return view('admin.projects.edit', compact('project', 'types', 'technologies'));
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    { {
            //dd($request->all());
            $val_data = $request->validated();
            //dd($val_data);


            //generate slug
            $slug = Project::generateSlug($val_data['title']);
            //attach slug
            $val_data['slug'] = $slug;

            
            //attach requested technologies  
            if ($request->has('technologies')) {
                $project->technologies()->sync($request->technologies);
            };
            
            //delete image before collecting new one
            if ($request->hasFile('image')) {
                
                if($project->image) {
                    Storage::delete($project->image);
                }

                //save file in storage and copy his path
                $image_path = $request->file('image')->store('public/uploads');
                //$image_path = Storage::disk('public')->put('uploads', $request->image);
                //$image_path = Storage::put('uploads', $request->image);
                //print path in 'image'
                $val_data['image'] = $image_path;

            };
            
            //update project
            $project->update($val_data);
            
            return to_route('admin.projects.index')->with("message", "Project updated successfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //delete image from the storage
        if($project->image) {
            Storage::delete($project->image);
        }

        $project->delete();
        return to_route('admin.projects.index')->with('message', 'Project deleted succesfully');
    }
}
