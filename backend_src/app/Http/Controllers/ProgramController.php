<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgram;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return $user->programs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProgram $request
     * @return void
     */
    public function store(StoreProgram $request)
    {
        $newProgram = new Program();
        $newProgram->name = $request->get('name');
        $newProgram->program = $request->get('program');

        $user = Auth::user();
        $user->programs()->save($newProgram);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
