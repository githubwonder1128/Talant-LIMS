@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>P.Code</th>
                                <th>P.Name</th>
                                <th>Type</th>
                                <th>Note</th>
                                <th>Qiantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($reports); $i++)
                                <tr id="table_materialrecords-{{$reports[$i]->material_recordid}}" ondblclick="editRow(id)">
                                    <td>{{$i+1}}</td>
                                    <td class="material_recorddate" data-text="{{$reports[$i]->material_recorddate}}">{{$reports[$i]->material_recorddate}}</td>
                                    <td class="p_code" data-text="{{$reports[$i]->p_code}}">{{$reports[$i]->p_code}}</td>
                                    <td class="p_name" data-text="{{$reports[$i]->p_name}}">{{$reports[$i]->p_name}}</td>
                                    <td class="material_recordtype" data-text="{{$reports[$i]->mat_id}}">{{$reports[$i]->mat_type}}</td>
                                    <td class="material_recordnote" data-text="{{$reports[$i]->material_recordnote}}">{{$reports[$i]->material_recordnote}}</td>
                                    <td class="material_recordquantity" data-text="{{$reports[$i]->material_recordquantity}}">{{$reports[$i]->material_recordquantity}}</td>
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
                            <label>Date</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" class="form-control editreport" id="edit-material_recorddate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>P.Code</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control editreport" id="edit-p_code">
                                @for($i = 0; $i < count($projects); $i++)
                                    <option>{{$projects[$i]->p_code}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Type</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control editreport" id="edit-material_recordtype">
                                @for($i = 0; $i < count($material); $i++)
                                    <option value = "{{$material[$i]->mat_id}}">{{$material[$i]->mat_type}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Note</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control editreport" id="edit-material_recordnote">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Quantity</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control editreport" id="edit-material_recordquantity" >
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
    let presentId;
    function editRow(id) {
        presentId = id.split("-")[1];
        let result = {};
        $("#"+id + " td").filter(function () {
            let clname = $(this).attr("class");
            result[clname] = $(this).data("text");
            console.log($(this).data("text"));
            $("#edit-" + clname).val($(this).data('text'))
        })
        $("#exampleModal2").modal('show');
    }

    function edit_project(editType) {
        let editData = {};
        $(".editreport").filter(function(){
            let id = $(this).attr("id").split("-")[1];
            editData[id] = $(this).val()
        })
        console.log(editData);
        $.ajax({
            type : "post",
            url : "{{url('/manpower/editmaterialrecord')}}",
            data : {
                editType : editType,
                record_id : presentId,
                editData : editData
            },
            success : function(data)
            {
                toastFunction();
                console.log(data);
                switch (editType) {
                    case "update":
                    $("#table_materialrecords-"+presentId+" td").filter(function(){
                            let classname = $(this).attr("class");
                            $(this).text(editData[classname]);
                            $(this).attr("data-text",editData[classname]);
                            if (classname == "material_recordtype") {
                                $(this).text(data[0]);

                            }
                    })
                        break;
                    case "delete":
                        $("#table_materialrecords-"+presentId).remove()
                    default:
                        break;
                }
            }
        })
    }
</script>
@endsection