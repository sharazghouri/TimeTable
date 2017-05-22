@extends('layouts.final')
@section('title','Notifcation | Online M')


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
                    <label for="ex2">URL</label>
                    <input class="form-control " type="text" name="url">
                </div>

            </div>
            <div class="form-group row">
                <div class="col-xs-6">
                    <label for="ex1">Movie ID</label>
                    <input class="form-control " type="number" name="movie_id">
                </div>
                <div class="col-xs-6">
                    <label for="ex2">Serial ID</label>
                    <input class="form-control " type="number" name="serial_id">
                </div>

            </div>
            <div class="form-group row">
                <div class="col-xs-6">
                    <label for="ex1">Image url </label>
                    <input class="form-control " type="text" name="image">
                </div>


            </div>


            <div class="form-group row">
                <div class="col-xs-12">
                    <label for="ex1">Message</label>
                    <textarea name="msg" class="form-control required" rows="5"></textarea>

                </div>

            </div>

        </form>
        <div class="text-center">
            <button class="btn btn-primary" onclick="sendNotifcation()">Send <i class="fa fa-send"></i></button>
            <br>
            <br>
        </div>
    </div>
    <div class="response"></div>


@endsection
@section('script')

    <script>

        var url = 'http://95.215.62.43/onlineM/api/';

        function sendNotifcation() {
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
            $('button').prop('disabled', true);
            jQuery.ajax({
                url: url+'send_notification.php',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (data) {

                    json = data;
                    if (json.success == true) {
                        document.querySelector("#data").reset();
                        $('.response').html('<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><span> Successfully Sent ... </span></div>');
                    } else {
                        $('.response').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><span> Some thing wrong try again ...</div>');

                    }

                    $('button').prop('disabled', false);
                }
            });

        }

    </script>
    <!-- DataTables -->

@endsection