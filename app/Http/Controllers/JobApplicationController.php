<?php

namespace App\Http\Controllers;
use App\Http\Requests\JobApplicationUpdateRequest;
use Illuminate\Http\Request;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
          $query = JobApplication::latest();

          if(auth()->user()->role == 'company-owner'){
            $query->whereHas('jobVacancy', function($query){
                $query->where('companyId', auth()->user()->companies->id);
            });
          }


        if($request->input("archived") == 'true') {
            $query->onlyTrashed();
        }

        
        $jobApplications = $query->paginate(10)->onEachSide(1);
        return view("job-applications.index", compact("jobApplications"));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        return view('job-applications.show', compact('jobApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        return view('job-applications.edit', compact('jobApplication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobApplicationUpdateRequest $request, string $id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->update([
            'status' => $request-> input('status')
        ]);
       
        if($request->query('redirectToList') == 'false'){
        
            return redirect()->route('job-applications.show',$id)->with('success', 'Job Application updated successfully.');
        }
        
        return redirect()->route('job-applications.index')->with('success','Job Application Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->delete();
        return redirect()->route('job-applications.index')->with('success','Applicant archived sucessfully!');
    }

    public function restore(string $id){
        $jobApplication = JobApplication::withTrashed()->findOrFail($id);
        $jobApplication->restore();
        return redirect()->route('job-applications.index', ['archived' => 'true'])->with('success','Applicant restored successfully!');
    }
}
