<x-admin-master>
    @section('content')
        <h1>Users</h1>

        @if(session('user-deleted'))
            <div class="alert alert-danger">{{ session('user-deleted') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Avatar</th>
                            <th>Registered data</th>
                            <th>Updated profile data</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Avatar</th>
                            <th>Registered data</th>
                            <th>Updated profile data</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td><img height="50px" src="{{ $user->avatar }}" alt=""></td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                                <td>
                                    {!! Form::open(['route'=>['user.destroy',$user->id],'method'=>'DELETE']) !!}
                                    {!! Form::submit("Delete",["class"=>"btn btn-danger"]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @endsection
</x-admin-master>
