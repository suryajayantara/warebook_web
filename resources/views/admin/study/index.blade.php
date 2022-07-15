<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="row my-5 mx-auto">
        <div class="col-md-10">
            {{-- <form action="{{ url()->current() }}" method="GET">
                <div class="input-group mb-3">
                    <input name="cari" value="{{ request('cari') }}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Cari Departemen">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                </div>
            </form> --}}
        </div>
        <div class="col-md-2">
            <a href="{{ route('studies.create') }}" class="btn btn-success">Tambah Data</a>
        </div>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Jurusan</th>
            <th scope="col">Nama Program Study</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->departements->departement_name}}</td>
            <td>{{ $item->studies_name}}</td>
            <td>{{ $item->desc}}</td>
            <td class="row">
              <div class="mx-1 my-1">
                <a href="{{ route('studies.edit',$item->id) }}" class="btn btn-warning btn-sm">Edit</a>
              </div>
              <div class="mx-1 my-1">
                <form action="{{ route('studies.destroy',$item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick = "return confirm('Yakin hapus program study?')">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{-- <div class="d-flex justify-content-center">
        {{ $datas->links() }}
      </div> --}}

</body>
</html>

