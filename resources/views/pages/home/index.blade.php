@extends( 'layouts.template' )

@section( 'title', 'Halaman Utama Sistem e-PKK' )

@section( 'css' )
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" media="screen" rel="stylesheet" type="text/css">
  <style type="text/css">
    body {
      font-family: "Open Sans", Helvetica, Arial, sans-serif;
      background-color: #f6f8f8;
    }
    .epkk-content {
      margin: 5em 200px;
    }
    .epkk-header,
    .epkk-navigation {
      text-align: center;
      margin-bottom: 30px;
    }
    .epkk-nav-btn {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 15px;
      padding: 50px 20px 30px;
    }
    .epkk-nav-btn a.epkk-nav-btn-header {
      font-size: 27px;
      font-weight: 300;
      color: #21abc7;
    }
    .epkk-nav-btn a.epkk-nav-btn-header:hover {
      text-decoration: none;
      color: #167385;
    }
  </style>
@endsection

@section( 'content' )
  <div class="epkk-content">
    <div class="row">
      <div class="epkk-header">
        <h1>
          Selamat Datang<br>
          <small>di halaman utama sistem e-PKK Online</small>
        </h1>
      </div>
    </div>
    <div class="row">
      <div class="epkk-navigation">
        <div class="col col-md-6 col-xs-12">
          <div class="epkk-nav-btn">
            <a href="{!! route( 'pkk' ) !!}" class="epkk-nav-btn-header">Sistem PKK</a>
            <p>Sistem integrasi PKK nasional</p>
            <br><br>
            <a href="{!! route( 'pkk' ) !!}" class="btn btn-primary btn-lg">Masuk ke dalam sistem</a>
            <hr>
            <h3>Tersedia dalam aplikasi mobile</h3>
            <p>Dikembangkan untuk para kader PKK agar tetap dapat berinteraksi dengan organisasi di manapun dan kapanpun</p>
            <a href="" class="btn btn-success"><span class="fa fa-android"></span>&nbsp;&nbsp;Unduh .apk</a>
          </div>
        </div>
        <div class="col col-md-6 col-xs-12">
          <div class="epkk-nav-btn">
            <a href="{!! route( 'posyandu' ) !!}" class="epkk-nav-btn-header">Sistem Posyandu</a>
            <p>Sistem integrasi Posyandu nasional</p>
            <br><br>
            <a href="{!! route( 'posyandu.login' ) !!}" class="btn btn-primary btn-lg">Masuk ke dalam sistem</a>
            <hr>
            <h3>Tersedia dalam aplikasi mobile</h3>
            <p>Dikembangkan untuk seluruh ibu agar dapat mengontrol kesehatan balita melalui KMS dan berinteraksi dengan posyandu daerahnya</p>
            <a href="" class="btn btn-success"><span class="fa fa-android"></span>&nbsp;&nbsp;Unduh .apk</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
