<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobVacancyCreateRequest;
use App\Models\JobVacancy;
use App\Models\Company;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Http\Requests\JobVacancyUpdateRequest;
class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobVacancy::latest();

        if(auth()->user()->role == 'company-owner') {
            $query->where('companyId', auth()->user()->companies->id);
        }


        if($request->input("archived") == 'true') {
            $query->onlyTrashed();
        }

        
        $jobVacancies = $query->paginate(10)->onEachSide(1);
        return view("job-vacancy.index", compact("jobVacancies"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $companies = Company::all();
       $jobCategories = JobCategory::all();
        return view("job-vacancy.create", compact('companies','jobCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobVacancyCreateRequest $request)
    {
        $validated = $request->validated();
        JobVacancy::create($validated);
        return redirect()->route('job-vacancies.index')->with('success',' Job Vacancy created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobVacancy = JobVacancy::find($id);
        return view("job-vacancy.show", compact("jobVacancy"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $jobVacancy = JobVacancy::find($id);
        $companies = Company::all();
        $jobCategories = JobCategory::all();
        return view("job-vacancy.edit", compact("jobVacancy","companies","jobCategories"));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(JobVacancyUpdateRequest $request, string $id)
{
    $validated = $request->validated();
    $jobVacancy = JobVacancy::findOrFail($id);
    $jobVacancy->update($validated);

    return redirect()->route('job-vacancies.show', $id)
                     ->with('success', 'Job Vacancy updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JobVacancy::findOrFail($id)->delete();
        JobVacancy::destroy($id);
        return redirect()->route('job-vacancies.index')->with('success','Job Vacancy archived successfully!');
    }

    public function restore(string $id){
        $jobVacancy = JobVacancy::withTrashed()->findOrFail($id);
        $jobVacancy->restore();
        return redirect()->route('job-vacancies.index', ['archived' => 'true'])->with('success','Job Vacancy restored successfully!');
    }
}
