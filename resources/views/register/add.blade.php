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
    <div class="card">
        <div class="card-body">

            <form enctype="multipart/form-data" action="{{ route('register.store') }}" method="post" >
                @csrf
                <div class="m-3">

                    {{-- Name --}}
                    <div class="form-group row">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input name="name" type="Name" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>

                    {{-- Password --}}
                    <div class="form-group row">
                        <label for="exampleInputEmail1" class="form-label">Password</label>
                        <input name="password" type="Name" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>

                    {{-- email --}}
                    <div class="form-group row">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input name="email" type="Name" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- unique_id --}}
                    <div class="form-group row">
                        <label for="exampleInputEmail1" class="form-label">Unique</label>
                        <input name="unique_id" type="Name" class="form-control @error('unique_id') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        @error('unique_id')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- nama jurusan --}}
                    <div class="form-group row">
                        <label for="exampleInputEmail1" class="form-label">Nama Jurusan</label>
                        <select name="departement_id"  class="form-control" aria-label="Default select example" required>
                            <option value="" selected>Pilih Jurusan</option>
                            @foreach ($departement_data as $departement)
                            <option value="{{ $departement->id }}">{{ $departement->departement_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- nama program study --}}
                    <div class="form-group row">
                        <label for="exampleInputEmail1" class="form-label">Nama Jurusan</label>
                        <select name="study_id"  class="form-control" aria-label="Default select example" required>
                            <option value="" selected>Pilih Jurusan</option>
                            @foreach ($studies_data as $item)
                                <option value="{{ $item->id }}">{{ $item->studies_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- tambah --}}
                    <div class="form-group row">
                        <button type="submit" class="btn btn-lg btn-primary w-100 mt-3">Tambah</button>
                    </div>

              </form>
            <a href="{{ route('studies.index') }}">
                {{-- kembali --}}
                <div class="form-group row">
                    <button type="button" class="btn btn-lg btn-danger w-100">Kembali</button>
                </div>
            </a>
        </div>
    </div>

</body>
</html>

