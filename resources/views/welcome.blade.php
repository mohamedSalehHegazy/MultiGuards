@extends('layouts.app')

@section('content')

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
    
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <div class="col-12 text-center">
                  <input type="text" class="knob" data-readonly="true" value="" data-width="60" data-height="60"
                         data-bgColor="#39CCCC" data-fgColor="#fff">
                <div class="text-white">New Offers</div>
              </div>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
            <div class="col-12 text-center">
                  <input type="text" class="knob" data-readonly="true" value="" data-width="60" data-height="60"
                         data-bgColor="#36e35d" data-fgColor="#fff">
                <div class="text-white">Rental Cars </div>
                </div>
                </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
            <div class="col-12 text-center">
                  <input type="text" class="knob" data-readonly="true" value="" data-width="60" data-height="60"
                  data-bgColor="#f3f001" data-fgColor="#fff">
                <div class="text-white">Car Owners</div>
                </div>
                </div>
            <a href="#" class="small-box-footer"><span class="text-white">More info <i class="fas fa-arrow-circle-right"></i></span></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
            <div class="col-12 text-center">
                  <input type="text" class="knob" data-readonly="true" value="" data-width="60" data-height="60"
                  data-bgColor="#98111f" data-fgColor="#fff">
                <div class="text-white">Employees </div>
                </div>
                </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

     
      <!-- Main row -->
      <div class="row connectedSortable">
        <div class="col-12">
          <div class="card ">
            <div class="card-header border-0">
              <h3 class="card-title">
                <i class="fas fa-th mr-1"></i>
                Services Graph
              </h3>

              <div class="card-tools">
                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body mx-3">
            <canvas id="servicesChart" style="min-height: 290px; height: 100%; max-height: 100%; max-width: 100%;"></canvas>
           
          </div>
          </div>
            </div>
            <!-- /.card-body -->
           
                
              </div>
              <!-- /.row -->
          </div>
        </div>
      </div>

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->


@endsection