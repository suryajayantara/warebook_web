<?php

namespace App\Http\Controllers\Web\Journal;

use App\Http\Controllers\Controller;
use App\Models\JournalTopic;
use App\Models\JournalType;
use App\Models\User;
use Illuminate\Http\Request;

class JournalTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JournalTopic::all();
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
        $journalType = JournalType::all();
        return view('admin.departement.add')->with(compact('journalType','users'));
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
            'journal_types_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'thumbnail_url' => 'required',
        ]);

        try {
            $thumbnail = $request->file('thumbnail_url');
            $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();

            JournalTopic::create([
                'users_id' => $request->users_id,
                'journal_types_id' => $request->journal_types_id,
                'title' => $request->title,
                'description' => $request->description,
                'thumbnail_url' => 'img/journal/thumbnail/'.$thumbnail_name,
            ]);

            $thumbnail->move('img/journal/thumbnail/',$thumbnail_name);
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
        $journalTopic = JournalTopic::find($id);
        $users = User::all();
        $journalType = JournalType::all();
        return view('admin.departement.add')->with(compact('journalType','users','journalTopic'));
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
            $data = JournalTopic::find($id);
            $update = [
                'users_id' => $request->users_id,
                'journal_types_id' => $request->journal_types_id,
                'title' => $request->title,
                'description' => $request->description,
            ];

            if($request->file('thumbnail_url') !== NULL){
                $thumbnail = $request->file('thumbnail_url');
                $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();
                $update = [
                    'thumbnail_url' => 'img/journal/thumbnail/'.$thumbnail_name,
                ];

                unlink($data['thumbnail_url']);
                //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder img/internalResearch/thumbnail
                $thumbnail->move('img/journal/thumbnail/',$thumbnail_name);
            }

            JournalTopic::find($id)->update($update);
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
            $data = JournalTopic::find($id);
            unlink($data['thumbnail_url']);
            $data = JournalTopic::destroy($id);
            return redirect()->route('admin.departements.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
