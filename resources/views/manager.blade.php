@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Tasks List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="container">
                    <table class="table table-hover">                                                  
                        @if(isset($data['unassigned_tasks']) && !$data['unassigned_tasks']->isEmpty())
                        <thead>
                            <tr>
                                <th>Task Number</th>
                                <th>Title</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($data['unassigned_tasks'] as $mytask)
                                <tr>
                                    <td class="task_id">{{ $mytask->id }}</td>
                                    <td>{{ $mytask->title }}</td>
                                    <td>{{ $mytask->deadline }}</td>
                                    <td>{{ $mytask->status }}</td>
                                    <td>
                                        <button class="assignTo" data-toggle="modal" data-target="#usersModal">Assign to</button>
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Assigned By Me</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="container">                
                    <table class="table table-hover">                                                  
                        @if(isset($data['assigned_tasks_by_me']) && !$data['assigned_tasks_by_me']->isEmpty())
                        <thead>
                            <tr>
                                <th>Task Number</th>
                                <th>Title</th>
                                <th>Deadline</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($data['assigned_tasks_by_me'] as $myassignedtask)
                                <tr>
                                    <td class="task_id">{{ $myassignedtask->id }}</td>
                                    <td>{{ $myassignedtask->title }}</td>
                                    <td>{{ $myassignedtask->deadline }}</td>
                                    <td>
                                        <select name="select_status" id="select_status">
                                            <option value="to do" <?php if ($myassignedtask->status == 'to do' ) echo 'selected' ; ?>>To Do</option>
                                            <option value="in progress" <?php if ($myassignedtask->status == 'in progress' ) echo 'selected' ; ?>>In Progress</option>
                                            <option value="done" <?php if ($myassignedtask->status == 'done' ) echo 'selected' ; ?>>Done</option>
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
            <button type="button" class="btn btn-primary" id="addTask"  data-toggle="modal" data-target="#addtaskModal">Add Task</button>
        <div class="row justify-content-center">
            <div class="modal fade" id="addtaskModal" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Create Task</h4>
                       <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                       </button>
                    </div>
                  <div class="modal-body">
                        <form action="addTask" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="deadline">Deadline:</label>
                                <input type="date" class="form-control" id="deadline" name="deadline">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                  </div>
                </div>
            </div>       
        </div>
        <div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <select id="selectedUser">
                </select>
                <input type="hidden" id='hidden'>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveSelectedUser">Save changes</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
