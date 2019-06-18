<div id="post-edit-form">
    
    {!! Form::model($page, ['method' => 'post', 'route' => ['page.store'], 'class' => 'form']) !!}
    <div class="form-group">
        {!! Form::hidden('name', $page->name) !!}
        {!! Form::label('post', 'Create Page',
            [
                'class' => 'control-label'
            ]) 
        !!}
        {!! Form::textarea('post', null, 
            [
                'name' => 'content',
                'class' => 'form-control input-lg', 
                'placeholder' => 'Enter page content here'
            ])
        !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Submit Page',
            [
                'class' => 'btn btn-info btn-lg',
            ])
        !!}
    </div>
    {!! Form::close() !!}
</div>