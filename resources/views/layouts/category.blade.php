@if(count($categories))
    @foreach($categories as $category)
        @if($category->parent)
            {{ '' }} 
        @else
            {{-- <li class="nav-item dropdown">
                <a class="nav-link" href="/{{ $category->slug }}">{{ $category->name }}</a>
            </li> --}}
            {{ '' }}            
        @endif
        @if (count($category->children) > 0)
            @foreach ($category->children as $child)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/{{ $category->slug }}">{{ $category->name }}</a>
                    <a  href="/{{ $category->slug }}" id="dropdown{{ $category->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown{{ $category->id }}">
                        <a class="dropdown-item" href="{{ $child->slug }}">{{ $child->name }}</a>
                    </div>                    
                </li>
            @endforeach
        @endif
    @endforeach
@endif