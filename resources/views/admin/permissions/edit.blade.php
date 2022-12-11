<x-admin-master>
    @section('content')
        @if(session('permission-updated'))
            <div class="alert alert-success">{{ Session('permission-updated') }}</div>
        @endif

        <h1>Edit permissions: {{ $permission->name }}</h1>
        {!! Form::open(['method'=>'put','files'=>true,'route'=>['permissions.update',$permission->id]]) !!}

        <div class="form-group">

            {!! Form::label('name','name:') !!}
            {!! Form::text('name',$permission->name,
                [
                    'class'=>'form-control',
                    'id'=>'name',
                    'aria-describedby'=>'',
                    'placeholder'=>'Enter name',
                ]
            ) !!}

        </div>

        <div class="form-group">
            {!! Form::submit('Update permissions',['class'=>'btn btn-primary']) !!}
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


    @endsection
</x-admin-master>
