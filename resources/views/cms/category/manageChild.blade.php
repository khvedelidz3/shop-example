@switch(Request::path())

    @case('admin/categories')
    @foreach($children as $child)
        <tr>
            <th scope="row">{{$child->id}}</th>
            <td>{{$child->name}}</td>
            <td>{{$child->slug}}</td>
            <td>{{is_object($child)}}</td>
            <td>
                <a type="button" class="btn btn-warning d-inline"
                   href="/admin/categories/show/{{$child->id}}" role="button">Update</a>
                <form method="POST" action="/admin/categories/{{$child->id}}/delete" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </td>
        </tr>
        @if(count($child->children))
            @include('cms/category/manageChild',['children' => $child->children])
        @endif
    @endforeach
    @break

    @case('admin/categories/create')
    @foreach($children as $child)
        <option value="{{$child->id}}" class="bg-danger">
            {{ $child->name }}
        </option>
        @if(count($child->children))
            @include('cms/category/manageChild',['children' => $child->children])
        @endif
    @endforeach
    @break


    @case('admin/products/create')
    @foreach($children as $child)

        <option value="{{$child->id}}" class="bg-danger">
            {{ $child->name }}
        </option>
        @if(count($child->children))
            @include('cms/category/manageChild',['children' => $child->children])
        @endif

    @endforeach
    @break


    @case("admin/categories/show/{$currentCategory->id}" || "admin/products/update/{$currentCategory->id}")
    @foreach($children as $child)
        @if($currentCategory->id == $child->id && Request::path() == "admin/categories/show/{$currentCategory->id}")
            @continue
        @endif
        @if(Request::path() == "admin/categories/show/{$currentCategory->id}")
        <option value="{{$child->id}}" class="bg-danger" {{$child->id == $currentCategory->parent_id ? 'selected':''}}>
            {{ $child->name }}
        </option>
        @else
            <option value="{{$child->id}}" class="bg-danger" {{$child->id == $currentCategory->id ? 'selected':''}}>
                {{ $child->name }}
            </option>
        @endif


        @if(count($child->children))
            @include('cms/category/manageChild',['children' => $child->children])
        @endif
    @endforeach
    @break

@endswitch


