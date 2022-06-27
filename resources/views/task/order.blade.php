
<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-2 g-lg-3">
    @foreach ($tasks as $item)
    <div class="col" id="{{$item->id}}">
        @switch($item->status)
            @case('Выполняется')
                @if ($item->close_at < $date)
                    <div class="card text-white bg-danger m-3">
                @else 
                    <div class="card text-white bg-secondary m-3">
                @endif
                @break
            @case('Выполнена')
                <div class="card text-white bg-success m-3">
                @break
            @default
                <div class="card text-white bg-secondary m-3" id="priv">
        @endswitch
            <div class="card-header">{{$item->title}} [ID: <span class="task_id">{{$item->id}}</span>]</div>
            <div class="card-body text-dark bg-light">
                <p class="card-text"><b>Статус: </b>{{$item->status}}</p>
                <p class="card-text"><b>Приоритет: </b>{{$item->priority}}</p>
                <p class="card-text"><b>Ответственный: </b>
                    @foreach ($users as $u)
                    @if ($u->id == $item->responsible)<p>{{$u->lastName}} {{$u->firstName}}</p> @endif 
                    @endforeach</p>
            </div>
            <div class="card-footer text-dark bg-light">Дата окончания: {{$item->close_at}}</div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#M{{$item->id}}">Изменить</button>
        </div>
        {{-- Модалка для изменения --}}                
        @include('modal.edit')
        {{-- / --}}
    </div>
    @endforeach
</div>
