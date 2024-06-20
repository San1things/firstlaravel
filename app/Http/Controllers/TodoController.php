<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array();
        $data['to_dos'] = DB::table('to_dos')
            ->get()->toArray();

        return view('home', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->input();
        DB::table('to_dos')
            ->insert([
                'title' => $input['title'],
                'description' => $input['description'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $input = $request->input();
        DB::table('to_dos')
        ->where('id', $input['id'])
            ->update([
                'title' => $input['title'],
                'description' => $input['description'],
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
        return redirect('/');
    }

    public function complete(Request $request)
    {
        $input = $request->query();
        DB::table('to_dos')
        ->where('id', $input['id'])
            ->update([
                'status' => 'complete',
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $input = $request->query();
        DB::table('to_dos')
        ->where('id', $input['id'])
            ->delete();
        return redirect('/');
    }
}
