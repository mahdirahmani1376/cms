<x-admin-master>

    @section('content')

        <h1>User Profile for : {{ $user->name }}</h1>

        <div class="row">
            <div class="col-sm-6">
                {!! Form::open(['method'=>'put','enctype'=>'multipart/form-data','route'=>['user.profile.update',$user]]) !!}
                <div class="mb-4">
                        <img height="50" class="img-profile rounded-circle" src="{{ $user->avatar }}">
                </div>

                <div class="form-group">
                    {!! Form::file('avatar') !!}
                </div>

                <div class="form-group">
                    {!! Form::label('name','Name:') !!}
                    {!! Form::text('name',$user->username,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email','Email:') !!}
                    {!! Form::text('email',$user->email,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password','Password:') !!}
                    {!! Form::password(null,['name'=>'password','class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password_confirmation','password confirmation:') !!}
                    {!! Form::password(null,['name'=>'password_confirmation','class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Update') !!}
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
            </div>
        </div>

    @endsection

</x-admin-master>
