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
            'proposal_url' => 'required',
            'document_url' => 'required',
        ]);

        //request untuk menguload dalam bentuk file
        $thumbnail = $request->file('thumbnail_url');
        $proposal = $request->file('proposal_url');
        $document = $request->file('document_url');

        //request untuk mengubah nama file berdasarkan judul atau title internal research pada strtolower($request->title)
        //selanjutnya ditambah nama -img-thumbnail dan tambahan format asli pada file tersebut seperti .pdf, .png dll
        //getClientOriginalExtension digunakan untuk mencari format asli pada file
        $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();
        $proposal_name = strtolower($request->title)."-file-proposal.".$proposal->getClientOriginalExtension();
        $document_name = strtolower($request->title)."-file-document.".$document->getClientOriginalExtension();

        try {
            InternalResearch::create([
                'users_id' => $request->users_id,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'thumbnail_url' => $thumbnail_name,
                'budget_type' => $request->budget_type,
                'budget' => $request->budget,
                'project_started_at' => $request->project_started_at,
                'project_finish_at' => $request->project_finish_at,
                'contract_number' => $request->contract_number,
                'team_member' => $request->team_member,
                'proposal_url' => $proposal_name,
                'document_url' => $document_name,
            ]);

            //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder yang telah ditentukan
            $thumbnail->move('img/internalResearch/thumbnail/',$thumbnail_name);
            $proposal->move('files/internalResearch/',$proposal_name);
            $document->move('files/internalResearch/',$document_name);

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
            $data=InternalResearch::find($id);

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


            if($request->file('thumbnail_url') !== NULL){
                $thumbnail = $request->file('thumbnail_url');
                $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();
                $update = [
                    'thumbnail_url' => $thumbnail_name,
                ];

                unlink('img/internalResearch/thumbnail/'.$data['thumbnail_url']);
                //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder img/internalResearch/thumbnail
                $thumbnail->move('img/internalResearch/thumbnail/',$thumbnail_name);
            }

            if($request->file('proposal_url') !== NULL){
                $proposal = $request->file('proposal_url');
                $proposal_name = strtolower($request->title)."-file-proposal.".$proposal->getClientOriginalExtension();
                $update = [
                    'proposal_url' => $proposal_name,
                ];
                unlink('files/internalResearch/'.$data['proposal_url']);
                $proposal->move('files/internalResearch/',$proposal_name);
            }

            if($request->file('document_url') !== NULL){
                $document = $request->file('document_url');
                $document_name = strtolower($request->title)."-file-document.".$document->getClientOriginalExtension();
                $update = [
                    'document_url' => $document_name,
                ];

                unlink('files/internalResearch/'.$data['document_url']);

                $document->move('files/internalResearch/',$document_name);
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
            unlink('img/internalResearch/thumbnail/'.$data['thumbnail_url']);
            unlink('files/internalResearch/'.$data['proposal_url']);
            unlink('files/internalResearch/'.$data['document_url']);
            $data = InternalResearch::destroy($id);
            return redirect()->route('admin.departements.index');
        } catch (\Throwable $th) {
            // echo 'gagal';
        }
    }
}
