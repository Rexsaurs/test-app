<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionnaireController extends Controller
{
    public function index()
    {
        return view('back.pages.questionnaire');
    }

    public function kuesioner_form(Request $request)
    {

        $success = false;

        dd($request->post());

        $request->validate([
            "p_name" => 'required',
            "p_nim" => 'required',
            "p_email" => 'required',
            "p_phone" => 'required',
            "p_gender" => 'required',
            "p_religion" => 'required',
            "p_enterace_year" => 'required',
            "p_graduation_year" => 'required',
            "p_major_study" => 'required',
            "p_degree" => 'required',
        ], ['required' => 'Field is required']);

        $user = '';
        $form_value = $request->post();

        if (Auth::guard('user')->check()) {
            $user = User::findorFail(auth()->id());
        }

        //Begin db transaction for questionare answers
        DB::beginTransaction();

        //Table Kuesioner Identity
        DB::table('kuesioner_identitas')->insert([
            'user_id' => $user->id,
            'name' => $form_value['p_name'],
            'nim' => $form_value['p_nim'],
            'email' => $form_value['p_email'],
            'phone' => $form_value['p_phone'],
            'gender' => $form_value['p_gender'],
            'religion' => $form_value['p_religion'],
            'enterace_year' => $form_value['p_enterace_year'],
            'graduation_year' => $form_value['p_graduation_year'],
            'major' => $form_value['p_major_study'],
            'degree' => $form_value['p_degree'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $last_identity_id = DB::getPdo()->lastInsertId();

        //Table Kuesioner
        DB::table('kuesioner')->insert([
            'identity_id' => $last_identity_id,
            'alumni_status' => $form_value['p_alumni_status'],
            'university_payment_source' => $form_value['p_university_payment_source'],
            'lecture_method' => $form_value['p_lecture_method'],
            'demo_method' => $form_value['p_demo_method'],
            'project_method' => $form_value['p_project_method'],
            'internship_method' => $form_value['p_internship_method'],
            'practical_method' => $form_value['p_practical_method'],
            'field_method' => $form_value['p_field_method'],
            'discussion_method' => $form_value['p_discussion_method'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $last_kuesioner_id = DB::getPdo()->lastInsertId();

        //Table Kuesioner Edukasi Lanjut
        DB::table('kuesioner_education')->insert([
            'tracer_study_id' => $last_kuesioner_id,
            'location' => $form_value['p_location'] == 'Dalam Negeri' ? $form_value['p_location'] : $form_value['p_location_remark'],
            'payment_type' => $form_value['p_payment_type'] == 'Biaya Sendiri' ? $form_value['p_payment_type'] : $form_value['p_payment_type_remark'],
            'start_date' => $form_value['p_start_date'],
            'university_name' => $form_value['p_university_name'],
            'major' => $form_value['p_major'],
            'reasons' => $form_value['p_reasons'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //Table Kuesioner Work
        DB::table('kuesioner_work')->insert([
            'tracer_study_id' => $last_kuesioner_id,
            'job_position' => $form_value['p_job_position'],
            'job_acquired_time' => $form_value['p_job_acquired_time'],
            'company' => $form_value['p_company'],
            'salary' => $form_value['p_salary'],
            'company_province' => $form_value['p_company_province'],
            'company_regency' => $form_value['p_company_regency'],
            'company_type' => $form_value['p_company_type'] != '5' ? $form_value['p_company_type'] : $form_value['p_company_type_other'],
            'company_level' => $form_value['p_company_level'],
            'university_company_relation' => $form_value['p_work_compatibility'],
            'university_company_level' => $form_value['p_work_compatibility_level'],
            'applied_company' => $form_value['p_applied_company'],
            'applied_company_responded' => $form_value['p_applied_company_responded'],
            'applied_company_interviewed' => $form_value['p_applied_company_interview'],
            'job_hunting_status' => $form_value['p_job_hunting_status'] != 'Lainnya' ? $form_value['p_job_hunting_status'] : $form_value['p_job_hunting_remark'],
            'job_hunt_type' => $form_value['p_job_hunt_type'],
            'job_hunt_month' => $form_value['p_job_hunt_type'] == 'Sebelum Lulus' ? $form_value['p_job_hunt_month'][0] : ($form_value['p_job_hunt_type'] == 'Setelah Lulus' ? $form_value['p_job_hunt_month'][1] : null),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $last_kuesioner_work_id = DB::getPdo()->lastInsertId();

        //Table Kuesioner Competency
        DB::table('kuesioner_competency')->insert([
            [
                'kuesioner_work_id' => $last_kuesioner_work_id,
                'type' => 'graduation',
                'ethics' => $form_value['p_ethics_graduation'],
                'expertise' => $form_value['p_expertise_graduation'],
                'english' => $form_value['p_english_graduation'],
                'tech' => $form_value['p_tech_graduation'],
                'communication' => $form_value['p_communication_graduation'],
                'teamwork' => $form_value['p_teamwork_graduation'],
                'development' => $form_value['p_development_graduation'],
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'kuesioner_work_id' => $last_kuesioner_work_id,
                'type' => 'work',
                'ethics' => $form_value['p_ethics_work'],
                'expertise' => $form_value['p_expertise_work'],
                'english' => $form_value['p_english_work'],
                'tech' => $form_value['p_tech_work'],
                'communication' => $form_value['p_communication_work'],
                'teamwork' => $form_value['p_teamwork_work'],
                'development' => $form_value['p_development_work'],
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        //Table Kuesioner Job Hunting
        $job_hunt_methods = [];
        foreach ($form_value['p_job_hunt_method'] as $key => $value) {
            if ($key == 14) {
                array_push($job_hunt_methods, [
                    'kuesioner_work_id' => $last_kuesioner_work_id,
                    'job_hunt_method' => $value,
                    'remarks' => $form_value['p_job_hunt_method_other'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                continue;
            }

            array_push($job_hunt_methods, [
                'kuesioner_work_id' => $last_kuesioner_work_id,
                'job_hunt_method' => $value,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        DB::table('kuesioner_work_hunt')->insert($job_hunt_methods);

        //Table Kuesioner Job Compatibility
        $job_compatibility = [];
        foreach ($form_value['p_compatibility_type'] as $key => $value) {
            if ($key == 12) {
                array_push($job_compatibility, [
                    'kuesioner_work_id' => $last_kuesioner_work_id,
                    'compatibility_type' => $value,
                    'compatibility' => $form_value['p_compatibility_remark'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                continue;
            }

            array_push($job_compatibility, [
                'kuesioner_work_id' => $last_kuesioner_work_id,
                'compatibility_type' => $value,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        DB::table('kuesioner_work_hunt')->insert($job_compatibility);


        if (DB::transactionLevel() == 1) {
            DB::commit();
            return response()->json(['response' => 'success', 'message' => 'Success! Data has been added.'], 200);
        } else {
            DB::rollback();
            // something went wrong
            return response()->json(['response' => 'error', 'message' => 'Error! Something went wrong.'], 500);
        }
    }
}
