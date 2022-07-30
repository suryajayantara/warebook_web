<?php

namespace App\Http\Controllers\Web\InternalResearch;

use App\Http\Controllers\Controller;
use App\Models\InternalResearch;
use App\Models\User;
use Illuminate\Http\Request;

class InternalResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = InternalResearch::all();
        return view('admin.study.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.departement.add')->with(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required',
            'title' => 'required',
            'abstract' => 'required',
            'thumbnail_url' => 'required',
            'budget_type' => 'required',
            'budget' => 'required',
            'project_started_at' => 'required',
            'project_finish_at' => 'required',
            'contract_number' => 'required',
            'team_member' => 'required',
            'contract_url' => 'required',
            'proposal_url' => 'required',
            'document_url' => 'required',
        ]);

        try {
            InternalResearch::create([
                'users_id' => $request->users_id,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'thumbnail_url' => $request->thumbnail_url,
                'budget_type' => $request->budget_type,
                'budget' => $request->budget,
                'project_started_at' => $request->project_started_at,
                'project_finish_at' => $request->project_finish_at,
                'contract_number' => $request->contract_number,
                'team_member' => $request->team_member,
                'contract_url' => $request->contract_url,
                'proposal_url' => $request->proposal_url,
                'document_url' => $request->abstract,
            ]);
            return redirect()->route('departements.index');

        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $internalResearch =InternalResearch::find($id);
        $users = User::all();
        return view('admin.departement.add')->with(compact('users','internalResearch'));
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
        try {
            InternalResearch::find($id)->update([
                'users_id' => $request->users_id,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'thumbnail_url' => $request->thumbnail_url,
                'budget_type' => $request->budget_type,
                'budget' => $request->budget,
                'project_started_at' => $request->project_started_at,
                'project_finish_at' => $request->project_finish_at,
                'contract_number' => $request->contract_number,
                'team_member' => $request->team_member,
                'contract_url' => $request->contract_url,
                'proposal_url' => $request->proposal_url,
                'document_url' => $request->abstract,
            ]);
            return redirect()->route('departements.index');

        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            InternalResearch::find($id)->delete();
            return redirect()->route('admin.departements.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
