<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
	<form action="<?php echo base_url('index.php/adminxdashboard'); ?>" method="POST">
		<div class="col-md-3">
			<div class="form-group">
				<label>Wilayah</label>
				<select name="wilayah" class="form-control border-input">
					<option style="color:silver;" disabled selected>Pilih Wilayah</option>
					<option value="Ciroyom - Caheum">Ciroyom - Caheum</option>
					<option value="Ciroyom - Ledeng">Ciroyom - Ledeng</option>
				</select>
			</div>
		</div></br>
		<div class="col-md-1">
			<div class="text-center">
				<button type="submit" class="btn btn-info btn-fill btn-wd" data-toggle="confirmation">Submit</button>
			</div>
		</div>
	</form></br>
	<?php echo "<h2>$wilayah</h2>" ;?>
	<div class="container-fluid">
		<script src="<?php echo base_url(); ?>assets/canvasjs.min.js"></script>
		<div class="col-md-12">
            <div class="card">
				<div id="suhu" style="width: 100%; height: 300px;"></div> </br>
			</div>
		</div>
		<div class="col-md-12">
            <div class="card">
				<div id="gas" style="width: 100%; height: 300px;"></div> </br>
			</div>
		</div>
		<div class="col-md-12">
            <div class="card">
				<div id="kelembaban" style="width: 100%; height: 300px;"></div> </br>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var chart = new CanvasJS.Chart("suhu",
    {
        animationEnabled: true,
        title: {
            text: "Grafik Suhu"
        },
        axisX: {
            interval: 100,
        },
		toolTip:{
			content: "Suhu: {y} &#8451;"
		},
        data: [
        {
            type: "splineArea",
            color: "rgba(13,1,254,.3)",
            dataPoints: [
			<?php
			$no=1;foreach($konten as $data){
				echo "{ x: $no, y: {$data['suhu']} },";
				$no++;
			}
			?>
            ]
        },
        ]
    });
chart.render();

var chart = new CanvasJS.Chart("gas",
    {
        animationEnabled: true,
        title: {
            text: "Grafik Gas"
        },
        axisX: {
            interval: 100,
        },
		toolTip:{
			content: "Gas: {y} PPM"
		},
        data: [
        {
            type: "splineArea",
            color: "rgba(13,1,254,.3)",
            dataPoints: [
			<?php
			$no=1;foreach($konten as $data){
				echo "{ x: $no, y: {$data['gas']} },";
				$no++;
			}
			?>
            ]
        },
        ]
    });
chart.render();

var chart = new CanvasJS.Chart("kelembaban",
    {
        animationEnabled: true,
        title: {
            text: "Grafik Kelembaban"
        },
        axisX: {
            interval: 100,
        },
		toolTip:{
			content: "Kelembaban: {y} RH"
		},
        data: [
        {
            type: "splineArea",
            color: "rgba(13,1,254,.3)",
            dataPoints: [
			<?php
			$no=1;foreach($konten as $data){
				echo "{ x: $no, y: {$data['kelembaban']} },";
				$no++;
			}
			?>
            ]
        },
        ]
    });
chart.render();
</script>
