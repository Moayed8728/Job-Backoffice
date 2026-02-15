<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->role =='admin'){
            $analytics = $this->adminDashboard();
        }
        else{
            $analytics = $this->companyOwnerDashboard();
        }
        return view('dashboard.index', compact(['analytics']));
}


    private function adminDashboard(){
              //last 30 days active user
              $activeUsers = User::where('last_login_at', '>=',now()->subDays(30))
              ->where('role', 'job-seeker')->count();
              
              $totalJobs = JobVacancy::whereNull('deleted_at')->count();
      
              $totalApplications = JobApplication::whereNull('deleted_at')->count();
              //Most Applied Jobs
      
              $mostAppliedJobs = JobVacancy::withCount('JobApplications as totalCount')
              ->orderByDesc('totalCount')
              ->limit(5)
              -> whereNull('deleted_at')
              ->get();
      
              //conversion rates
              $conversionRates = JobVacancy::withCount('JobApplications as totalCount')
              ->orderByDesc('totalCount')
              ->limit(5)
              ->whereNull('deleted_at')
              ->get()
              ->map(function($job){
                  if($job->viewCount > 0){
                  $job->conversionRate = round($job->totalCount / $job->viewCount * 100, 2);
                  }
                  else{
                      $job->conversionRate = 0;
                  }
                   return $job;
              });
              $analytics = [
                'activeUsers'=> $activeUsers,
                'totalJobs'=> $totalJobs,
                'totalApplications'=> $totalApplications,
                'mostAppliedJobs' => $mostAppliedJobs,
            'conversionRates' => $conversionRates
        

            ];
    
        return $analytics;
    }
    private function companyOwnerDashboard(){
        $company = auth()->user()->company; 

        $activeUsers = User::where('last_login_at', '>=', now()->subDays(30))
        ->where('role', 'job-seeker')
        ->whereHas('jobApplications', function($query) use ($company){
            $query->whereIn('jobVacancyId', $company->jobVacancies->pluck('id'));
        })
        ->count();
        

        $totalJobs = $company->jobVacancies->count();
        
        $totalApplications = JobApplication::whereIn('jobVacancyId', $company->jobVacancies()->pluck('id'))->count();
        
        $mostAppliedJobs = JobVacancy::withCount('jobApplications as totalCount')
        ->orderByDesc('totalCount')
        ->limit(5)
        ->whereIn('id',$company->jobVacancies->pluck('id'))
        ->get();

        $conversionRates = JobVacancy::withCount('jobApplications as totalCount')
        ->whereIn('id', $company->jobVacancies->pluck('id'))
        ->orderByDesc('totalCount')
        ->limit(5)
        ->having('totalCount','>', 0)
        ->get()
        ->map(function($job){
            if($job->viewCount > 0){
                $job->conversionRate = round($job->totalCount / $job->viewCount * 100, 2);
            }
            else{
                $job->conversionRate = 0;
            }
            return $job;
        });
                

        $analytics = [
            'activeUsers'=> $activeUsers,
                'totalJobs'=> $totalJobs,
                'totalApplications'=> $totalApplications,
            'mostAppliedJobs' => $mostAppliedJobs,
            'conversionRates' => $conversionRates
        ];
    
        return $analytics;
    }

}

