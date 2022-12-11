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

            <div class="col-sm-12">
                Roles
                <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <td>Options</td>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Slug</td>
                        <td>Attach</td>
                        <td>Detach</td>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td>Options</td>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Slug</td>
                        <td>Attach</td>
                        <td>Detach</td>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td><input type="checkbox"
                            @foreach ($user->roles as $user_role)
                                @if($user_role->slug == $role->slug)
                                    checked
                               @endif
                            @endforeach
                            ></td>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->slug }}</td>
                        <td>
                            <form action="{{ route('user.role.attach',$user) }}" method="post">
                                @method('put')
                                @csrf

                                <input type="hidden" name="role" value="{{ $role->id }}">
                                <button type="submit" class="btn btn-primary"
                                @if($user->roles->contains($role))
                                    disabled
                                @endif
                                >Attach</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('user.role.detach',$user) }}" method="post">
                                @method('put')
                                @csrf

                                <input type="hidden" name="role" value="{{ $role->id }}">
                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                    @if(!$user->roles->contains($role))
                                        disabled
                                    @endif
                                >Detach</button>
                            </form>
                        </td>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endsection

</x-admin-master>
