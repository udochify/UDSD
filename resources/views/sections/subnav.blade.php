<?php
    $mycategory = '';
    if(isset($_GET['posttype']))
    {
        $mycategory = $_GET['posttype'];
    }
    if(isset($posttype))
    {
        $mycategory = $posttype;   
    }
    // dd($mycategory);
?>
@if(isset($subnavStates) && isset($subnavLinks))
    @forelse($subnavStates as $key=>$value)
        @if($key == 'Category')
        <a class='{{ $value }}'>
            <div id='selectCategoryDiv'>
                @if(count($categories) > 1)
                {!! Form::open(['method' => 'get', 'route' => ['blog.category'], 'class' => 'form active']) !!}
                    <select id="postCategory" name='posttype'>
                        <option <?php if($mycategory == '') echo "selected='selected'"; ?> disabled='disabled' class='category' value=''>Category</option>
                        <option <?php if($mycategory != '') echo "selected='selected'"; ?> class='category' value='{{ $mycategory }}'>{{ $mycategory }}</option>
                        @forelse($categories as $category)
                        @if($category != $mycategory)
                        <option <?php if($mycategory == $category) echo "selected='selected'"; ?> class='category' value='{{ $category }}'>{{ $category }}</option>
                        @endif
                        @empty
                        @endforelse
                    </select>               
                    {!! Form::submit('GO',
                        [
                            'class' => 'btnCategory',
                        ])
                    !!}
                {!! Form::close() !!}
                @else
                {{ $categories[0] }}
                @endif
            </div>
        </a>
        @else
        <a class="{{ $value }}" href="{{ $subnavLinks[$key] }}"><div>{{ $key }}</div></a>
        @endif
    @empty
    @endforelse
@endif