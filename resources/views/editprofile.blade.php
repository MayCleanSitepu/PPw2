@extends('auth.layouts')

@section('content')
<form method="POST" action="{{ route('update-profile', ['id' => $user->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <!-- Tambahkan bidang lain yang ingin diedit -->
    <div class="mb-3 mt-3 col">
        <label for="photo" class=" col-form-label text-md-end text-start">Edit Photo</label>
        <div class="col-md-6">
            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo') }}">
            @if ($errors->has('photo'))
                <span class="text-danger">{{ $errors->first('photo') }}</span>
            @endif
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection

