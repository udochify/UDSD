<span id='homeRoute' class='routes'>
    <a class='urlRoute' href="{{ route('home.index') }}">
    </a>
    <a class='ajaxRoute' href="{{ route('home.load') }}">
    </a>
</span>
<span id='blogRoute' class='routes'>
    <a class='urlRoute' href="{{ route('blog.index') }}">
    </a>
    <a class='ajaxRoute' href="{{ route('blog.load') }}">
    </a>
</span>
@forelse($widgetPosts as $post)
<span id='blogRoute{{ $post->id }}' class='routes'>
    <a class='urlRoute' href="{{ route('blog.show', ['blog'=>$post]) }}">
    </a>
    <a class='ajaxRoute' href="{{ route('blog.get', ['blog'=>$post]) }}">
    </a>
</span>
<span id='commentRoute{{ $post->id }}' class='routes'>
    <a class='urlRoute' href="{{ route('blog.comment.store', ['blog'=>$post]) }}">
    </a>
    <a class='ajaxRoute' href="{{ route('blog.comment.ajaxStore', ['blog'=>$post]) }}">
    </a>
</span>
@empty
@endforelse
<span id='workRoute' class='routes'>
    <a class='urlRoute' href="{{ route('blog.work') }}">
    </a>
    <a class='ajaxRoute' href="{{ route('blog.ajaxWork') }}">
    </a>
</span>
@forelse($pageNames as $name)
<span id='{{$name}}PageRoute' class='routes'>
    <a class='urlRoute' href="{{ route('page.open', ['name'=>$name]) }}">
    </a>
    <a class='ajaxRoute' href="{{ route('page.load', ['name'=>$name]) }}">
    </a>
</span>
@empty
@endforelse
<span id='categoryRoute' class='routes'>
    <a class='urlRoute' href="{{ route('blog.category') }}">
    </a>
    <a class='ajaxRoute' href="{{ route('blog.ajaxCategory') }}">
    </a>
</span>
<span id='archiveRoute' class='routes'>
    <a class='urlRoute' href="{{ route('archive.index') }}">
    </a>
    <a class='ajaxRoute' href="{{ route('archive.load') }}">
    </a>
</span>
<span id='calendarRoute' class='routes'>
    <a class='urlRoute' href="{{ route('calendar.index') }}">
    </a>
    <a class='ajaxRoute' href="{{ route('calendar.load') }}">
    </a>
</span>