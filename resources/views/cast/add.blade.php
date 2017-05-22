@extends('layouts.final')
@section('title','Cast | Online M')


@section('styles')

    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
    @endsection
@section('content')


    <!-- Small boxes (Stat box) -->
    <div class="container">

          <div class="form-group row">
              <form id="data">
                <div class="col-xs-6">
                    <span for="ex1">Cast Name</span>
                    <input class="form-control required" type="text" name="cast_name">
                </div>
        </form>
                <div class="col-xs-6">

                    <br>
                    <button class="btn btn-primary" onclick="addCast()">Add Cast</button>
                </div>

            </div>


    </div>
    <div class="response"></div>

    <div class="row">


        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Category</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>

                            <th>No</th>
                            <th>Cast Name</th>

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
    <div class="modal fade"  id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
                </div>
                <div class="modal-body">
               <form id="edit_form">
                    <div class="form-group">
                        <input class="form-control " type="text" name="cast_name" id="edit_en">
                    </div>
                    <div class="form-group">


                        <input  name="cast_id"  type="hidden" name="category_id" id="edit_id">
                    </div>
               </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-warning btn-lg" onclick="updateCast()" style="width: 100%;" ><span class="glyphicon glyphicon-ok-sign"></span><span class="update-msg">Update</span></button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger del-msg"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

                </div>
                <div class="modal-footer ">
                    <form id="del_form">
                        <input id="del_cat" name="cast_id"   type="hidden">
                    </form>
                    <button type="button" class="btn btn-success"   onclick="delCast()"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('script')

<script>

var url='http://95.215.62.43/onlineM/api/cast/';

function  addCast() {
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
        url: url+'add_cast.php',
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
                   getCast();
            } else {


                $('.response').html('<div class="alert alert-danger text-center"><a class="close" data-dismiss="alert">×</a><span> Some thing wrong try again ... </span></div>');

            }


        }
    });

}
function  sureDelete(id) {

    $('#del_cat').val(id);

}
function delCast() {

    var form_data = new FormData(document.querySelector("#del_form"));

    jQuery.ajax({
        url: url+'delete_cast.php',
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
                getCast();
            } else {


                $('.del-msg').html('Some thing Wrong try again..');

            }


        }
    });


}
function  editData(id) {



    $.post(url+'get_cast.php',
            {},
            function(data){

                json = data;




                for(var i =0; i < json.data.length ; i++){



                    if(json.data[i].cast_id == id){

                        $('#edit_en').val(json.data[i].full_name);

                        $('#edit_id').val(json.data[i].cast_id);



                    }


                }


            });




}
function  updateCast() {
    var form_data = new FormData(document.querySelector("#edit_form"));

    jQuery.ajax({
        url: url+'edit_cast.php',
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function (data) {

            json = data;
            if (json.success == true) {

                /*$('.update-msg').html('Update Successfullly ...');
                 */
                $('#cat_tbl').html('');
                $('#edit').modal('hide');

                getCast();
            } else {


                $('.update-msg').html('Some thing Wrong try again..');

            }


        }
    });

}


function getCast() {

    $.post(url+'get_cast.php',
            {},
            function(data){

                json = data;




                for(var i =0; i < json.data.length ; i++){

                    $('#cat_tbl').append( '<tr>'+
                            '<td>'+json.data[i].cast_id+'</td>'+
                            '<td>'+json.data[i].full_name+'</td>'+
                            ' <td class="text-center"><span data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" onclick="editData('+json.data[i].cast_id+')" ><span class="glyphicon glyphicon-pencil"></span></button></span>'+
                            '<span data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"  onclick="sureDelete('+json.data[i].cast_id+')" ><span class="glyphicon glyphicon-trash"></span></button></span>'+
                            '</td>'+
                            '</tr>');


                }

                refreshTable();
            });

}


getCast();



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
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    }

    </script>
@endsection