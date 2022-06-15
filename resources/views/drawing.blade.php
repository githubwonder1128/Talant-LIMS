@extends('layouts.app')

@section('content')
<style>
    th,td{
        text-align: center;
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
                                        <option>{{$Projects[$i]['p_code']}}</option>
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
                <div class="row">
                    <table class = 'table align-middle mb-0 bg-white' >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>P.Code</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="drawing-tbody">
                            @if(count($Drawing) == 0)
                                <tr>
                                    <td colspan="4" style="text-align: center">No Datas</td>
                                </tr>
                            @else
                                @for($i = 0; $i < count($Drawing); $i++)
                                    <tr>
                                        <td>{{$i+1}}</td>
                                        <td>{{$Drawing[$i]->p_code}}</td>
                                        <td><a href="{{asset('files/')}}/{{$Drawing[$i]->drawing_uploadurl}}">{{$Drawing[$i]->drawing_uploadurl}}</a></td>
                                        <td><button class='form-control btn-primary ' onclick="deleteimg('{{$Drawing[$i]->drawing_id}}')">delete</button></td>
                                    </tr>
                                @endfor
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script>
    function upload() {
        let file_data = $('#file-sel').prop('files')[0];
        let p_code = $("#sel-p_code").val()
        let form_data = new FormData();                  
        form_data.append('file', file_data);
        form_data.append("option",p_code);                            
        $.ajax({
            url: "{{url('/projects/uploaddrawing')}}", // <-- point to server-side PHP script 
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(data){
                toastFunction();
                let apphtml = "";
                apphtml += "<tr>";
                apphtml += "<td></td>";
                apphtml += "<td>"+p_code+"</td>";
                apphtml += "<td>"+"<a href= '{{asset('files/')}}/"+data+"'>"+data+"</td>";
                apphtml += "</tr>";
                $("#drawing-tbody").append(apphtml);
            }
        });
    }

    function display() {
        $.ajax({
            type : 'post',
            url : "{{url('/projects/getdrawing')}}",
            data : {
                p_code : $("#sel-p_code").val()
            },
            success : function(data){
                let tbodyhtml = "";
                for (let i = 0; i < data.length; i++) {
                    tbodyhtml += "<tr>";
                    tbodyhtml += "<td>"+(i+1)+"</td>";
                    tbodyhtml += "<td>"+data[i]['p_code']+"</td>";
                    tbodyhtml += "<td>"+"<a href= '{{asset('files/')}}/"+data[i]['drawing_uploadurl']+"'>"+data[i]['drawing_uploadurl']+"</td>";
                    tbodyhtml += "</tr>"
                }
                $("#drawing-tbody").html(tbodyhtml);
            }
        })
    }

    function deleteimg(Id) {
        $.ajax({
            type : "post",
            url : "{{url('/projects/deletedrawing')}}",
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