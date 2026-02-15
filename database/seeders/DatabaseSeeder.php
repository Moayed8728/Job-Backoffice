<?php

namespace Database\Seeders;

use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobVacancy;
use App\Models\Resume;
use App\Models\User;
use App\Models\Company;
use Faker\Factory as faker;

// use Illuminate\Database\Console\S
// eeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $faker = Faker::create();

        User::firstOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'name' => 'Admin',
            'password'=> Hash::make('12345678'),
            'role'=> 'admin',
            'email_verified_at'=> now(),
        ]);

        $jobData = json_decode(file_get_contents(database_path('data/job_data.json')), true);
        $jobApplicationsData = json_decode(file_get_contents(database_path('data/job_applications.json')), true);

        foreach($jobData['jobCategories']as $category){
            JobCategory::firstOrCreate([
                'name'=> $category,
            ]);
        }


        foreach($jobData['companies'] as $company){
            
            //create company owner
        $companyOwner = User::firstOrCreate([
            'email' => $faker->unique()->safeEmail(),
        ], [
            'name' => $faker->name(),
            'password' => Hash::make('12345678'), 
            'role'=> 'company-owner',
            'email_verified_at'=> now(),
        ]);
       
            Company::firstOrCreate([
                'name'=> $company['name'],
            ], [
                'address'=> $company['address'],
                'industry'=> $company['industry'],
                'website'=> $company['website'],
                'ownerId'=> $companyOwner->id,
                 
            ]);  
        }


            //create job vacancies
            foreach ($jobData['jobVacancies'] as $job){
              
                $company = Company::where('name', $job['company'])->firstOrFail();
                
                $jobCategory = JobCategory::where('name', $job['category'])->firstOrFail();
                
                JobVacancy::firstOrCreate([
                    'title'=> $job['title'],
                    'companyId'=> $company->id,
                ], [
                    'description'=> $job['description'],
                    'location'=> $job['location'],
                    'type'=> $job['type'],
                    'salary'=> $job['salary'],
                    'jobCategoryId'=> $jobCategory->id,
                    
    ]);
       
            }

            foreach($jobApplicationsData['jobApplications'] as $application){

                
                //get random job vacancy
                $jobVacancy = JobVacancy::inRandomOrder()->first();
        
                //create applicant (job-seeker)
                $applicant = User::firstOrCreate([
                    'email' => $faker->unique()->safeEmail(),
                ], [
                    'name' => $faker->name(),
                    'password' => Hash::make('12345678'),  
                    'role'=> 'job-seeker',
                    'email_verified_at'=> now(),
                ]);
            
                //create resume
                $resume = Resume::create([
                    'userId' => $applicant->id,
                    'filename' => $application['resume']['filename'],
                    'fileUrl'=> $application['resume']['fileUrl'],
                    'contactDetails'=> $application['resume']['contactDetails'],
                    'summary'=> $application['resume']['summary'],
                    'skills'=> $application['resume']['skills'],
                    'experience'=> $application['resume']['experience'],
                    'education'=> $application['resume']['education'],
                ]);
                //Create job application
                JobApplication::create([
             
                    'jobVacancyId'=> $jobVacancy->id,
                    'userId' => $applicant->id,
                    'resumeId' => $resume->id,
                    'status' => $application['status'],
                    'aiGeneratedScore' => $application['aiGeneratedScore'],
                    'aiGeneratedFeedback' => $application['aiGeneratedFeedback'],
                    
                ]);
            }
}
    

}