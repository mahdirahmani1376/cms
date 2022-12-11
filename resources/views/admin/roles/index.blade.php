<x-admin-master>
    @section('content')

        <div class="row">
            @if(session()->has('role-delete'))
                <div class="alert alert-danger">
                    {{ session('role-delete') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-sm-3">
                <form action="{{ route('roles.store') }}" method="Post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">

                        <div>
                            @error('name')
                                <span><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                    </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>

            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td><a href="{{ route('roles.edit', $role->id)}}">{{ $role->name }}</a></td>
                                        <td>{{ $role->slug }}</td>
                                        <td>
                                            {!! Form::open(['method'=>'delete','route'=>['roles.destroy',$role->id]]) !!}
                                                <div class="form-group">
                                                    {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                                                </div>
                                            {!! Form::close() !!}

                                            @if(count($errors) > 0)

                                                <div class="alert alert-danger">
                                                    <ul>

                                                        @foreach($errors->all() as $error)

                                                            <li>
                                                                {{ $error }}
                                                            </li>

                                                        @endforeach

                                                    </ul>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
</x-admin-master>
