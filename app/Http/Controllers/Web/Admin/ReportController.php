<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternalResearch;
use App\Models\JournalDocument;
use App\Models\StudentCreativityProgram;
use App\Models\Thesis;
use Carbon\Carbon;
use Illuminate\Http\Request;

use PDF;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type =  $request->type;
        $date_start =  $request->date_start;
        $date_end =  $request->date_end;
        $data = Thesis::where('id', 'iqw')->paginate(3);
        if($date_end){
            $date_end = Carbon::createFromFormat('Y-m-d', $date_end);
        }

        if ($type || $date_start || $date_end) {
            $request->validate([
                'type' => 'required',
                'date_start' => 'required',
                'date_end' => 'required',
            ]);
        }

        if ($type == 'thesis') {
            $data = Thesis::where('created_at', '>=', $date_start)->where('created_at', '<=', $date_end)->paginate(5);
        } elseif ($type == 'pkm') {
            $data = StudentCreativityProgram::where('created_at', '>=', $date_start)->where('created_at', '<=', $date_end)->paginate(5);
        } elseif ($type == 'journal') {
            $data = JournalDocument::where('created_at', '>=', $date_start)->where('created_at', '<=', $date_end)->paginate(5);
        } elseif ($type == 'internal') {
            $data = InternalResearch::where('created_at', '>=', $date_start)->where('created_at', '<=', $date_end)->paginate(5);
        }

        return view('admin.report.index', compact('data', 'type', 'date_start', 'date_end'));
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
        $request->validate([
            'type' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

        $type =  $request->type;
        $date_start =  $request->date_start;
        $date_end =  $request->date_end;

        if ($type == 'thesis') {
            $data = Thesis::where('created_at', '>=', $date_start)->where('created_at', '<=', $date_end)->get();
        } elseif ($type == 'pkm') {
            $data = StudentCreativityProgram::where('created_at', '>=', $date_start)->where('created_at', '<=', $date_end)->get();
        } elseif ($type == 'journal') {
            $data = JournalDocument::where('created_at', '>=', $date_start)->where('created_at', '<=', $date_end)->get();
        } elseif ($type == 'internal') {
            $data = InternalResearch::where('created_at', '>=', $date_start)->where('created_at', '<=', $date_end)->get();
        }

        $pdf = PDF::loadView('admin.report.print', [
            'data' => $data,
            'type' => $type,
            'date_start' => $date_start,
            'date_end' => $date_end,
        ]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('test.pdf');
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
        //
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
