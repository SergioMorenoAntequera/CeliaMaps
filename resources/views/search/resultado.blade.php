

@if(count($streetName))
    @foreach ($streetName as $item)
    <div id="resultado">
        {{$item->name}}
    </div>
        
    @endforeach
@endif


