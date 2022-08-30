<?php

namespace App\Http\Controllers\Web\Admin\StudentCreativityProgram;

use App\Http\Controllers\Controller;
use App\Models\StudentCreativityProgram;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentCreativityProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session('page', 'tes');
        $data = StudentCreativityProgram::paginate(5);
        return view('admin.creativity.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.creativity.add');
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
            'creativity_type' => 'required',
            'aliases' => 'required',
            'title' => 'required',
            'abstract' => 'required',
            'year' => 'required',
            'supervisor' => 'required',
            'document_url' => 'required',
            'author' => 'required'
        ]);


        //Upload file document
        $title = str_replace(' ', '_', $request->title);
        $document_url =  Auth::user()->id . date('dmY') . $title . '.' . $request->file('document_url')->extension();
        $request->file('document_url')->storeAs('creativityDocument/', $document_url, 'public');
        $document_url = 'storage/creativityDocument/' . $document_url;

        var_dump($request->year);
        try {
            StudentCreativityProgram::create([
                'users_id' => Auth::user()->id,
                'author' => $request->author,
                'creativity_type' => $request->creativity_type,
                'aliases' => $request->aliases,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'year' => $request->year,
                'supervisor' => $request->supervisor,
                'document_url' => $document_url
            ]);

            return redirect()->route('manageCreativity.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = StudentCreativityProgram::where('title', 'LIKE', '%' . $request->search . '%')->orWhere('supervisor', 'LIKE', '%' . $request->search . '%')->paginate(6);
        return view('admin.creativity.index',   compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = StudentCreativityProgram::find($id);
        return view('admin.creativity.edit', compact('data'));
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
        $request->validate([
            'creativity_type' => 'required',
            'aliases' => 'required',
            'title' => 'required',
            'abstract' => 'required',
            'year' => 'required',
            'supervisor' => 'required',
        ]);

        $data = StudentCreativityProgram::find($id);

        $document_url = $data->document_url;

        if ($request->hasFile('document_url')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $data->document_url));

            $title = str_replace(' ', '_', $request->title);
            $document_url =  Auth::user()->id . date('dmY') . $title . '.' . $request->file('document_url')->extension();
            $request->file('document_url')->storeAs('creativityDocument/', $document_url, 'public');
            $document_url = 'storage/creativityDocument/' . $document_url;
        }

        try {
            StudentCreativityProgram::where('id', $id)->update([
                'creativity_type' => $request->creativity_type,
                'aliases' => $request->aliases,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'year' => $request->year,
                'supervisor' => $request->supervisor,
                'document_url' => $document_url
            ]);

            return redirect()->route('manageCreativity.index')->with('success', 'Data Berhasil Diubah');
        } catch (\Throwable $th) {
            throw $th;
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
            $data = StudentCreativityProgram::find($id);
            Storage::disk('public')->delete(str_replace('storage/', '', $data->document_url));
            StudentCreativityProgram::destroy($id);
            return redirect()->route('manageCreativity.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
