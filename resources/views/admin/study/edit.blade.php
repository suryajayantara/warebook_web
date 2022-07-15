<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{ route('studies.update', $study_data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="m-3">
                    {{-- nama jurusan --}}
                    <div class="form-group row">
                        <label for="exampleInputEmail1" class="form-label">Nama Jurusan</label>
                        <select name="departement_id" id="id_faculty" class="form-control @error('departement_id') is-invalid @enderror" aria-label="Default select example" required>
                            <option value="" selected>Pilih Jurusan</option>
                            @foreach ($departement_data as $departement)
                            <option value="{{ $departement->id }}" {{ ($departement->id = $study_data->departement_id) ? 'selected' : ''}}>{{ $departement->departement_name }}</option>
                            @endforeach
                        </select>
                        @error('departement_id')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- nama departement --}}
                    <div class="form-group row">
                        <label for="exampleInputEmail1" class="form-label">Nama Program Studi</label>
                        <input name="studies_name" type="Name" class="form-control @error('studies_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $study_data->studies_name }}" required>
                        @error('studies_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- deskripsi --}}
                    <div class="form-group row">
                        <textarea name="desc" class="form-control" id="floatingTextarea2" style="height: 100px" required>{{ $study_data->desc }}</textarea>
                    </div>

                    {{-- simpan --}}
                    <div class="form-group row">
                        <button type="submit" class="btn btn-lg btn-success w-100 mt-3">Simpan</button>
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
