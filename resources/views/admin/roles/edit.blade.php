<x-admin-master>
    @section('content')
        @if(session('roles-updated'))
            <div class="alert alert-success">{{ Session('roles-updated') }}</div>
        @endif

        <h1>Edit roles: {{ $roles->name }}</h1>
        {!! Form::open(['method'=>'put','files'=>true,'route'=>['roles.update',$roles->id]]) !!}

        <div class="form-group">

            {!! Form::label('name','name:') !!}
            {!! Form::text('name',$roles->name,
                [
                    'class'=>'form-control',
                    'id'=>'name',
                    'aria-describedby'=>'',
                    'placeholder'=>'Enter name',
                ]
            ) !!}

        </div>

        <div class="form-group">
            {!! Form::submit('Update roles',['class'=>'btn btn-primary']) !!}
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

        <div class="row">

            <div class="col-lg-12">
                @if($permissions->isNotEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Options</th>
                                        <th>Id</th>
                                        <th>Owner</th>
                                        <th>Title</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Options</th>
                                        <th>Id</th>
                                        <th>Owner</th>
                                        <th>Title</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>
                                                <input
                                                    type="checkbox"
                                                @foreach($roles->permissions as $role_permission)
                                                    @if($role_permission->id == $permission->id)
                                                        checked
                                                    @endif
                                                @endforeach

                                                >

                                            </td>
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name}}</td>
                                            <td>{{ $permission->slug }}</td>
                                            <td>
                                                <form method="post" action="{{ route('roles.permissions.attach', $roles) }}">
                                                @method('put')
                                                @csrf
                                                <input type="hidden" name="permission" value="{{ $permission->id}}">
                                                    <button type="submit" class="btn btn-info"
                                                        @if($roles->permissions->contains($permission))
                                                            disabled
                                                        @endif
                                                        >
                                                        Attach
                                                    </button>


                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" action="{{ route('roles.permissions.detach', $roles) }}">
                                                    @method('put')
                                                    @csrf
                                                    <input type="hidden" name="permission" value="{{ $permission->id}}">
                                                    <button type="submit" class="btn btn-danger"
                                                            @if(!$roles->permissions->contains($permission))
                                                                disabled
                                                        @endif
                                                    >
                                                        Detach
                                                    </button>


                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                 @endif
            </div>
        </div>

    @endsection
</x-admin-master>
