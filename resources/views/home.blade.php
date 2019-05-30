@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Tasks List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="container">          
                    <table class="table table-hover">                                                  
                        @if(isset($mytasks) && !$mytasks->isEmpty())
                        <thead>
                            <tr>
                                <th>Task Number</th>
                                <th>Title</th>
                                <th>Deadline</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($mytasks as $mytask)
                                <tr>
                                    <td class="task_id">{{ $mytask->id }}</td>
                                    <td>{{ $mytask->title }}</td>
                                    <td>{{ $mytask->deadline }}</td>
                                    <td>
                                        <select name="select_status" id="select_status">
                                            <option value="to do" <?php if ($mytask->status == 'to do' ) echo 'selected' ; ?>>To Do</option>
                                            <option value="in progress" <?php if ($mytask->status == 'in progress' ) echo 'selected' ; ?>>In Progress</option>
                                            <option value="done" <?php if ($mytask->status == 'done' ) echo 'selected' ; ?>>Done</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                        @else
                            You have not tasks for doing.
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
