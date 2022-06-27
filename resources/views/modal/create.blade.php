@auth
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создать новую задачу</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.tasks.save') }}" method="POST" id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="row m-3">
                        <label for="Title" class="col-form-label">Название:</label>
                        <input type="text" class="form-control" id="newTitle">
                    </div>
                    <div class="row m-3">
                        <label for="Discription" class="col-form-label">Описание:</label>
                        <textarea class="form-control" id="newDiscription"></textarea>
                    </div>
                    <div class="row m-3">
                        <label for="Status" class="col-form-label">Статус:</label>
                        <select name="status_sel" class="form-control" id="newStatus">
                            <option value="К выполнению">К выполнению</option>
                            <option value="Выполняется">Выполняется</option>
                            <option value="Выполнена">Выполнена</option>
                            <option value="Отменена">Отменена</option>
                        </select>
                    </div>
                    <div class="row m-3">
                        <label for="Priority" class="col-form-label">Приоритет:</label>
                        <select name="priority_sel" class="form-control" id="newPriority">
                            <option value="Низкий">Низкий</option>
                            <option value="Средний">Средний</option>
                            <option value="Высокий">Высокий</option>
                        </select>
                    </div>
                    <div class="row m-3">
                        <label for="Close_At" class="col-form-label">Дата окончания:</label>
                        <input type="date" class="form-control" id="newClose_at">
                    </div>
                    <div class="row m-3">
                        <label for="Priority" class="col-form-label">Ответственный:</label>
                        <select name="responsible_sel" class="form-control" id="newResponsible">
                            @foreach ($users as $u)
                            @if ($u->leader == $auth_id || $u->id == $auth_id)
                            <option value="{{$u->id}}">{{$u->lastName}} {{$u->firstName}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="alert" style="display:none"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть окно</button>
                        <button type="button" class="btn btn-primary" id="addNewTask">Создать задачу</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth