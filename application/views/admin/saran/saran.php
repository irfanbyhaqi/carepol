<div class="content">
	<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
          <div class="card card-map">
            <div class="header">
                <h4 class="title">Nama Jalan</h4>
            </div>
            <br>
            <div class="body" style="padding:5px;">
              <div class="list-group" id="jalan">

              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
            <div class="card card-map">
							<div class="header">
								<h4 class="title" id="title_jalan"></h4>
							</div>
							<br>
              <div class="map" style="padding-left:10px;padding-right:10px;padding-top:15px;">
                  <div class="sementara">
                    <span class="glyphicon glyphicon-envelope"></span>
                  </div>

              </div>
            </div>
        </div>
    </div>
	</div>
</div>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function(){
    get_jalan();
});



function get_jalan(){
  var tempat_jalan = $('#jalan');
  var html = "";

  $.ajax({
      url:'<?php echo base_url()  ?>index.php/Adminxmaps/get_data_jalan',
      method:"GET",
      dataType:"JSON",
      success:function(data){
          html += '<a href="#" class="list-group-item active">Pilihan satu </a>';
        for (var i = 0; i < data.jalan.length; i++) {
          html += '<a href="#" class="list-group-item click" data-jalan="'+data.jalan[i]['jalan']+'"><span class="badge">'+data.pesan[i]+'</span>'+data.jalan[i]['jalan']+'</a>';
        }

        tempat_jalan.html(html);
      }
  });
}

function tampil_data(kondisi) {
  var tempat_data = $('.map');

  $.ajax({
      url:'<?php echo base_url()  ?>index.php/C_Saran/get_data_where',
      method:"POST",
      data:{jalan:kondisi},
      success:function(data){
          if (data == '') {
            tempat_data.empty();
            tempat_data.html('<div class="sementara"><span class="glyphicon glyphicon-envelope"></span></div>');
          }else{
            tempat_data.empty();

            tempat_data.html(data);
          }

          $('#example').DataTable();

					$(document).on('click','.hapus', hapus_data);
					$(document).on('click','.laporkan', laporkan);
      }
  });
}

function laporkan() {
	var jalan = $(this).data('jalan');
	$('#saran_jalan').val(jalan);

	$('#myModal').modal('show');

}

function hapus_data() {

	var id = $(this).data('id');
	var kondisi = $(this).data('kondisi');

	swal({
	  title: "Are you sure?",
	  text: "Once deleted, you will not be able to recover this imaginary file!",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
			$.ajax({
					url:'<?= base_url() ?>index.php/C_Saran/hapus_data',
					method:"POST",
					data:{id:id},
					success:function() {
						swal("Poof! Your imaginary file has been deleted!", {
				      icon: "success",
				    });
						tampil_data(kondisi);
						get_jalan();
						get_jumlah_pesan();
					}
			});

	  } else {
	    swal("Your imaginary file is safe!");
	  }
	});

}

function get_jumlah_pesan() {

	var tempat_saran = $('#tempat_jumlah_pesan');

	$.ajax({
			url:'<?php echo base_url()  ?>index.php/C_Saran/get_jumlah_pesan',
			method:"GET",
			success:function(data){
					tempat_saran.text(data);
			}
	})
}

$(document).on('click','.click', function() {

  var jalan = $(this).data('jalan');
	$('#title_jalan').text(jalan);
  tampil_data(jalan);

});

$(document).on('click','#saran_pemerintah', function(){
		var jalan = $('#saran_jalan').val();
		var saran = $("textarea[name='saran']").val();

		if (saran == "") {
				$("textarea[name='saran']").focus();
		}else{
			$.ajax({
					url:'<?= base_url() ?>index.php/C_Saran/kirim_saran_pemerintah',
					method:"POST",
					data:{jalan:jalan, saran:saran},
					success:function() {

						$("textarea[name='saran']").val('');

						swal("Success send suggestion", {
							icon: "success",
						});

					}
			});
		}



});



</script>
