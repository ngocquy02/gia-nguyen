// Wait for the DOM to be ready
$(function() {
  $("form[name='frm_phone']").validate({
    // Specify validation rules
    rules: {
      input_phone:{
        required:true,
        number:true,
        minlength: 10,
        maxlength:11
      }

    },
    // Specify validation error messages
    messages: {
      input_phone:{
        required:"Vui lòng nhập số điện thoại",
        number:"Vui lòng nhập số",
        minlength: "Số điện thoại có chiều dài tối thiểu là 10",
        maxlength:"Số điện thoại có chiều dài tối đa là 11"
      }
    },
    submitHandler: function(form) {
      var phone  = $("#input_phone").val();
      $.ajax({
        url:"contact/xl_contact.php",
        type:"post",
        data:{phone:phone},
        dataType: "html",
        success: function(msg){
          $(".tb_phone").html(msg);
        },
        error:function(){
          alert("Gửi dữ liệu xin vui lòng thử lại sau!");
        }
      });
    }
  });
  
});