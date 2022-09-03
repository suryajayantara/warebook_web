<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th {
        padding: 8px 8px;
        border: 1px solid #000000;
        text-align: center;
    }

    .table td {
        padding: 3px 6px;
        border: 1px solid #000000;
    }

    .text-center {
        text-align: center;
    }
</style>

<body>
    <center>
        <h2>Laporan
            @if ($type == 'thesis')
                {{ 'Tesis' }}
            @else
                @if ($type == 'pkm')
                    {{ 'Program Kreativitas Mahasiswa' }}
                @else
                    @if ($type == 'journal')
                        {{ 'Jurnal Dosen' }}
                    @else
                        @if ($type == 'internal')
                            {{ 'Penelitian dan Pengabdian Dosen' }}
                        @else
                        @endif
                    @endif
                @endif
            @endif
            PNB <i>Repository</i>
        </h2>

    </center>

    <div class="center">
        <table>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ date('D, d F Y', strtotime($date_start)) }} - {{ date('D, d F Y', strtotime($date_end)) }}</td>
            </tr>
        </table>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Pengupload</th>
                    <th>Tahun</th>
                    <th>Tanggal Upload</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            @if ($type == 'internal')
                                {{ $item->team_member }}
                            @else
                                {{ $item->author }}
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($type == 'journal')
                                {{ $item->user->name }}
                            @else
                                {{ $item->users->name }}
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($type == 'thesis')
                                {{ $item->created_year }}
                            @else
                                @if ($type == 'internal')
                                    {{ $item->project_finish_at }}
                                @else
                                    {{ $item->year }}
                                @endif
                            @endif
                        </td>
                        <td class="text-center">{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
