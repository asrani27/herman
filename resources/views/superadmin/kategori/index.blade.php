@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    SUPERADMIN
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <h4>KATEGORI UPLOAD</h4>
        <div class="row">
            <div class="col-12">
              <a href="/superadmin/setting/kategori/upload/add" class="btn btn-sm btn-primary"><i class="fas fa-file"></i> Tambah Kategori Upload</a> <br/><br/>
              <div class="card">
                {{-- <div class="card-header">
                  <h3 class="card-title">Responsive Hover Table</h3>
  
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div> --}}
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap table-sm table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    @php
                        $no =1;
                    @endphp
                    <tbody>
                      @foreach ($data as $key => $item)
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->nama}}</td>
                            <td>
                              
                            <a href="/superadmin/setting/kategori/upload/edit/{{$item->id}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <a href="/superadmin/setting/kategori/upload/delete/{{$item->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin di hapus?');"><i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
    </div>
</div>
@endsection

@push('js')

<!-- ChartJS -->
<script src="/theme/plugins/chart.js/Chart.min.js"></script>

<script>
    $(function () {
  //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var barChartData = {
      labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sept', 'Okt', 'Nov', 'Des'],
      datasets: [
        {
          label               : 'TPP',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [4000000, 5000000, 4500000, 3900000, 5100000, 4300000, 5000000]
        }
      ]
    }
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      tooltips: { 
           callbacks: { 
               label: function(tooltipItem, data) { 
                   return tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
                }, 
            }, 
        },
      
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true,
          ticks: {
                    callback: function(label, index, labels) {
                        return label/1000000+'JT';
                    }
                },   
            scaleLabel: {
                display: true,
                labelString: '1JT = 1.000.000'
            }
        }]
      }
    }

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
      type: 'bar', 
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
    });
</script>
<!-- Select2 -->
<script src="/theme/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
</script>  
@endpush