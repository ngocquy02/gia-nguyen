// Wait for the DOM to be ready
$(function() {
  // Bắt lỗi Form nhập Map Google
  $("form[name='frm_map']").validate({
    // Specify validation rules
    rules: {
      Map: "required" // bắt lỗi theo id
    },
    // Specify validation error messages
    messages: {
      Map: "Vui lòng nhập Map",
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
// Bắt lỗi Form nhập thông tin công ty
  $("form[name='frm_company']").validate({
    // Specify validation rules
    rules: {
      Name: "required", // bắt lỗi theo thuộc tính name
      Email: {
         required: true,
         email: true
       },
      Phone: "required",
      Address: "required"
    },
    // Specify validation error messages
    messages: {
      Name: "Vui lòng nhập tên công ty",
      Email:{
        required: "Vui lòng nhập Email công ty",
        email: "Địa chỉ Email không đúng định dạng"
      },
      Phone :"Vui lòng nhập số điện thoại",
      Address: "Vui lòng nhập địa chỉ"
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  // Bắt lỗi Form thay đổi ảnh logo
  $("form[name='frm_img']").validate({
    // Specify validation rules
    rules: {
      Img: {
              required: true,
              accept: "png|jpg|gif|bmp|svg"
            }
       // bắt lỗi theo name
    },
    // Specify validation error messages
    messages: {
      Img: {
        required: "Vui lòng chọn hình ảnh nền",
        accept: "File không đúng định dạng"
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  $("form[name='frm_logo']").validate({
    // Specify validation rules
    rules: {
      Logo: {
              required: true,
              accept: "png|jpg|gif|bmp|svg"
            }
    },
    // Specify validation error messages
    messages: {
      Logo: {
        required: "Vui lòng chọn hình ảnh Logo",
        accept: "File không đúng định dạng"
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
// Bắt lỗi trang thêm sản phẩm
  $("form[name='frm_product_add']").validate({
    // Specify validation rules
    rules: {
      Img: {
              required: true,
              accept: "png|jpg|gif|bmp|svg"
            },
      Name:"required",
      Alias:"required",
      Price:{number:true,min:0},
      Sale:{number:true,min:0,max:100},
    },
    // Specify validation error messages
    messages: {
      Img: {
        required: "Vui lòng chọn hình ảnh",
        accept: "File không đúng định dạng"
      },
      Name:"Vui lòng nhập tên Sản Phẩm",
      Alias: "Vui lòng nhập Alias",
      Price:{
        number: "Vui lòng nhập số cho Giá sản phẩm", 
        min:"Giá sản phẩm có giá trị nhỏ nhất là 0"
      },
      Sale:{
        number: "Vui lòng nhập số cho Phầm trăm khuyến mãi", 
        min:"Phần trăm khuyến mãi có giá trị từ 0 đến 100",
        max:"Phần trăm khuyến mãi có giá trị từ 0 đến 100"
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  // Bắt lỗi trang sửa sản phẩm
  $("form[name='frm_product_edit']").validate({
    // Specify validation rules
    rules: {
      Img: {
              required: false,
              accept: "png|jpg|gif|bmp|svg"
            },
      Name:"required",
      Alias:"required",
      Price:{number:true,min:0},
      Sale:{number:true,min:0,max:100},
    },
    // Specify validation error messages
    messages: {
      Img: {
        required: "Vui lòng chọn hình ảnh",
        accept: "File không đúng định dạng"
      },
      Name:"Vui lòng nhập tên Sản Phẩm",
      Alias: "Vui lòng nhập Alias",
      Price:{
        number: "Vui lòng nhập số cho Giá sản phẩm", 
        min:"Giá sản phẩm có giá trị nhỏ nhất là 0"
      },
      Sale:{
        number: "Vui lòng nhập số cho Phầm trăm khuyến mãi", 
        min:"Phần trăm khuyến mãi có giá trị từ 0 đến 100",
        max:"Phần trăm khuyến mãi có giá trị từ 0 đến 100"
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  /*---------Bắt lỗi thêm, sữa danh mục-------------*/
  $("form[name='frm_category']").validate({
    // Specify validation rules
    rules: {
      Name:"required",
      Alias:"required",
      Description:"required"
    },
    // Specify validation error messages
    messages: {
      Name:"Vui lòng nhập tên Sản Phẩm",
      Alias: "Vui lòng nhập Alias",
      Description:"Vui lòng nhập Description"
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  /*---------------Bắt lỗi thêm bài viết---------------*/
  $("form[name='frm_article_add']").validate({
    // Specify validation rules
    rules: {
      Img: {
              required: true,
              accept: "png|jpg|gif|bmp|svg"
            },
      Name:"required",
      Alias:"required",
    },
    // Specify validation error messages
    messages: {
      Img: {
        required: "Vui lòng chọn hình ảnh",
        accept: "File không đúng định dạng"
      },
      Name:"Vui lòng nhập tên Bài viết",
      Alias: "Vui lòng nhập Alias"
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  /*----------------Bắt lỗi trang sửa bài viết---------------*/
  $("form[name='frm_article_edit']").validate({
    // Specify validation rules
    rules: {
      Img: {
              required: false,
              accept: "png|jpg|gif|bmp|svg"
            },
      Name:"required",
      Alias:"required"
    },
    // Specify validation error messages
    messages: {
      Img: {
        required: "Vui lòng chọn hình ảnh",
        accept: "File không đúng định dạng"
      },
      Name:"Vui lòng nhập tên Bài viết",
      Alias: "Vui lòng nhập Alias"
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  /*---------------Bắt lỗi thêm Slider---------------*/
  $("form[name='frm_slider_add']").validate({
    // Specify validation rules
    rules: {
      Img: {
              required: true,
              accept: "png|jpg|gif|bmp|svg"
            }
    },
    // Specify validation error messages
    messages: {
      Img: {
        required: "Vui lòng chọn hình ảnh",
        accept: "File không đúng định dạng"
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  /*---------------Bắt lỗi thêm đối tác---------------*/
  $("form[name='frm_partner_add']").validate({
    // Specify validation rules
    rules: {
      Img: {
              required: true,
              accept: "png|jpg|gif|bmp|svg"
            },
      Name:'required'
    },
    // Specify validation error messages
    messages: {
      Img: {
        required: "Vui lòng chọn hình ảnh",
        accept: "File không đúng định dạng"
      },
      Name:'Vui lòng nhập tên đối tác'
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  /*---------------Bắt lỗi sửa đối tác---------------*/
  $("form[name='frm_partner_edit']").validate({
    // Specify validation rules
    rules: {
      Img: {
              accept: "png|jpg|gif|bmp|svg"
            },
      Name:'required'
    },
    // Specify validation error messages
    messages: {
      Img: {
        accept: "File không đúng định dạng"
      },
      Name:'Vui lòng nhập tên đối tác'
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  /*---------------Bắt lỗi thêm ý kiến khách hàng---------------*/
  $("form[name='frm_review_add']").validate({
    // Specify validation rules
    rules: {
      Img: {
              required: true,
              accept: "png|jpg|gif|bmp|svg"
            },
      Name:'required',
      Content:'required'
    },
    // Specify validation error messages
    messages: {
      Img: {
        required: "Vui lòng chọn hình ảnh",
        accept: "File không đúng định dạng"
      },
      Name:'Vui lòng nhập tên khách hàng',
      Content:'Vui lòng nhập Ý kiến'
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  /*---------------Bắt lỗi sửa ý kiến khách hàng ---------------*/
  $("form[name='frm_review_edit']").validate({
    // Specify validation rules
    rules: {
      Img: {
              accept: "png|jpg|gif|bmp|svg"
            },
      Name:'required',
      Content:'required'
    },
    // Specify validation error messages
    messages: {
      Img: {
        accept: "File không đúng định dạng"
      },
      Name:'Vui lòng nhập tên khách hàng',
      Content:'Vui lòng nhập Ý kiến'
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
  /*---------------Bắt lỗi sửa thông tin admin---------------*/
  $("form[name='frm_admin_edit']").validate({
    // Specify validation rules
    rules: {
      FullName:"required",
      Email:{
        required: true,
        email: true
      },
      ConfirmPassword:{equalTo: '#Password'}
    },
    // Specify validation error messages
    messages: {
      Email:{
        required: "Vui lòng nhập Email công ty",
        email: "Địa chỉ Email không đúng định dạng"
      },
      FullName:'Vui lòng nhập đầy đủ Họ và Tên',
      ConfirmPassword:{equalTo:'Mật khẩu không trùng khớp' }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});