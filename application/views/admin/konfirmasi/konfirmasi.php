<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Carepol | Confirmation</title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/Logo/Carepol-ico.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <link href="<?= base_url() ?>assets/css/signin.css" rel="stylesheet">
  </head>
  <body
    <?php if ($data->status_bayar == 'kosong'){ ?>
        class="text-center"
    <?php }else{ ?>

    <?php } ?>
  >
    <?php if ($data->status_bayar != 'kosong'){ ?>
      <main role="main" class="container" style="margin-bottom: 280px;">
        <h1 class="mt-5">Successful confirmation</h1>
        <p class="lead">Thank you for trusting us, for user, password and device keys will be sent to your email</p>
        <p>Use <a href="<?= site_url('C_Login'); ?>">this link</a> if you wont to login</p>
      </main>
    <?php }else{ ?>
      <?php echo $this->session->flashdata('message'); ?>
      <form class="form-signin" action="<?= site_url('C_Order/send_konfirmasi/'.$data->id_order.'/'.$data->password); ?>" method="POST" enctype="multipart/form-data">
        <img class="mb-4" src="<?= base_url() ?>assets/images/logo/VerMain_LogoHead.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Payment confirmation</h1>
        <div class="input-group date" data-provide="datepicker">
            <input type="text" name="tanggal" class="form-control" placeholder="Date .." required>
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
        <br>
        <input type="hidden" name="id_order" class="form-control" value="<?= $data->id_order ?>">
        <label for="inputPassword" class="sr-only">Upload resi</label>
        <input type="file" id="gambar" name="gambar" class="form-control" required>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
        <p class="mt-5 mb-3 text-muted">Enter data correctly</p>
      </form>
    <?php } ?>

    <footer class="footer">
      <div class="container text-center">
        <span class="text-muted">Carepol System</span>
      </div>
    </footer>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript">
    $('.date').datepicker({
      format: 'yyyy-mm-dd'
    });
  </script>
  </body>
</html>
