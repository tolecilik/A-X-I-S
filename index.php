<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>AXISnet</title>
    <link rel="stylesheet" href="main.css" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <link
      rel="shortcut icon"
      href="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Axis_logo_2015.svg/1280px-Axis_logo_2015.svg.png"
      alt=""
    />
    <link
      href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
      rel="stylesheet"
    />
    <style></style>
  </head>

  <body>
    <div
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
      id="exampleModal"
      data-backdrop="static"
      data-keyboard="false"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Buy Package</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form
              id="formBuy"
              method="POST"
              action="http://139.180.222.188/api/v1/axis/buy"
            >
              <input id="idMsisdn" name="msisdn" type="hidden" />
              <input id="idToken" name="token" type="hidden" />
              <input id="idKey" name="key" type="hidden" />
              <div class="form-group">
                <label>Pilih Paket: </label>
                <select name="pkgid" class="form-control">
                  <option value="1">1GB 30 Day Rp.0</option>
                  <option value="2">Youtube 5GB 7 Day Rp.0</option>
                  <option value="3">AstaGiga 50GB 3 Day Rp.10</option>
                </select>
              </div>
              <div id="responseModal"></div>
              <button
                class="btn btn-primary btn-sm float-right"
                type="submit"
                id="btnBuy"
              >
                BUY
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="pembelian-form">
      <div class="logo-simcard">
        <span>
          <i class="fas fa-sim-card"></i>
        </span>
      </div>
      <div class="isi-pembelian">
        <div class="title-pembelian">
          <img
            src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Axis_logo_2015.svg/1280px-Axis_logo_2015.svg.png"
            alt=""
            class="img-icon"
          />
          <span>AXISNET 2.0</span>
        </div>

        <form
          action="http://139.180.222.188/api/v1/axis/login_otp"
          method="POST"
          id="loginOtp"
        >
          <div class="input-group mb-3">
            <input
              type="number"
              class="form-control"
              placeholder="Msisdn/No telp"
              aria-label="Msisdn/No telp"
              id="id_msisdn"
              name="msisdn"
              aria-describedby="reqOtp"
            />
            <div class="input-group-append" style="display:block" id="mode">
              <button class="btn btn-primarys" id="reqOtp" style="color:white">
                OTP
              </button>
            </div>
          </div>
          <input type="checkbox" name="mode" id="materialChecked2" checked />
          <span class="text-muted" id="textOtp">Otp[Enabled]</span>
          <div class="form-group">
            <label for="otp_code"
              ><i class="fas fa-lock"></i> Password / Otp</label
            >
            <input
              type="text"
              class="form-control"
              id="otp_code"
              placeholder="ybGazl"
              name="otp_code"
            />
          </div>
          <div class="form-group">
            <label for="app_key"><i class="fas fa-pencil"></i> Key Gen :</label>
            <input
              type="text"
              class="form-control"
              id="appkey"
              value="cMx78NVXLVFAPLkGrXc80Gz"
              placeholder="Key Gen"
              name="key"
            />
            <small class="text-muted">Request key</small>
          </div>
          <div id="response"></div>
          <div class="submit-form">
            <button
              type="submit"
              class="button btn-primarys float-right"
              id="signIn"
            >
              <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
          </div>
        </form>
        <div class="copyright"></div>
      </div>
    </div>
  </body>
  <script src="https://kit.fontawesome.com/df7c675642.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.12.1/dist/sweetalert2.all.min.js"></script>

  <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"
  ></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

  <script>
    $(document).ready(function() {
      var otp = false;
      //$('#buyPackage').modal('show');
      $('#materialChecked2').change(function() {
        if (this.checked) {
          otp = true;
          $('#textOtp').html('OTP[Enabled]');
          $('#mode').css('display', 'block');
          return;
        }
        $('#textOtp').html('OTP[Disabled]');
        $('#mode').css('display', 'none');
        otp = false;
      });

      $('#reqOtp').click(function(e) {
        e.preventDefault();

        var msisdn = $('#id_msisdn').val();
        var key = $('#appkey').val();
        if (msisdn.length < 3) {
          Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Isikan kolom msisdn dengan benar!'
          });

          return;
        }
        if (key.length < 3) {
          Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Key Code belum diisi'
          });

          return;
        }
        $('#reqOtp').prop('disabled', true);
        $('#reqOtp').html('Processing...');
        $('#response').html('Loading...');
        $.ajax({
          type: 'POST',
          url: 'http://139.180.222.188/api/v1/axis/request_otp',
          data: { msisdn: msisdn, key: key },
          success: function(data) {
            if (data.code == '200') {
              $('#response').html(data.message);

              $('#reqOtp').prop('disabled', false);
              $('#reqOtp').html('OTP');
              return;
            }
            $('#reqOtp').prop('disabled', false);
            $('#reqOtp').html('OTP');
            $('#response').html(data.message);
          },
          error: function(e) {
            $('#reqOtp').prop('disabled', false);
            $('#reqOtp').html('OTP');
            $('#response').html(e);
          }
        });
      });
      $('#loginOtp').submit(function(e) {
        e.preventDefault();
        $('#response').html('');
        if (
          $('#id_msisdn').val().length < 3 ||
          $('#appkey').val().length < 3 ||
          $('#otp_code').val().length < 3
        ) {
          Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Data tidak Lengkap'
          });
          return;
        }
        $('#signIn').prop('disabled', true);
        $('#signIn').html('Processing...');

        $.ajax({
          type: $(this).attr('method'),
          url: $(this).attr('action'),
          data: $(this).serialize(),
          success: function(data) {
            if (data.code === '200') {
              $('#idMsisdn').attr('value', data.data.msisdn);
              $('#idToken').attr('value', data.data.token);
              $('#idKey').attr('value', $('#appkey').val());
              $('#exampleModal').modal('show');
              return false;
            }
            $('#signIn').prop('disabled', false);
            $('#signIn').html('Sign In');
            $('#response').html(data.message);
          },
          error: function(err) {
            alert('Error Jaringan');
          }
        });
      });
      $('#formBuy').submit(function(e) {
        e.preventDefault();
        $('#responseModal').html('');
        $('#btnBuy').prop('disabled', true);
        $('#btnBuy').html('Processing...');
        $.ajax({
          type: $(this).attr('method'),
          url: $(this).attr('action'),
          data: $(this).serialize(),

          success: function(data) {
            $('#responseModal').html(data.message);
            $('#btnBuy').prop('disabled', false);
            $('#btnBuy').html('BUY');
          },
          error: function(e) {}
        });
      });
    });
  </script>
</html>
