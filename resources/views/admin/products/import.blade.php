@extends('admin.layouts.app_admin')

@section('content')

    <div class="container-fluid">

        @component('admin.components.breadcrumb')
            @slot('title') Импортировать товары @endslot
            @slot('parent') Главная @endslot
            @slot('active') Товары @endslot
        @endcomponent

        <hr/>
        <div class="row">
            <form class="form-horizontal col-md-12" action="{{ route('admin.products.import_store') }}" method="post"  enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Загрузить файл</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="file-input" name="import_file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Выбрать файл</label>
                    </div>
                </div>

                <button  class="btn btn-primary float-right">Импортировать</button>

            </form>
        </div>
        <div class="row">
            <div class="alert alert-warning col-md-12" role="alert" style="display: none">
            </div>
            <div class="alert alert-success col-md-12" role="alert" style="display: none">
            </div>
            <div id="progress" class="col-md-12 " style="display: none">
                <div class="progress" >
                    <div class="progress-bar progress-bar-striped" role="progressbar"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $("body").on("click",".btn-primary",function(){
            scriptOffset('start');
        });
        $("body").on("click",".btn-primary",function(e){
            $("form.form-horizontal").css("display", "none");
            $("#progress").css("display", "block");
            $(".alert-warning").css("display", "block");
            $(".alert-warning").text("Начат импорт");
            $(this).parents("form").ajaxForm(options);
        });
        var options = {
            complete: function(response){
            if($.isEmptyObject(response.responseJSON.error)){
                $(".alert-warning").css("display", "none");
                $(".alert-success").css("display", "block");
                $(".alert-success").text("Импорт завершен");
            }else{
                printErrorMsg(response.responseJSON.error);
            }
            }
        };

            function showProcess ( c_all, c_now, c_name ) {
                var c_proc = c_now * 100 / c_all;
                $(".alert-warning").text("Импортируем: " + c_name);
                $(".progress-bar").css("width", c_proc + "%");
                $(".progress-bar").attr("aria-valuenow", c_now);
                $(".progress-bar").attr("aria-valuemax", c_all);
                console.log('showProcess ' + c_now);
                sleep(1000);
                if(c_name==='finish' ) {
                    $(".alert-warning").text("Импортируем: закончили" );
                    $(".progress-bar").css("width",  "100%");
                    $(".progress-bar").attr("aria-valuenow", c_all);
                }else{
                    scriptOffset();
                }
            }

            function scriptOffset ( start='--') {
                sleep(5000);
                //console.log(start);
                $.ajax({
                    url: "/storage/uploads/import/go_status.txt",
                    dataType: "text",
                    cache: false,
                    async: true,
                    success: function (data) {
                        var arrayOfStrings = data.split(';');
                            if (start === '--' && arrayOfStrings[1]==='9999999999999999') {
                                //console.log('Все Закончил ');
                                sleep(3000);
                                showProcess(arrayOfStrings[0], arrayOfStrings[1], 'finish');
                            } else {
                                if(arrayOfStrings[1]!=='9999999999999999') {
                                    showProcess(arrayOfStrings[0], arrayOfStrings[1], arrayOfStrings[2]);
                                }else{
                                    sleep(2000);
                                    scriptOffset('start');
                                }
                            }
                        }
                });
            }


        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function (key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }

        function sleep(milliseconds) {
            var start = new Date().getTime();
            for (var i = 0; i < 1e7; i++) {
                if ((new Date().getTime() - start) > milliseconds){
                    break;
                }
            }
        }

    </script>
@endsection
