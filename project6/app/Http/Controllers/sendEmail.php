<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\mentor_application;
use Illuminate\Support\Facades\Mail;
// use Mail;

class sendEmail extends Controller
{
    public function store(Request $request)
    { 
        $Ourmessage = '';
        if (isset($request->sender)) {
            $Ourmessage = "

           ' Hi mentor,we reviwed candidate application with your course,here is'
            Candidate Info:
            'Candidate name: $request->userName 
            ' Candidate email: $request->userEmail
            'Age:$request->userAge

            ' Education: $request->userEducation
            'Thanks'
            ";
        }

        $dataa = [

            'subject' => 'Application Approval from mentorHub' . $Ourmessage,
            'email' => 'khozamaobeidat11@gmail.com',
            //  'content'=>$Ourmessage

        ];

        Mail::send('admin.EmailContentForMentor', $dataa, function ($message) use ($dataa) {
            $message->to($dataa['email'])->subject($dataa['subject']);
        });

        
        $m_a = new mentor_application();

        $m = Application::find($request->id);

        $m_a->name = $m->name;
        $m_a->email = $m->email;
        $m_a->age = $m->age;
        $m_a->education = $m->education;
        $m_a->purpose = $m->purpose;
        $m_a->mentor_id = $m->mentor_id;

        $m_a->save();


        // $m = Application::find($request->id);
        $m->delete();
        return redirect('/app')->with('success', 'Application was accepted successfully');
       





    }
}
