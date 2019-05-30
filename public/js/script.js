$( document ).ready(function() {
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
    $('#select_status').change(function() {
    	var taskid = $(this).parent().parent().find('.task_id').html();
    	var status = $(this).val();
    	$.ajax({
           type:'POST',
           url:'/ajaxRequest',
           data:{id:taskid, status:status},
           success:function(data){
           }
      });
	  });

    $('.assignTo').click(function() {
      var assigningTask = $(this).parent().parent().find('.task_id').html();
      $('#hidden').val(assigningTask);
      $.ajax({
           type:'POST',
           url:'/getUsers',
           success:function(data){
            var txt = '';
              for(i=1;i<data.length;i++) {
                txt += '<option value="'+data[i]['id']+'">'+data[i]['name']+'</option>';
              }
              $('#selectedUser').append(txt);
           }
      });
    })

    $('#saveSelectedUser').click(function() {
      var id = $('#selectedUser').val();
      var task_id = $('#hidden').val();
      $.ajax({
           type:'POST',
           url:'/saveUser',
           data:{id:id, task_id:task_id},
           success:function(data){
            $('#usersModal').modal('hide');
            location.reload();
           }
      });
    })
})