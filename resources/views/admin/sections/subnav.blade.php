@if(isset($subnavStates) && isset($subnavLinks))
    @forelse($subnavStates as $key=>$value)
        <a class="{{ $value }}" href="{{ $subnavLinks[$key] }}"><div>{{ $key }}</div></a>
    @empty
    @endforelse
@endif
