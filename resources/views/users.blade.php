@extends('auth.layouts')

@section('content')
<!-- {{Auth::check()}} -->
    <div class="container">
        <h2>User List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->photo)
                        <img src="{{ asset('storage/public/photos/'.$user->photo) }}" width="50px" height="50px">
                    @else
                        No Photo
                    @endif
                </td>
                <td>
                <a href="{{ route('edit-profile', ['id' => $user->id]) }}" class="btn btn-primary">Edit</a>
                </td>


            </tbody>
        </table>
    </div>
@endsection
