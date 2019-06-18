<div class="new-post-form">
    
    {!! Form::open(['route' => ['blog.create', $id]], ['class' => 'form']) !!}
    <div class="form-group">
        {!! Form::label('title', 'Post Title',
            [
                'class' => 'control-label'
            ]) 
        !!}
        {!! Form::text('title', null, 
            [
                'class' => 'form-control input-lg', 
                'placeholder' => 'Enter Title of Post'
            ])
        !!}
    </div>
    <div class="form-group">
        {!! Form::label('post', 'Post Content',
            [
                'class' => 'control-label'
            ]) 
        !!}
        {!! Form::textarea('post', null, 
            [
                'class' => 'form-control input-lg', 
                'placeholder' => 'Create new Post'
            ])
        !!}
        <script>CKEDITOR.replace('comment{{ $post->id }}');</script>
        {!! Form::hidden('poster', $uname) !!}
        {!! Form::hidden('id', $id) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create Post',
            [
                'class' => 'btn btn-info btn-lg',
            ])
        !!}
    </div>
    {!! Form::close() !!}
</div>