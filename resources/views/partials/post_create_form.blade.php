<div id="post-edit-form">
    
    {!! Form::model($post, ['method' => 'post', 'route' => ['blog.store'], 'class' => 'form comment-form']) !!}
    <div class="form-group">
        {!! Form::label('posttype', 'Enter Post Category',
            [
                'class' => 'control-label'
            ]) 
        !!}
        {!! Form::textarea('posttype', null, 
            [
                'class' => 'form-control input-lg', 
                'placeholder' => 'Enter Category here'
            ])
        !!}
        {!! Form::label('posttitle', 'Enter Post Title',
            [
                'class' => 'control-label'
            ]) 
        !!}
        {!! Form::textarea('posttitle', null, 
            [
                'class' => 'form-control input-lg', 
                'placeholder' => 'Enter title here'
            ])
        !!}
        {!! Form::label('post', 'Create Post',
            [
                'class' => 'control-label'
            ]) 
        !!}
        {!! Form::textarea('post', null, 
            [
                'class' => 'form-control input-lg', 
                'placeholder' => 'Enter post here'
            ])
        !!}
        {!! Form::hidden('author', $uname) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Submit Post',
            [
                'class' => 'btn btn-info btn-lg',
            ])
        !!}
    </div>
    {!! Form::close() !!}
</div>