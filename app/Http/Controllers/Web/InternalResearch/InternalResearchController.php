<?php

namespace App\Http\Controllers\Web\InternalResearch;

use App\Http\Controllers\Controller;
use App\Models\InternalResearch;
use App\Models\User;
use Illuminate\Http\Request;
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
            'budget_type' => 'required',
            'budget' => 'required',
            'project_started_at' => 'required',
            'project_finish_at' => 'required',
            'contract_number' => 'required',
            'team_member' => 'required',
            'proposal_url' => 'required',
            'document_url' => 'required',
        ]);

        //Upload Document
        $file_name = date('Ymd').preg_replace('/\s+/','_',$request->title);
        $pathNameDoc = 'storage/internalResearch/document/';
        $pathNameProp = 'storage/internalResearch/proposal/';
        $document_url = $file_name.'.'.$request->file('document_url')->extension();
        $proposal_url = $file_name.'.'.$request->file('proposal_url')->extension();
        $request->file('document_url')->storeAs('internalResearch/document', $document_url, 'public');
        $request->file('proposal_url')->storeAs('internalResearch/proposal', $proposal_url, 'public');

        $finalPathDoc = $pathNameDoc . $document_url;
        $finalPathProp = $pathNameProp . $proposal_url;

        try {
            InternalResearch::create([
                'users_id' => $request->users_id,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'budget_type' => $request->budget_type,
                'budget' => $request->budget,
                'project_started_at' => $request->project_started_at,
                'project_finish_at' => $request->project_finish_at,
                'contract_number' => $request->contract_number,
                'team_member' => $request->team_member,
                'file_name_doc' => $document_url,
                'file_name_prop' => $proposal_url,
                'proposal_url' => $finalPathDoc,
                'document_url' => $finalPathProp,
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
            $data = InternalResearch::find($id);
            $update = [
                'users_id' => $request->users_id,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'budget_type' => $request->budget_type,
                'budget' => $request->budget,
                'project_started_at' => $request->project_started_at,
                'project_finish_at' => $request->project_finish_at,
                'contract_number' => $request->contract_number,
                'team_member' => $request->team_member,
                'contract_url' => $request->contract_url,

            ];

            //update data apabila menginputkan file di document_url
            if($request->hasFile('document_url')) {
                //digunakan untuk menghapus file beradasarkan id yang diinputkan
                Storage::disk('public')->delete('internalResearch/document/'.$data->file_name_doc);

                //Upload Document
                $file_name = date('Ymd').preg_replace('/\s+/','_',$request->title);
                $pathNameDoc = 'storage/internalResearch/document/';
                $document_url = $file_name.'.'.$request->file('document_url')->extension();
                $request->file('document_url')->storeAs('internalResearch/document', $document_url, 'public');

                $finalPathDoc = $pathNameDoc . $document_url;

                $update = [
                    'file_name_doc' => $document_url,
                    'proposal_url' => $finalPathDoc,
                ];
            }

            //update data apabila menginputkan file di document_url
            if($request->hasFile('document_url')) {
                //digunakan untuk menghapus file beradasarkan id yang diinputkan
                Storage::disk('public')->delete('internalResearch/proposal/'.$data->file_name_prop);

                //Upload Document
                $file_name = date('Ymd').preg_replace('/\s+/','_',$request->title);
                $pathNameProp = 'storage/thesisDocument/proposal/';
                $proposal_url = $file_name.'.'.$request->file('proposal_url')->extension();
                $request->file('proposal_url')->storeAs('internalResearch/proposal', $proposal_url, 'public');

                $finalPathProp = $pathNameProp . $proposal_url;

                $update = [
                    'file_name_prop' => $proposal_url,
                    'proposal_url' => $finalPathProp,
                ];
            }

            InternalResearch::find($id)->update($update);
            return redirect()->route('departements.index');

        } catch (\Throwable $th) {
            // return $th;
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
            $data = InternalResearch::find($id);
            //digunakan untuk menghapus file beradasarkan id yang diinputkan
            Storage::disk('public')->delete('internalResearch/document/'.$data->file_name_doc);
            Storage::disk('public')->delete('internalResearch/proposal/'.$data->file_name_prop);
            $data = InternalResearch::destroy($id);
            return redirect()->route('admin.departements.index');
        } catch (\Throwable $th) {
            // echo 'gagal';
        }
    }
}
