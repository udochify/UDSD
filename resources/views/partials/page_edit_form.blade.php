<div id="post-edit-form">
    
    {!! Form::model($page, ['method' => 'put', 'route' => ['page.update', $page->id], 'class' => 'form']) !!}
    <div class="form-group">
        {!! Form::label('post', 'Edit Post',
            [
                'class' => 'control-label'
            ]) 
        !!}
        {!! Form::textarea('post', $page->content, 
            [
                'name' => 'content',
                'class' => 'form-control input-lg', 
                'placeholder' => 'Enter comment here'
            ])
        !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update Page',
            [
                'class' => 'btn btn-info btn-lg',
            ])
        !!}
    </div>
    {!! Form::close() !!}
</div>