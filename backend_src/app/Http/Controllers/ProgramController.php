<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgram;
use App\Http\Requests\UpdateProgram;
use App\Models\Program;
use Illuminate\Http\Response;
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
        $userPrograms = $user->programs;

        return response($userPrograms, Response::HTTP_OK);
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

        return response($newProgram, Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProgram $request
     * @param Program $program
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgram $request, Program $program)
    {
        $program->name = $request->get('name');
        $program->program = $request->get('program');
        $program->save();

        return response($program, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Program $program
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return response([], Response::HTTP_OK);
    }
}
