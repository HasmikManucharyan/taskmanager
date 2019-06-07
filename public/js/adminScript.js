$( document ).ready(function() {
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
    $('#select_type').change(function() {
    	var userid = $(this).parent().parent().find('.user_id').html();
    	var type = $(this).val();
    	$.ajax({
           type:'POST',
           url:'/changeUserType',
           data:{id:userid, type:type},
           success:function(data){
           }
      });
	  });
})