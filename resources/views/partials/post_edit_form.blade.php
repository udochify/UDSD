<div id="post-edit-form">
    
    {!! Form::model($post, ['method' => 'put', 'route' => ['blog.update', $post->id], 'class' => 'form comment-form']) !!}
    <div class="form-group">
        {!! Form::label('posttitle', 'Edit Post Title',
            [
                'class' => 'control-label'
            ]) 
        !!}
        {!! Form::textarea('posttitle', $post->posttitle, 
            [
                'class' => 'form-control input-lg', 
                'placeholder' => 'Enter title here'
            ])
        !!}
        {!! Form::label('post', 'Edit Post',
            [
                'class' => 'control-label'
            ]) 
        !!}
        {!! Form::textarea('post', $post->post, 
            [
                'class' => 'form-control input-lg', 
                'placeholder' => 'Enter post here'
            ])
        !!}
        {!! Form::hidden('editauthor', $uname) !!}
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