@auth
<div class="modal fade" id="M{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Изменить задачу: {{$item->title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.tasks.edit') }}" method="POST" id="editFormM{{$item->id}}">
                @csrf
                <div class="modal-body">
                    <div class="row m-3">
                        <label for="Title" class="col-form-label">Название:</label>
                        <input type="text" class="form-control" id="title" value="{{$item->title}}" 
                        @if ($item->creator != $auth_id)
                        Disabled
                        @endif
                        >
                    </div>
                    <div class="row m-3">
                        <label for="Discription" class="col-form-label">Описание:</label>
                        <textarea class="form-control" id="discription" 
                        @if ($item->creator != $auth_id)
                        Disabled
                        @endif
                        >{{$item->discription}}</textarea>
                    </div>
                    <div class="row m-3">
                        <label for="Status" class="col-form-label">Статус:</label>
                        <select name="status_sel" class="form-control" id="status" 
                        @if ($item->creator != $auth_id && $auth_id != $item->responsible)
                        Disabled
                        @endif>
                        @foreach (array('К выполнению', 'Выполняется', 'Выполнена', 'Отменена') as $val)
                            @if ($item->status == $val) <option value="{{$val}}" selected>{{$val}}
                            @else <option value="{{$val}}">{{$val}}                      
                            @endif </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="row m-3">
                        <label for="Priority" class="col-form-label">Приоритет:</label>
                        <select name="priority_sel" class="form-control" id="priority"
                        @if ($item->creator != $auth_id)
                        Disabled
                        @endif
                        >
                        @foreach (array('Низкий', 'Средний', 'Высокий') as $val)
                            @if ($item->priority == $val) <option value="{{$val}}" selected>{{$val}} 
                            @else <option value="{{$val}}">{{$val}}                      
                            @endif </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="row m-3">
                        <label for="Close_At" class="col-form-label">Дата окончания:</label>
                        <input type="date" class="form-control" id="close_at" value="@php echo date('Y-m-d', strtotime($item->close_at)); @endphp" 
                        @if ($item->creator != $auth_id)
                        Disabled
                        @endif
                        >
                    </div>
                    <div class="row m-3">
                        <label for="Priority" class="col-form-label">Ответственный:</label>
                        <select name="responsible_sel" class="form-control" id="responsible"
                        @if ($item->creator != $auth_id)
                        Disabled
                        @endif
                        >
                        @foreach ($users as $u)
                        @if ($u->leader == $auth_id)
                        @if ($u->id == $item->responsible)
                        <option value="{{$u->id}}" selected>{{$u->lastName}} {{$u->firstName}}</option>
                        @else
                        <option value="{{$u->id}}">{{$u->lastName}} {{$u->firstName}}</option>
                        @endif
                        @elseif ($u->id == $item->responsible) 
                        <option value="{{$u->id}}" selected>{{$u->lastName}} {{$u->firstName}}</option>
                        @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="alert" style="display:none"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть окно</button>
                        <button type="button" class="btnEdit btn btn-primary" id="editOldTask" data-target="{{$item->id}}">Изменить задачу</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth