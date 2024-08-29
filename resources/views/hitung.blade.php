<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>IMS</title>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand">IMS</a>
        <form class="form-inline">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav>

    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card p-4">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label>OTR</label>
                            <input type="number" class="form-control" id="otr" name="otr" placeholder="OTR">
                        </div>
                        <div class="form-group">
                            <label>DP</label>
                            <input type="number" class="form-control" id="dp" name="dp" placeholder="DP">
                        </div>
                        <div class="form-group">
                            <label>Jangka Waktu (Bulan)</label>
                            <input type="number" class="form-control" id="jangka_waktu" name="jangka_waktu" placeholder="Ex: 12">
                        </div>
                        <button type="button" class="btn btn-primary submitButton">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 result">
                <div class="card p-4">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Total Angsuran Anda</th>
                            <th scope="col">Jangka Waktu</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td id="angsuran"></td>
                            <td id="jangkawaktu"></td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('.result').hide();
            $('.submitButton').on('click', function() {
                var otr = $('#otr').val();
                var dp = $('#dp').val();
                var jangka_waktu = $('#jangka_waktu').val();
                var token = $('input[name="_token"]').val();

                let formData = new FormData();
                formData.append("otr", otr);
                formData.append("dp", dp);
                formData.append("jangka_waktu", jangka_waktu);
                formData.append('_token', token);

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    url: "{{ url('store') }}",
                    data: formData,
                    success: function(data) {
                        console.log(data);
                        $('.result').show();
                        $('#angsuran').html(formatRupiah(data.data));
                        $('#jangkawaktu').html(jangka_waktu + ' Bulan');
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            function formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0 // Jika ingin tanpa desimal
                }).format(number);
            }
        })
    </script>
  </body>
</html>