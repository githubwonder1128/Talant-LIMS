@extends('layouts.app')

@section('content')
<style>
    th,td{
        text-align: center;
    }
    .card{
        margin-top: 10px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5">
                                <select class="form-control" id="sel-p_code" onchange="display()">
                                    <option></option>
                                    @for($i = 0; $i < count($Projects); $i++)
                                        <option>{{$Projects[$i]['p_code']}}_{{$Projects[$i]['p_name']}}_{{$Projects[$i]['company_name']}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input type='file' class='form-control'  id="file-sel"/>
                            </div>
                            <div class="col-md-2">
                                <button class="form-control btn-primary" onclick="upload()"><i class="fa fa-upload"></i></button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="gallery_items">
        @for($i = 0; $i < count($Gallery); $i++ )
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{asset('files')}}/{{$Gallery[$i]->photo_uploadurl}} " width="100%">
                    </div>
                    <div class="card-foot">
                        <button class="btn-primary form-control" onclick="deleteimg('{{$Gallery[$i]->photo_id}}')">delete</button>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    
</div>

<script>
    function upload() {
        let file_data = $('#file-sel').prop('files')[0];
        let p_code = $("#sel-p_code").val().split("_")[0]
        let form_data = new FormData();                  
        form_data.append('file', file_data);
        form_data.append("option",p_code);                            
        $.ajax({
            url: "{{url('/projects/uploadgallery')}}", // <-- point to server-side PHP script 
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(data){
                display()
            }
        });
    }

    function display() {
        $.ajax({
            type : 'post',
            url : "{{url('/projects/getgallery')}}",
            data : {
                p_code : $("#sel-p_code").val().split("_")[0]
            },
            success : function(data){
                toastFunction();

                let galleryhtml = ''
                for (let i = 0; i < data.length; i++) {
                    galleryhtml += "<div class='col-md-4'>";
                    galleryhtml += "<div class='card'>"
                    galleryhtml += "<div class='card-body'>"
                    galleryhtml += "<img src='{{asset('files')}}/"+data[i]['photo_uploadurl']+"' width='100%'>";
                    galleryhtml += "</div>";
                    galleryhtml += "<div class='card-foot'>";
                    galleryhtml +=  "<button class='btn-primary form-control' onclick='deleteimg("+data[i]['photo_id']+")'>delete</button>"
                    galleryhtml += "</div>"
                    galleryhtml += "</div>";
                    galleryhtml += "</div>";
                }
                $("#gallery_items").html(galleryhtml);
            }

        })
    }

    function deleteimg(Id) {
        $.ajax({
            type : "post",
            url : "{{url('/projects/deletegallery')}}",
            data : {
                id : Id
            },
            success : function(data)
            {
                display();
            }
        })
    }
</script>
@endsection