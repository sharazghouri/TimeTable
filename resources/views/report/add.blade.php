@extends('layouts.final')
@section('title','Report | Online M')


@section('styles')

    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
    @endsection
@section('content')


    <!-- Small boxes (Stat box) -->
    <div class="response"></div>

    <div class="row">


        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Reports</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>

                            <th>No</th>
                            <th>Comments</th>
                            <th>Movie</th>

                            <th>Date</th>
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
                        </tbody >

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    </div>
<!--Update Modal-->

    <!--Delete modal-->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger del-msg"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

                </div>
                <div class="modal-footer ">
                    <form id="del_form">
                        <input id="del_cat" name="report_id"   type="hidden">
                    </form>
                    <button type="button" class="btn btn-success"   onclick="delReport()"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
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
                                <input class="form-control " id="edit_title" type="text" name="title">
                            </div>
                            <div class="col-xs-6">
                                <label for="ex2">Duration</label>
                                <input class="form-control " id="edit_duration" type="text" name="duration">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="ex1">Release Year</label>
                                <input class="form-control " id="edit_year" type="text" name="release_date">
                            </div>

                            <div class="col-xs-6">
                                <div class="col-xs-6">
                                    <label for="ex2">Quality</label>
                                    <select class="form-control " id="modal-quality" name="quality">
                                        <option>HD</option>
                                        <option>CAM</option>
                                        <option>DVD</option>
                                        <option>HDCAM</option>
                                    </select>
                                </div>
                                <div class="col-xs-6">
                                    <label for="ex2">Language</label>
                                    <select class="form-control " id="modal-language" name="language">
                                        <option>ARABIC</option>
                                        <option>ENGLISH</option>
                                        <option>HINDI</option>

                                    </select>

                                </div>
                            </div>


                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="ex1">Category</label>
                                <select id="modal-categories" class=" category form-control " size="5" multiple>

                                </select>
                            </div>
                            <div class="col-xs-6">
                                <label for="ex2">Actor</label>
                                <textarea id="edit_actors" class="form-control " style="height: 100px;"
                                          name="actors"></textarea>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <label for="ex1">Poster</label>
                                <input type="file" name="poster_img" class="form-control ">
                            </div>
                            <div class="col-xs-6">
                                <label for="ex2">Thumb</label>
                                <input type="file" name="thumb_img" class="form-control ">
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-xs-6"><label>Description </label>
                                <input type="hidden" name="movie_id" id="movie_id">
                                <textarea name="description" id="edit_desc" class="form-control "></textarea></div>
                            <div class="col-xs-6"><label>Description Arabic</label>

                                <textarea name="description_ar" id="edit_desc_ar" class="form-control "></textarea>
                            </div>

                        </div>
                        <div class="form-group">

                            <div class="link-row" id="update_row">


                            </div>
                        </div>
                        <div class="text-center fixed col-md-12 pointer" onclick="setLinkRow()" style=""><i class="fa fa-plus"
                                                                                                            style="margin:10px; color:white;background-color:#0000AA; padding:10px;"></i>
                        </div>
                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-warning btn-lg" onclick="updateMovie()"
                            style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span><span
                                class="update-msg">Update</span></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('script')

<script>

var url='http://95.215.62.43/onlineM/api/report/';
var url_movie = 'http://95.215.62.43/onlineM/api/movies/';
/*
function  addActor() {
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
    var form_data = new FormData(document.querySelector("#data"));

    jQuery.ajax({
        url: url+'add_actor.php',
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function (data) {

            json = data;
            if (json.success == true) {
                $('input').val('');
                $('.response').html('<div class="alert alert-success text-center"><a class="close" data-dismiss="alert">×</a><span> Successfully Added ... </span></div>');

            } else {


                $('.response').html('<div class="alert alert-danger text-center"><a class="close" data-dismiss="alert">×</a><span> Some thing wrong try again ... </span></div>');

            }


        }
    });

}

function  editData(id) {



    $.post(url+'get_actors.php',
            {},
            function(data){

                json = data;




                for(var i =0; i < json.data.length ; i++){


                    if(json.data[i].actor_id == id){

                        $('#edit_en').val(json.data[i].full_name);

                        $('#edit_id').val(json.data[i].actor_id);



                    }


                }


            });




}


function  updateActor() {
    var form_data = new FormData(document.querySelector("#edit_form"));

    jQuery.ajax({
        url: url+'edit_actor.php',
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


                getActor()  ;
            } else {


                $('.update-msg').html('Some thing Wrong try again..');

            }


        }
    });

}

*/
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
function  sureDelete(id) {
    $('.del-msg').html('Are you sure you want to delete this Record?');
    $('#del_cat').val(id);

}
function delReport() {

    var form_data = new FormData(document.querySelector("#del_form"));

    jQuery.ajax({
        url: url+'delete_report.php',
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

                getReport();
            } else {


                $('.del-msg').html('Some thing Wrong try again..');

            }


        }
    });


}
function getReport() {

    $.post(url+'get_reports.php',
            {},
            function(data){

                json = data;




                for(var i =0; i < json.data.length ; i++){

                    $('#cat_tbl').append( '<tr>'+
                            '<td>'+json.data[i].movie_id+'</td>'+
                            '<td>'+json.data[i].comment+'</td>'+
                            '<td><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" onclick="editData('+json.data[i].movie_id+')" >'+json.data[i].movie.title+'</button></td>'+
                            '<td>'+json.data[i].create_time+'</td>'+
                            ' <td class="text-center">'+
                            '<span data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"  onclick="sureDelete('+json.data[i].report_id+')" ><span class="glyphicon glyphicon-trash"></span></button></span>'+
                            '</td>'+
                            '</tr>');


                }

                refreshTable();
            });

}

function editData(id) {


    $.post(url_movie + 'get_movies.php',
            {},
            function (data) {

                json = data;


                for (var i = 0; i < json.data.length; i++) {


                    if (json.data[i].movie_id == id) {

                        $('#edit_title').val(json.data[i].title);
                        $('#edit_duration').val(json.data[i].duration);
                        $('#edit_year').val(json.data[i].release_date);
                        $('#edit_link').val(json.data[i].movie_uri);
                        $('#edit_desc').html(json.data[i].description);
                        $('#edit_desc_ar').html(json.data[i].description_ar);
                        $('#movie_id').val(json.data[i].movie_id);
                        $('#edit_actors').val(json.data[i].actors_titles);
                        setQuality(json.data[i].quality);
                        setLanguage(json.data[i].Language);
                        setCategory(json.data[i].categories);
                        $('#update_row').html('');

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
function updateMovie() {


    var category_ids = [];
    $("#modal-categories option:selected").each(function () {
        category_ids.push($(this).val());
    });
    var selected_categories=category_ids.join(",");
    var actor_ids = [];

    $("#modal-actors option:selected").each(function () {
        actor_ids.push($(this).val());
    });
    var selected_actors=actor_ids.join(",")

    var form_data = new FormData(document.querySelector("#edit_form"));

    form_data.append('category_ids',selected_categories);
    form_data.append('actor_ids',selected_actors);
    jQuery.ajax({
        url: url_movie+'update_movie.php',
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


                getReport() ;


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
function setCategory(preData) {

    $.post('http://95.215.62.43/onlineM/api/category/get_categories.php',
            {},
            function (data) {

                json = data;


                for (var i = 0; i < json.data.length; i++) {

                    $('.category').append('<option value="' + json.data[i].category_id + '">' + json.data[i].title + '</option>');
                }

                if(preData != null) {
                    var selectEl = document.querySelector("#modal-categories");
                    for(var i=0; i<selectEl.options.length; i++) {
                        for(var j=0; j<preData.length; j++) {
                            if(preData[j].category_id == selectEl.options[i].value) {
                                selectEl.options[i].selected = true;
                            }
                        }
                    }
                }


            });

}
function setActor(preData) {

    $.post('http://95.215.62.43/onlineM/api/actor/get_actors.php',
            {},
            function (data) {

                json = data;

                for (var i = 0; i < json.data.length; i++) {

                    $('.actor').append('<option value="' + json.data[i].actor_id + '">' + json.data[i].full_name + '</option>');

                }

                if(preData != null) {
                    var selectEl = document.querySelector("#modal-actors");
                    for(var i=0; i<selectEl.options.length; i++) {
                        for(var j=0; j<preData.length; j++) {
                            if(preData[j].actor_id == selectEl.options[i].value) {
                                selectEl.options[i].selected = true;
                            }
                        }
                    }
                }
            });

}


setCategory(null);
setActor(null);

getReport();



</script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    var dataTable = null;
    function refreshTable() {
        if(dataTable != null) {
            dataTable.fnDestroy();
        }
        dataTable = $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false
        });
    }

    </script>
@endsection