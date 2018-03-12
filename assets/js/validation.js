$('#kirim_order').validate({
  rules:{
      nama_depan:"required",
  },
  messages:{
    nama_depan:"Please enter your Frist Name",
  },errorElement: 'span',
  errorClass: 'form-control-feedback',
  errorPlacement: function(error, element) {
      if(element.parent('.form-group').length) {
          error.insertAfter(element.parent());
      } else {
          error.insertAfter(element);
      }
  },
  highlight: function ( element, errorClass, validClass ) {
    $( element ).parents( ".col-md-4" ).addClass( "has-error" ).removeClass( "has-success" );
  },
  unhighlight: function (element, errorClass, validClass) {
    $( element ).parents( ".col-md-4" ).addClass( "has-success" ).removeClass( "has-error" );
  }
});
