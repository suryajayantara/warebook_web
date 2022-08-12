<?php

namespace App\Http\Controllers\Web\Admin\InternalResearch;

use App\Http\Controllers\Controller;
use App\Models\InternalResearch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InternalResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = InternalResearch::paginate(6);
        return view('admin.internalResearch.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data = InternalResearch::where('title', 'LIKE', '%'.$request->search.'%')->orWhere('tags', 'LIKE', '%'.$request->search.'%')->orWhere('author', 'LIKE', '%'.$request->search.'%')->orWhere('year', 'LIKE', '%'.$request->search.'%')->paginate(6);
        return view('admin.journal.document.index',   compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= InternalResearch::find($id);
        return view('admin.internalResearch.edit')->with(compact('data'));
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
        // var_dump($request);
        
        $request->validate([
            'title' => 'required',
            'abstract' => 'required',
            'budget_type' => 'required',
            'budget' => 'required',
            'project_started_at' => 'required',
            'project_finished_at' => 'required',
            'contract_number' => 'required',
            'team_member' => 'required'
        ]);

        $data=InternalResearch::find($id);

        $proposal_url = $data->proposal_url;
        $document_url = $data->document_url;

        if($request->hasFile('proposal_url')){
            Storage::disk('public')->delete(str_replace('storage/', '', $data->proposal_url));
            
            $title = str_replace(' ', '_', $request->title);
            $proposal_url =  Auth::user()->id. date('dmY') . $title . '.'. $request->file('proposal_url')->extension();
            $request->file('proposal_url')->storeAs('internalResearch/proposal/', $proposal_url, 'public');
            $proposal_url = 'storage/internalResearch/proposal/'. $proposal_url;
        }

        if($request->hasFile('document_url')){
            Storage::disk('public')->delete(str_replace('storage/', '', $data->document_url));
            
            $title = str_replace(' ', '_', $request->title);
            $document_url =  Auth::user()->id. date('dmY') . $title . '.'. $request->file('document_url')->extension();
            $request->file('document_url')->storeAs('internalResearch/document/', $document_url, 'public');
            $document_url = 'storage/internalResearch/document/'. $document_url;
        }

        try {
            
            InternalResearch::where('id', $id)->update([
                'title' => $request->title,
                'abstract' => $request->abstract,
                'budget_type' => $request->budget_type,
                'budget' => $request->budget,
                'project_started_at' => $request->project_started_at,
                'project_finish_at' => $request->project_finished_at,
                'contract_number' => $request->contract_number,
                'team_member' => $request->team_member,
                'proposal_url' => $proposal_url,
                'document_url' => $document_url,
            ]);

            return redirect()->route('manageInternalResearch.index');

        } catch (\Throwable $th) {
            var_dump($th);
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
            $data=InternalResearch::find($id);

            Storage::disk('public')->delete(str_replace('storage/', '', $data->document_url));
            Storage::disk('public')->delete(str_replace('storage/', '', $data->proposal_url));
            InternalResearch::destroy($id);
            
            return redirect()->route('lectureRepository.index');
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }
}
