@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <input type="text" class='form-control' id='material_type' placeholder="Please input material type">
                </div>
                <div class="row" style="margin-top:20px">
                    <button class="btn btn-primary" onclick="add_material()">Add Material</button>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody id="table_report-tbody">
                            @for($i = 0; $i < count($material); $i++)
                            <tr id="mat-{{$material[$i]->mat_id}}" ondblclick="editRow(id)">
                                <td>Material Type</td>
                                <td class="material">{{$material[$i]->mat_type}}</td>
                            </tr>
                                
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add FAC Worker</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" id="modal-content">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Material Type</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control editMaterial" id="edit-material">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="edit_project('update')">Update</button>
                <button type="button" class="btn btn-primary" onclick="edit_project('delete')">Delete</button>

                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<script>
    function add_material() {
        let mat_type = $("#material_type").val();
        $.ajax({
            type : "post",
            url : "{{url('manpower/addmaterial')}}",
            data : {
                material_type : mat_type
            },
            success : function(data){
                toastFunction();
                let htmltxt = "";
                htmltxt += "<tr>";
                htmltxt += "<td id='mat-"+data+"'>Material Type</td>";
                htmltxt += "<td>"+mat_type+"</td>";
                htmltxt += "</tr>";
                $("#table_report-tbody").append(htmltxt);
            }
        })
    }
    let presentId = 0;
    function editRow(id) {
        presentId = id.split("-")[1];
        let material = $("#"+id).children(".material").text();
        $("#edit-material").val(material);
        $("#exampleModal2").modal("show");
    }

    function edit_project(type) {
        $.ajax({
            type : 'post',
            url : "{{url('/manpower/editmaterial')}}",
            data : {
                presentId : presentId,
                data :$("#edit-material").val(),
                type : type
            },
            success : function(data){
                toastFunction();
                $("#mat-"+presentId).children(".material").text($("#edit-material").val());
            }
        })
    }
</script>
@endsection