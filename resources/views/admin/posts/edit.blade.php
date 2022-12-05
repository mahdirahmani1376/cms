<x-admin-master>
    @section('content')
        @if(session('post-updated-message'))
            <div class="alert alert-success">{{ Session('post-updated-message') }}</div>
        @endif

        <h1>Edit a Post</h1>
        {!! Form::open(['method'=>'patch','files'=>true,'route'=>['post.update',$post->id]]) !!}

        <div class="form-group">

            {!! Form::label('title','Title:') !!}
            {!! Form::text('title',$post->title,
                [
                    'class'=>'form-control',
                    'id'=>'title',
                    'aria-describedby'=>'',
                    'placeholder'=>'Enter title',
                ]
            ) !!}

        </div>
        <div class="form-group">

            {!! Form::label('file','File:') !!}
            <div><img height="100px" src="{{ $post->post_image }}" alt=""></div>
            {!! Form::file('post_image',['class'=>'form-control','id'=>'post_image']) !!}

        </div>

        <div class="form-group">
            {!! Form::textarea('body',$post->body,['class'=>'form-control','id'=>'body','cols'=>'30','rows'=>'10']) !!}
        </div>


        <div class="form-group">
            {!! Form::submit('Update Post',['class'=>'btn btn-primary']) !!}
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
