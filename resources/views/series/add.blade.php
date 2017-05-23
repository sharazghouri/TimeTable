@extends('layouts.final')
@section('title','Series | Online M')


@section('styles')

    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
@endsection
@section('content')


    <!-- Small boxes (Stat box) -->
    <div class="row" style="margin-left: 5px;">
        <form id="data">
            <div class="form-group row">
                <div class="col-xs-6">
                    <label for="ex1">Title</label>
                    <input class="form-control required" type="text" name="title">
                </div>
                <div class="col-xs-6">
                    <label for="ex2">Writer</label>
                    <input class="form-control required" type="text" name="writer">
                </div>

            </div>
            <div class="form-group row">
                <div class="col-xs-6">
                    <label for="ex1">Director</label>
                    <input class="form-control required" type="text" name="director">
                </div>
                <div class="col-xs-6">
                    <label for="ex2">Thumb image</label>
                    <input class="form-control required" type="file" name="thumb_img">
                </div>

            </div>
            <div class="form-group row">
                <div class="col-xs-6">
                    <label for="ex1">Description</label>
                    <textarea name="description" class="form-control required" rows="5"></textarea>

                </div>
                <div class="col-xs-6">
                    <label for="ex2">Actor</label>
                    <textarea class="form-control required" name="actors" rows="5"></textarea>
                </div>

            </div>

        </form>
        <div class="text-center">
            <button class="btn btn-primary" onclick="addSeries()">Add Series</button>
            <br>
            <br>
        </div>
    </div>
    <div class="response"></div>

    <div class="row">


        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Series</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Writer</th>
                            <th>Director</th>
                            <th>Actors</th>
                            <th>Episode</th>


                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id='cat_tbl'>


                        {{-- <tr>
                              <td>Other browsers</td>
                              <td>All others</td>
                              <td>-</td>
                              <td class="text-center"><span data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></span>
                                  <span data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></span>
                              </td>

                          </tr>--}}
                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    </div>
    <!--Update Modal-->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
                </div>
                <div class="modal-body">
                    <form id="edit_form">
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="ex1">Title</label>
                                <input id="edit_title"  class="form-control" type="text" name="title">
                            </div>
                            <div class="col-xs-6">
                                <label for="ex2">Writer</label>
                                <input id="edit_writer" class="form-control" type="text" name="writer">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="ex1">Director</label>
                                <input id="edit_director" class="form-control " type="text" name="director">
                            </div>
                            <div class="col-xs-6">
                                <label for="ex2">Thumb image</label>
                                <input class="form-control"  type="file" name="thumb_img">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="ex1">Description</label>
                                <textarea id="edit_desc" name="description" class="form-control " rows="5"></textarea>

                            </div>
                            <div class="col-xs-6">
                                <label for="ex2">Cast</label>
                                <select id="modal-cast" class="category form-control " size="5" multiple>
                                </select>
                                <span class="help-block">ctrl +  select for multiple select</span>
                            </div>

                        </div>
                        <input  name="serial_id" id="series_id" hidden>
                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-warning btn-lg" onclick="updateSerial()"
                            style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span><span
                                class="update-msg">Update</span></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Delete modal-->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger del-msg"><span class="glyphicon glyphicon-warning-sign"></span> Are
                        you sure you want to delete this Record?
                    </div>

                </div>
                <div class="modal-footer ">
                    <form id="del_form">
                        <input id="del_cat" name="serial_id" type="hidden">
                    </form>
                    <button type="button" class="btn btn-success" onclick="delSeries()"><span
                                class="glyphicon glyphicon-ok-sign"></span> Yes
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                class="glyphicon glyphicon-remove"></span> No
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('script')

    <script>

        var url = 'http://95.215.62.43/onlineM/api/series/';



        function  addSeries() {

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
            $('button').prop('disabled', true);



            var form_data = new FormData(document.querySelector("#data"));



            jQuery.ajax({
                url: url+'add_serial.php',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (data) {

                    json = data;
                    if (json.success == true) {

                        $('.response').html('<div class="alert alert-success text-center"><a class="close" data-dismiss="alert">×</a><span> Successfully Added ... </span></div>');
                        document.getElementById("data").reset();
                        $('#cat_tbl').html('');

                        getSeries();
                        $('button').prop('disabled', false);
                    } else {

                        $('button').prop('disabled', false);
                        $('.response').html('<div class="alert alert-danger text-center"><a class="close" data-dismiss="alert">×</a><span> Some thing wrong try again ... </span></div>');

                    }


                }
            });




        }
        function getSeries() {

            $.post(url+'get_series.php',
                    {},
                    function(data){

                        json = data;




                        for(var i =0; i < json.data.length ; i++){

                            $('#cat_tbl').append( '<tr>'+
                                    '<td>'+json.data[i].series_id+'</td>'+
                                    '<td><img src="http://95.215.62.43/onlineM/'+json.data[i].thumb_img+'" height="50px" width="50px" ></td>'+
                                    '<td>'+json.data[i].title+'</td>'+
                                    '<td>'+json.data[i].writer+'</td>'+
                                    '<td>'+json.data[i].director+'</td>'+
                                    '<td>'+json.data[i].cast_titles+'</td>'+
                                    '<td><a href="/moviesapp/episode/'+json.data[i].series_id+'"> <span class="badge">'+json.data[i].episodes.length+'</span></a> </td>'+
                                    ' <td class="text-center"><span data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" onclick="editData('+json.data[i].series_id+')" ><span class="glyphicon glyphicon-pencil"></span></button></span>'+
                                    '<span data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"  onclick="sureDelete('+json.data[i].series_id+')" ><span class="glyphicon glyphicon-trash"></span></button></span>'+
                                    '</td>'+
                                    '</tr>');


                        }

                        refreshTable();
                    });

        }

        function  sureDelete(id) {

            $('#del_cat').val(id);

        }
        function delSeries() {

            var form_data = new FormData(document.querySelector("#del_form"));

            jQuery.ajax({
                url: url+'delete_serial.php',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (data) {

                    json = data;
                    if (json.success == true) {
                        $('input').val('');
                        $('.del-msg').html('Deleted Successfullly ...');

                        $('#cat_tbl').html('');
                        getSeries();
                    } else {


                        $('.del-msg').html('Some thing Wrong try again..');

                    }


                }
            });


        }

        function  editData(id) {



            $.post(url+'get_series.php',
                    {},
                    function(data){

                        json = data;




                        for(var i =0; i < json.data.length ; i++){


                            if(json.data[i].series_id   == id){

                                $('#edit_title').val(json.data[i].title);
                                $('#edit_writer').val(json.data[i].writer);
                                $('#edit_director').val(json.data[i].director);
                                $('#edit_desc').html(json.data[i].description);
                                $('#series_id').val(json.data[i].series_id);
                                setCategory(json.data[i].casts);




                            }


                        }


                    });




        }

        function updateSerial() {



            var actor_ids = [];

            $("#modal-cast option:selected").each(function () {
                actor_ids.push($(this).val());
            });
            var selected_actors=actor_ids.join(",")

            var form_data = new FormData(document.querySelector("#edit_form"));


            form_data.append('cast_ids',selected_actors);

            jQuery.ajax({
                url: url+'update_serial.php',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (data) {

                    json = data;
                    if (json.success == true) {

                        $('#cat_tbl').html('');
                        $('#edit').modal('hide');


                        getSeries()  ;


                    } else {


                        $('.response').html('<div class="alert alert-danger text-center"><a class="close" data-dismiss="alert">×</a><span> Some thing wrong try again ... </span></div>');

                    }


                }
            });




        }




        getSeries();
    /*




        getmovies();



       ;*/
        function setCategory(preData) {

            $.post('http://95.215.62.43/onlineM/api/cast/get_cast.php',
                    {},
                    function (data) {

                        json = data;


                        for (var i = 0; i < json.data.length; i++) {

                            $('.category').append('<option value="' + json.data[i].cast_id + '">' + json.data[i].full_name + '</option>');
                        }

                        if(preData != null) {
                            var selectEl = document.querySelector("#modal-cast");
                            for(var i=0; i<selectEl.options.length; i++) {
                                for(var j=0; j<preData.length; j++) {
                                    if(preData[j].cast_id == selectEl.options[i].value) {
                                        selectEl.options[i].selected = true;
                                    }
                                }
                            }
                        }


                    });

        }
        setCategory(null);

    </script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        var dataTable = null;
        function refreshTable() {
            if (dataTable != null) {
                dataTable.fnDestroy();
            }
            dataTable = $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        }

    </script>
@endsection