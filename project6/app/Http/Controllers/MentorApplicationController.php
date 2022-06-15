<?php

namespace App\Http\Controllers;

use App\Models\mentor_application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MentorApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $user)
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mentor_application  $mentor_application
     * @return \Illuminate\Http\Response
     */
    public function show(mentor_application $mentor_application)
    { 
        return view('pages.profile');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mentor_application  $mentor_application
     * @return \Illuminate\Http\Response
     */
    public function edit(mentor_application $mentor_application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mentor_application  $mentor_application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mentor_application $mentor_application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mentor_application  $mentor_application
     * @return \Illuminate\Http\Response
     */
    public function destroy(mentor_application $mentor_application)
    {
        $app=mentor_application::find($mentor_application);
    $app->delete();
        return redirect()->to('mapp.show')->with('success','Applicant has been deleted');
    }
}
