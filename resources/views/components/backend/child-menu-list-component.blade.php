@props(['menu','iterationCount'])
@foreach($menu->menus?->loadMissing('model','menus')?->loadCount('menus') as $subMenu)
    <tr>
        <td> {{$iterationCount}}.{{$loop->iteration}}</td>
        <td>{{$subMenu->title}}</td>
        <td>
            <a href="{{route('admin.menu.updateStatus',$menu)}}">
                @if($subMenu->status==1)
                    <i class="mdi mdi-check mdi-24px text-success"></i>
                @else
                    <i class="mdi mdi-window-close mdi-24px text-danger"></i>
                @endif

            </a>
        </td>
        <td>
            <a href="{{App\Helpers\Helpers::getFrontUrl($subMenu)}}">
                <i class="fa fa-link"></i>
            </a>
        </td>
        <td>
            <div class="action">
                <a href="{{route('admin.menu.edit', $subMenu)}}" class="text-info">
                    <i class="lni lni-pencil"></i>
                </a>
                <form action="{{route('admin.menu.destroy',$subMenu)}}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="text-danger show_confirm">
                        <i class="lni lni-trash-can"></i>
                    </button>
                </form>

            </div>
        </td>
    </tr>
    @if ($menu->menus_count > 0)
        <x-backend.child-menu-list-component :menu="$subMenu?->load('model')" iterationCount="{{$iterationCount}}.{{$loop->iteration}}" />
    @endif
@endforeach
