$( document ).ready(function() {
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });    

    $('.priority').change(function() {
      var priority = {low:'#F7FF05', medium:'#FFCC00', high:'#FF8D0A', critical:'#FF5405', hotfix:'#FF1D19'};
      var color = $(this).val();
      $(this).css( "background-color",priority[color]);
      var priority = $(this).val();
      var taskid = $(this).parent().parent().find('.task_id').html();
      $.ajax({
           type:'POST',
           url:'/changePriority',
           data:{id:taskid, priority:priority},
           success:function(data){
           }
      });
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
            if(data.length != 0){
              for(i=0;i<data.length;i++) {
                txt += '<option value="'+data[i]['id']+'">'+data[i]['name']+'</option>';
              }
            } else {
              txt = '<option>There are not registered users</option>';
            }
              $('#selectedUser').html(txt);
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

    function readURL(input) {
      if (input.files) {
        for(var i=0; i<input.files.length;i++){
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('.uploadedImages').append('<img class="newUploadedImage" src="'+e.target.result+'" />')
          }
          
          reader.readAsDataURL(input.files[i]);
        }
      }
    }

    $("#image").change(function() {
      $('.uploadedImages').html('');
      readURL(this);
    });
})