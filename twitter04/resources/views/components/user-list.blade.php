<div>
    @for($i=0;$i<=4;$i++)
    <li class="list-group-item">
    <img class=" rounded-circle" width="50" height="50"
    src="{{ asset('storage/profile_image/'.$users[$i]->profile_image) }}" alt="">
        {{$users[$i]->name}}
        <small>{{$users[$i]->screen_name}}</small>
    </li>
    @endfor
</div>