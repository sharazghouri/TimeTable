@extends('layouts.final')
@section('title','Dashboard | Online M ')

@section('content')


    <!-- Small boxes (Stat box) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>

    </section>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 id="movies"></h3>

                    <p>Total Movies</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{url('movie')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 id="series"></h3>

                    <p>Total Series</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{url('series')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3 id="actor"></h3>

                    <p>Total Actor</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{url('actor')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3 id="cast"></h3>

                    <p>Total Cast</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{url('cast')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>

        </div>
        <!-- ./col -->
        <div class="container">
            <form id="data">
                <div class="form-group  " style="width: 500Px">

<label>Feature Movie</label>
                    <select id="movie" class="form-control" size="15" multiple>




                    </select>
                    <div class="help-block">Ctrl + select for multile selection </div>
                </div>
            </form>
            <div><button class="btn btn-success  " onclick="setFeature()">Set feature movie</button></div>
        </div>
        <br>
        <br>
<div id="f_movie"></div>
    </div>
@endsection
@section('script')
    <script>
        var url = 'http://95.215.62.43/onlineM/api/movies/';
        function showData() {
            $.post('http://95.215.62.43/onlineM/api/dashboard/get_dashboard.php',
                    {},
                    function (data) {

                        json = data;


                        $('#movies').html(json.data.total_movies);
                        $('#actor').html(json.data.total_actors);
                        $('#cast').html(json.data.total_cast);
                        $('#series').html(json.data.total_tv_series);


                    });

        }
        showData();
        setInterval(function () {


            showData();


        }, 5000);
        function getmovies() {

            $.post('http://95.215.62.43/onlineM/api/movies/get_movies.php',
                    {},
                    function(data){

                        json = data;

                        for(var i =0; i < json.data.length ; i++){

                            $('#movie').append( '<option value="'+json.data[i].movie_id+'">'+json.data[i].movie_id+'-'+json.data[i].title+' </option>');


                        }

                    });

        }
    getmovies();

      function setFeature () {
          var isFormValid = true;
          $(".required").each(function () {
              if ($.trim($(this).val()).length == 0) {
                  $(this).addClass("has-error");
                  isFormValid = false;
              }
              else {
                  $(this).removeClass("has-error");
              }
          });

          if (!isFormValid) {
              return false;
          }

          var movie_ids = [];
          $("#movie option:selected").each(function () {
              movie_ids.push($(this).val());
          });

          var selected_ids=movie_ids.join(",");
          var form_data = new FormData(document.querySelector("#data"));
          $('button').prop('disabled', true);
          form_data.append('movie_ids',selected_ids);
          jQuery.ajax({
              url: url+'update_featured_movies.php',
              data: form_data,
              cache: false,
              contentType: false,
              processData: false,
              type: 'POST',
              success: function (data) {

                  json = data;
                  if (json.success == true) {


                      document.getElementById("data").reset();
                      getFeature();
                      $('button').prop('disabled', false);
                  } else {

                      $('button').prop('disabled', false);
                  }


              }
          });



      }

      function getFeature() {

          $.post(url+'/get_featured_movies.php',
                  {},
                  function(data){

                      json = data;



                      $('#f_movie').html('');
                      for(var i =0; i < json.data.length ; i++){

                          $('#f_movie').append( '<span class="label-info label " style="padding: 7px;margin-left: 4px">'+json.data[i].title+' </span>');


                      }

                      var selectEl = document.querySelector("#movie");
                      for (var k = 0; k < selectEl.options.length; k++) {
                          for (var j = 0; j < json.data.length; j++) {
                              if (json.data[j].movie_id == selectEl.options[k].value) {
                                  selectEl.options[k].selected = true;
                              }
                          }
                      }

                  });



      }
        getFeature();
    </script>
@endsection