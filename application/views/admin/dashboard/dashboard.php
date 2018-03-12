<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="content">
		<div class="row">
			<form action="<?php echo base_url('index.php/adminxdashboard'); ?>" method="POST">
				<div class="col-md-3">
					<div class="form-group">
						<label>Street</label>
						<select class="form-control border-input" id="cari_jalan">
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Time</label>
						<select class="form-control border-input" id="cari_waktu" disabled>
								<option  value='0' selected disabled style='color:silver;'>Select a time range</option>
								<option value="all">Day</option>
								<option value="bulan">Month</option>
								<option value="tahun">Year</option>
						</select>
					</div>
				</div>
			</br>

			</form></br>
		</div>
		<div class="row">
			<div class="container-fluid">
					<div class="card" style="padding:20px;">
						<ul class="nav nav-tabs" role="tablist">
						    <li role="presentation" class="active"><a href="#co2" aria-controls="co2" role="tab" data-toggle="tab">CO2</a></li>
						    <li role="presentation"><a href="#kelembaban" aria-controls="kelembaban" role="tab" data-toggle="tab">Kelembaban</a></li>
								<li role="presentation"><a href="#suhu" aria-controls="suhu" role="tab" data-toggle="tab">Suhu</a></li>
						    <li role="presentation"><a href="#co" aria-controls="co" role="tab" data-toggle="tab">CO</a></li>
						  </ul>

						  <!-- Tab panes -->
						  <div class="tab-content">
						    <div role="tabpanel" class="tab-pane active" id="co2">
										<div class="panel-body tem" id="grafik_co2" hidden></div>
										<div class="jalan">
												<span class="fa fa-bar-chart"></span>
										</div>
								</div>

						    <div role="tabpanel" class="tab-pane" id="kelembaban">
										<div class="panel-body tem" id="grafik_kelembaban" hidden></div>
										<div class="jalan">
												<span class="fa fa-bar-chart"></span>
										</div>
								</div>

								<div role="tabpanel" class="tab-pane" id="suhu">
										<div class="panel-body tem" id="grafik_suhu" hidden></div>
										<div class="jalan">
												<span class="fa fa-bar-chart"></span>
										</div>
								</div>

						    <div role="tabpanel" class="tab-pane" id="co">
										<div class="panel-body tem" id="grafik_co" hidden></div>
										<div class="jalan">
												<span class="fa fa-bar-chart"></span>
										</div>
								</div>
						  </div>
					</div>
			</div>
		</div>
</div>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
var chart1, chart2, chart3, chart4;
var alamat_jalan = '';

function requestData(kondisi1, waktu1){
		var kondisi = kondisi1;
		var waktu = waktu1;

		$.ajax({
				url: '<?= base_url() ?>index.php/Adminxdashboard/get_data',
				method:"POST",
				datatype: "json",
				data:{kondisi:kondisi,waktu:waktu},
				success: function(data) {
				var data1 = jQuery.parseJSON(data);
				var data2 = jQuery.parseJSON(data);
				var data3 = jQuery.parseJSON(data);
				var data4 = jQuery.parseJSON(data);

				chart1.series[0].setData(data1[0]['co2']);
				chart2.series[0].setData(data2[0]['kelembaban']);
				chart3.series[0].setData(data3[0]['suhu']);
				chart4.series[0].setData(data4[0]['co']);

				// setTimeout(requestData(kondisi1, waktu1), 1000);
				}
		});
}

$(document).ready(function() {

get_jalan();

chart1 = Highcharts.stockChart('grafik_co2', {
		chart: {
			zoomType: 'x'
		},
		title: {
				text: 'Grafik CO 2'
		},
		subtitle: {
				text: 'Di ' + alamat_jalan
		},
		xAxis: {
				type: 'datetime'
		},
		yAxis: {
				title: {
						text: 'Exchange rate'
				}
		},
		legend: {
				enabled: false
		},
		plotOptions: {
				area: {
						fillColor: {
								linearGradient: {
										x1: 0,
										y1: 0,
										x2: 0,
										y2: 1
								},
								stops: [
										[0, Highcharts.getOptions().colors[0]],
										[1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
								]
						},
						marker: {
								radius: 2
						},
						lineWidth: 1,
						states: {
								hover: {
										lineWidth: 1
								}
						},
						threshold: null
				}
		},

		series: [{
				type: 'area',
				name: 'CO 2',
				data: []
		}]
});

chart2 = Highcharts.stockChart('grafik_kelembaban', {
		chart: {
			zoomType: 'x'
		},
		title: {
				text: 'Grafik Kelembaban'
		},
		subtitle: {
				text: 'Di ' + alamat_jalan
		},
		xAxis: {
				type: 'datetime'
		},
		yAxis: {
				title: {
						text: 'Exchange rate'
				}
		},
		legend: {
				enabled: false
		},
		plotOptions: {
				area: {
						fillColor: {
								linearGradient: {
										x1: 0,
										y1: 0,
										x2: 0,
										y2: 1
								},
								stops: [
										[0, Highcharts.getOptions().colors[0]],
										[1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
								]
						},
						marker: {
								radius: 2
						},
						lineWidth: 1,
						states: {
								hover: {
										lineWidth: 1
								}
						},
						threshold: null
				}
		},

		series: [{
				type: 'area',
				name: 'Kelembaban',
				data: []
		}]
});

chart3 = Highcharts.stockChart('grafik_suhu', {
		chart: {
			zoomType: 'x'
		},
		title: {
				text: 'Grafik Suhu'
		},
		subtitle: {
				text: 'Di ' + alamat_jalan
		},
		xAxis: {
				type: 'datetime'
		},
		yAxis: {
				title: {
						text: 'Exchange rate'
				}
		},
		legend: {
				enabled: false
		},
		plotOptions: {
				area: {
						fillColor: {
								linearGradient: {
										x1: 0,
										y1: 0,
										x2: 0,
										y2: 1
								},
								stops: [
										[0, Highcharts.getOptions().colors[0]],
										[1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
								]
						},
						marker: {
								radius: 2
						},
						lineWidth: 1,
						states: {
								hover: {
										lineWidth: 1
								}
						},
						threshold: null
				}
		},

		series: [{
				type: 'area',
				name: 'Suhu',
				data: []
		}]
});

chart4 = Highcharts.stockChart('grafik_co', {
		chart: {
			zoomType: 'x'
		},
		title: {
				text: 'Grafik CO'
		},
		subtitle: {
				text: 'Di ' + alamat_jalan
		},
		xAxis: {
				type: 'datetime'
		},
		yAxis: {
				title: {
						text: 'Exchange rate'
				}
		},
		legend: {
				enabled: false
		},
		plotOptions: {
				area: {
						fillColor: {
								linearGradient: {
										x1: 0,
										y1: 0,
										x2: 0,
										y2: 1
								},
								stops: [
										[0, Highcharts.getOptions().colors[0]],
										[1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
								]
						},
						marker: {
								radius: 2
						},
						lineWidth: 1,
						states: {
								hover: {
										lineWidth: 1
								}
						},
						threshold: null
				}
		},

		series: [{
				type: 'area',
				name: 'CO',
				data: []
		}]
});

});
// tutup document ready

function get_jalan() {
	var select_alamat = $('#cari_jalan');
	var html = "";

	$.ajax({
		url:'<?= base_url() ?>index.php/adminxmaps/get_jalan',
		method:'GET',
		dataType:'JSON',
		success:function(data){
				html +="<option value='0' selected disabled style='color:silver;'>Choose a street ..</option>";
				for (var i = 0; i < data.jalan.length; i++) {
						html +="<option value='"+data.jalan[i].jalan+"'>"+data.jalan[i].jalan+"</option>";
				}


				select_alamat.html(html);
		}
	});

}

$('#cari_jalan').on('change', function() {

		$('#cari_waktu').attr('disabled', false);

		$('.tem').show("slow");
		$('.jalan').attr('hidden', true);

		var jalan = $(this).val();
		var waktu_pilih = "all";

		if ($('#cari_waktu').val() != null) {
			waktu_pilih = $('#cari_waktu').val();
		}

		console.log(jalan+' '+waktu_pilih);

		requestData(jalan, waktu_pilih);
});

$('#cari_waktu').on('change', function(){
		var jalan = $('#cari_jalan').val();
		var waktu = $(this).val();

		requestData(jalan, waktu);

});



</script>
