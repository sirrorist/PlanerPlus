<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Таски</title>
    <link rel="stylesheet" href="{{ asset("css/normalize.css") }}" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>body{font-family: 'Nunito', sans-serif;  background-color: antiquewhite;}</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="margin-left: 9px">
        <a class="navbar-brand" href="/">Planer +</a>
        <div class="navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="/">Главная</a>
                <a class="nav-item nav-link active" href="{{ route('user.tasks') }}">Задачи <span class="sr-only"></span></a>
                <a class="nav-item nav-link" href="{{ route('user.report') }}">Отчёты</a>
                <a class="nav-item nav-link" href="{{ route('user.chat') }}">Чат</a>
                <a class="nav-item nav-link" href="{{ route('user.logout') }}">Выход</a>
            </div>
        </div>
    </nav>
    <label style="padding: 20px"><h1>Страница с задачами</h1></label><br>
    <div class="sorting">
        <ul class="nav justify-content-center">
            <label class="navbar-brand text-secondary">Сортировка: </label>
            <li class="nav-item">
              <a class="sort_btn nav-link" href="#" data-target="default_sort">По дате последнего обновления</a>
            </li>
            <li class="nav-item">
              <a class="sort_btn nav-link" href="#" data-target="date_sort">По дате завершения</a>
            </li>
            <li class="nav-item">
              <a class="sort_btn nav-link" href="#" data-target="responsible_sort">По ответственным</a>
            </li>
          </ul>
    </div>
    <button type="button" class="btn m-4" style="background-color: #29cff1" data-bs-toggle="modal" data-bs-target="#addModal">Добавить задачу</button>
    {{-- Модалка для добавления --}}
    @include('modal.create')
    {{-- / --}}
    <div class="container" id="cont">
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
                            @if ($u->id == $item->responsible)<p>{{$u->lastName}} {{$u->firstName}} {{$u->middleName}}</p> @endif 
                            @endforeach</p>
                    </div>
                    <div class="card-footer text-dark bg-light">Дата окончания: {{$item->close_at}}</div>
                    <button type="button" class="btn" style="background-color: #29cff1" data-bs-toggle="modal" data-bs-target="#M{{$item->id}}">Изменить</button>
                </div>
                {{-- Модалка для изменения --}}                
                @include('modal.edit')
                {{-- / --}}
            </div>
            @endforeach
        </div>
    </div>

    {{-- Скрипт (создать отдельную функцию и выгружать туда параметры) --}}
    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }});
        $(document).ready(function(){
            $('.sort_btn').click(function(e){
                let orderType = $(this).data('target');
                $.ajax({
                    type: "GET",
                    dataType: 'html',
                    url: "{{route('user.tasks')}}",
                    data: {
                        orderType: orderType
                    },
                    success: function(data){
                        $('#cont').html(data);
                    }
                });
            });
            $('.btnEdit').click(function(e){
                let taskId = '#M' + $(this).data('target');
                let id = $(this).data('target');
                let title = $(taskId+' #title').val();
                let discription = $(taskId+' #discription').val();
                let status = $(taskId+' #status').val();
                let priority = $(taskId+' #priority').val();
                let close_at = $(taskId+' #close_at').val();
                let responsible = $(taskId+' #responsible').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('user.tasks.edit')}}",
                    data: {
                        id: id,
                        title: title,
                        discription: discription,
                        status: status,
                        priority: priority,
                        close_at: close_at,
                        responsible
                    },
                    success: function (data) {
                        if(data.errors){
                  		    $('.alert').html('');
                  		    $.each(data.errors, function(key, value){
                  			    $(taskId+' .alert').show();
                  			    $(taskId+' .alert').append(value+'<br>');
                  		    });
                  	    } else{
                            $(taskId+' .alert').html('');
                            $('#editForm'+taskId).trigger("reset");
                            $(taskId).modal('hide');
                            window.location.reload(true);
                  	    };
                    }
                });
            });
            $('#addNewTask').click(function(e){
                let title = $('#newTitle').val();
                let discription = $('#newDiscription').val();
                let status = $('#newStatus').val();
                let priority = $('#newPriority').val();
                let close_at = $('#newClose_at').val();
                let responsible = $('#newResponsible').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('user.tasks.save')}}",
                    data: {
                        title: title,
                        discription: discription,
                        status: status,
                        priority: priority,
                        close_at: close_at,
                        responsible
                    },
                    success: function (data) {
                        if(data.errors){
                  		    $('.alert').html('');
                  		    $.each(data.errors, function(key, value){
                  			    $('.alert').show();
                  			    $('.alert').append(value+'<br>');
                  		    });
                  	    } else{
                            $('.alert').html('');
                            $('#addForm').trigger("reset");
                            $('#addModal').modal('hide');
                            window.location.reload(true);
                  	    };
                    }
                });
            });
        });

    </script>
    {{-- / --}}
</body>
</html>
