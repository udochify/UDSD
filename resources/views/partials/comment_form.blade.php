<div class="comment-form">
    
    {!! Form::open(['route' => ['blog.comment.store', $id]], ['class' => 'form']) !!}
    <div class="form-group">
        {!! Form::label('comment', 'Post a Comment',
            [
                'class' => 'comment-title'
            ]) 
        !!}
        {!! Form::textarea('comment', null, 
            [
                'class' => 'form-control input-lg', 
                'placeholder' => 'Enter comment here'
            ])
        !!}
        {!! Form::hidden('commenter', $uname) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Post Comment',
            [
                'class' => 'btn btn-info btn-lg btn-comment',
            ])
        !!}
    </div>
    {!! Form::close() !!}
</div>