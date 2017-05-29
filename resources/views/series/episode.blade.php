@extends('layouts.final')
@section('title','Episode | Online M')


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
                    <label for="ex2">Episode Link</label>
                    <input class="form-control required" type="text" name="episode_path">
                </div>

            </div>
            <div class="form-group row">

                <div class="col-xs-6">
                    <label for="ex2">Thumb image</label>
                    <input class="form-control required" type="file" name="thumb_img">
                </div>
                <div class="col-xs-6">
                    <label for="ex2">Poster image</label>
                    <input class="form-control required" type="file" name="poster_img">
                </div>

            </div>
            <div class="form-group row">
                <div class="col-xs-6">
                    <label for="ex1">Duration</label>
                    <input class="form-control required" type="text" name="duration">
                </div>


                    <div class="col-xs-3">
                        <label for="ex2">Quality</label>
                        <select class="form-control " id="modal-quality" name="quality">
                            <option>HD</option>
                            <option>CAM</option>
                            <option>DVD</option>
                            <option>HDCAM</option>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <label for="ex2">Language</label>
                        <select class="form-control " id="modal-language" name="language">
                            <option>ENGLISH</option>
                            <option>ARABIC</option>
                            <option>HINDI</option>

                        </select>

                    </div>

            </div>
            <div class="form-group row">

                <div class="link-row">
                    <div class="">
                        <div class="col-xs-6"><label for="ex2">Vedio Link</label>
                            <input class="form-control required" type="text" name="links[]"></div>
                        <div class="col-xs-3">
                            <label for="ex2">Quality</label>
                            <select class="form-control required" name="links_quality[]">
                                <option>HD</option>
                                <option>CAM</option>
                                <option>DVD</option>
                                <option>HDCAM</option>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <label for="ex2">Language</label>
                            <select class="form-control required" name="links_language[]">
                                <option>ENGLISH</option>
                                <option>ARABIC</option>
                                <option>HINDI</option>

                            </select>

                        </div>
                    </div>
                </div>

                <div class="text-center  col-md-12 pointer" onclick="setLinkRow()" style=""><i class="fa fa-plus"
                                                                                                    style="margin:10px; color:white;background-color:#0000AA; padding:10px;"></i>
                </div>


            </div>


        </form>
        <div class="text-center">
            <button class="btn btn-primary" onclick="addEpisode()">Add Episode</button>
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Duration</th>
                            <th>Created at</th>


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
                                <input id="edit_title" class="form-control " type="text" name="title">
                            </div>
                            <div class="col-xs-6">
                                <label for="ex2">Episode Link</label>
                                <input id="edit_link" class="form-control " type="text" name="episode_path">
                            </div>

                        </div>
                        <div class="form-group row">

                            <div class="col-xs-6">
                                <label for="ex2">Thumb image</label>
                                <input class="form-control " type="file" name="thumb_img">
                            </div>
                            <div class="col-xs-6">
                                <label for="ex2">Poster image</label>
                                <input class="form-control " type="file" name="poster_img">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="ex1">Duration</label>
                                <input id="edit_duration" class="form-control " type="text" name="duration">
                            </div>

                                <div class="col-xs-3">
                                    <label for="ex2">Quality</label>
                                    <select class="form-control " id="modal-quality" name="quality">
                                        <option>HD</option>
                                        <option>CAM</option>
                                        <option>DVD</option>
                                        <option>HDCAM</option>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <label for="ex2">Language</label>
                                    <select class="form-control " id="modal-language" name="language">
                                        <option>ENGLISH</option>
                                        <option>ARABIC</option>
                                        <option>HINDI</option>

                                    </select>

                                </div>


                        </div>
                        <div class="form-group">

                            <div class="link-row" id="update_row">


                            </div>
                        </div>
                        <div class="text-center  col-md-12 pointer" onclick="setLinkRow()" style=""><i
                                    class="fa fa-plus"
                                    style="margin:10px; color:white;background-color:#0000AA; padding:10px;"></i></div>
                        <input type="hidden" id="episode_id" name="episode_id">
                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-warning btn-lg" onclick="updateEpisode()"
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
                        <input id="del_cat" name="episode_id" type="hidden">
                    </form>
                    <button type="button" class="btn btn-success" onclick="delEpisode()"><span
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

        function setLinkRow() {
            $('.link-row').append('<div class="">' +
                    '<div class="col-xs-6"><label for="ex2">Vedio Link</label>' +
                    '<input class="form-control " type="text" name="links[]"></div>' +
                    '<div class="col-xs-3">' +
                    '<label for="ex2">Quality</label>' +
                    '<select class="form-control " name="links_quality[]">' +
                    '<option>HD</option>' +
                    '<option>CAM</option>' +
                    '<option>DVD</option>' +
                    '<option>HDCAM</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="col-xs-3">' +
                    '<label for="ex2">Language</label>' +
                    '<select class="form-control " name="links_language[]">' +
                    '<option>ENGLISH</option>' +
                    '<option>ARABIC</option>' +
                    '<option>HINDI</option>' +

                    '</select>' +

                    '</div>' +
                    '<i class="fa fa-times pointer" onclick="removeLinkRow(this)"><i/>' +
                    '</div>');


        }
        function removeLinkRow(e) {

            e.parentElement.remove();
        }
        var url = 'http://95.215.62.43/onlineM/api/series/';
        var serial_id = "{{$id}}";


        function addEpisode() {

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


            form_data.append('tv_serial_id', serial_id);
            jQuery.ajax({
                url: url + 'add_episode.php',
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

                        getEpisode();
                        $('button').prop('disabled', false);
                    } else {

                        $('button').prop('disabled', false);
                        $('.response').html('<div class="alert alert-danger text-center"><a class="close" data-dismiss="alert">×</a><span> Some thing wrong try again ... </span></div>');

                    }


                }
            });


        }
        function getEpisode() {

            $.post(url + 'get_series_episodes.php',
                {series_id: serial_id},
                function (data) {

                    json = data;


                    for (var i = 0; i < json.data.length; i++) {

                        $('#cat_tbl').append('<tr>' +
                            '<td><img src="http://95.215.62.43/onlineM/' + json.data[i].thumb_img + '" height="50px" width="50px" ></td>' +
                            '<td>' + json.data[i].title + '</td>' +
                            '<td>' + json.data[i].duration + '</td>' +
                            '<td>' + json.data[i].create_time + '</td>' +
                            ' <td class="text-center"><span data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" onclick="editData(' + json.data[i].episode_id + ')" ><span class="glyphicon glyphicon-pencil"></span></button></span>' +
                            '<span data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"  onclick="sureDelete(' + json.data[i].episode_id + ')" ><span class="glyphicon glyphicon-trash"></span></button></span>' +
                            '</td>' +
                            '</tr>');


                    }

                    refreshTable();
                });

        }
        function sureDelete(id) {
            $('.del-msg').html('Are you sure you want to delete this Record?');
            $('#del_cat').val(id);

        }
        function delEpisode() {

            var form_data = new FormData(document.querySelector("#del_form"));

            jQuery.ajax({
                url: url + 'delete_episode.php',
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
                        $('#delete').modal('hide');
                        $('#cat_tbl').html('');
                        getEpisode();
                    } else {


                        $('.del-msg').html('Some thing Wrong try again..');

                    }


                }
            });


        }


        function editData(id) {


            $.post(url + 'get_series_episodes.php',
                {series_id: serial_id},
                function (data) {

                    json = data;


                    for (var i = 0; i < json.data.length; i++) {


                        if (json.data[i].episode_id == id) {

                            $('#edit_title').val(json.data[i].title);
                            $('#edit_duration').val(json.data[i].duration);
                            $('#edit_link').val(json.data[i].episode_path);
                            $('#edit_desc').html(json.data[i].description);
                            $('#episode_id').val(json.data[i].episode_id);

                            setLanguage(json.data[i].language);
                            setQuality(json.data[i].quality);
                            for (var j = 0; j < json.data[i].links.length; j++) {
                                $('#update_row').append('<div class="">' +
                                    '<div class="col-xs-6"><label for="ex2">Vedio Link</label>' +
                                    '<input class="form-control " type="text" value="' + json.data[i].links[j].link + '" name="links[]"></div>' +
                                    '<div class="col-xs-3">' +
                                    '<label for="ex2">Quality</label>' +
                                    '<select class="form-control " name="links_quality[]">' +

                                    '<option ' + ((json.data[i].links[j].quality == "HD") ? "selected" : "") + '>HD</option>' +
                                    '<option ' + ((json.data[i].links[j].quality == "CAM") ? "selected" : "") + '>CAM</option>' +
                                    '<option ' + ((json.data[i].links[j].quality == "DVD") ? "selected" : "") + '>DVD</option>' +
                                    '<option ' + ((json.data[i].links[j].quality == "HDCAM") ? "selected" : "") + '>HDCAM</option>' +
                                    '</select>' +
                                    '</div>' +
                                    '<div class="col-xs-3">' +
                                    '<label for="ex2">Language</label>' +
                                    '<select class="form-control " name="links_language[]">' +
                                        '<option ' + ((json.data[i].links[j].language == "ARABIC") ? "selected" : "") + '>ARABIC</option>' +
                                        '<option ' + ((json.data[i].links[j].language == "ENGLISH") ? "selected" : "") + '>ENGLISH</option>' +
                                        '<option ' + ((json.data[i].links[j].language == "HINDI") ? "selected" : "") + '>HINDI</option>' +

                                    '</select>' +

                                    '</div>' +
                                    '<i class="fa fa-times pointer" onclick="removeLinkRow(this)"><i/>' +
                                    '</div>');

                            }

                        }


                    }


                });


        }


        function updateEpisode() {


            var form_data = new FormData(document.querySelector("#edit_form"));


            jQuery.ajax({
                url: url + 'update_episode.php',
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


                        getEpisode();


                    } else {


                        $('.response').html('<div class="alert alert-danger text-center"><a class="close" data-dismiss="alert">×</a><span> Some thing wrong try again ... </span></div>');

                    }


                }
            });


        }

        function setQuality($value) {
            var selectEl = document.querySelector("#modal-quality");
            for (var i = 0; i < selectEl.options.length; i++) {

                if ($value == selectEl.options[i].value) {
                    selectEl.options[i].selected = true;
                }

            }
        }
        function setLanguage($value) {
            var selectEl = document.querySelector("#modal-language");
            for (var i = 0; i < selectEl.options.length; i++) {

                if ($value == selectEl.options[i].value) {
                    selectEl.options[i].selected = true;
                }

            }
        }

        /*


         */


        getEpisode();
        /*




         getmovies();



         ;*/


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