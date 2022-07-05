@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row justify-content-center" style="margin-top: 20px;">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <input type="date" class="form-control" id="sel-date" value="{{date('Y-m-d')}}" onchange="get_datas()">
                </div>
                <div class="row">
                    <table class="table" id="table-saverecord">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FAC.Worker.Name</th>
                                <th>Date</th>
                                <th>Working Hour</th>
                            </tr>
                        </thead>
                        <tbody id="table-saverecord_tbody">
                            @for($i = 0; $i < count($reports); $i++)
                                <tr data-report_id="{{$reports[$i]->report_id}}" id="tr-{{$reports[$i]->report_id}}" onclick="editRow(id)">
                                    <td>{{$i + 1}}</td>
                                    <td class="fac_workername">{{$reports[$i]->fac_workername}}</td>
                                    <td class="report_date">{{$reports[$i]->report_date}}</td>
                                    <td class="report_hour">{{$reports[$i]->report_hour}}</td>

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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit ManPower</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" id="modal-content">
                    <div class="row justify-content-center">

                        <div class="row" style="margin-top:10px">
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class='form-control' id="edit-fac_workername">
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top:10px">
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <label>Date</label>
                                </div>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class='form-control' id="edit-report_date">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" style="margin-top:10px">
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <label>Hours</label>
                                </div>
                                <div class="col-md-9 col-sm-6">
                                    <input type="number" class='form-control' id="edit-report_hour">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="update_btn"
                    onclick="edit_project('update')">Update</button>
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<script>
    let report_id;
    // eventTr();
    $("#table-saverecord").DataTable({
        searching :false,
        "lengthMenu": [[100, 25, 50, -1], [100, 25, 50, "All"]]
    });

    function editRow(id) {
        report_id = id.split("-")[1];
        let fac_workername = $("#"+id).children("td:nth-child(2)").text();
        let report_date = $("#"+id).children("td:nth-child(3)").text();
        let report_hour = $("#"+id).children("td:nth-child(4)").text();
        $("#edit-fac_workername").val(fac_workername);
        $("#edit-report_date").val(report_date);
        $("#edit-report_hour").val(report_hour);
        $("#exampleModal2").modal("show");
    }
    function eventTr() {
        $("table tbody tr").click(function(){
            report_id = $(this).data("report_id");
            let fac_workername = $(this).children("td:nth-child(2)").text();
            let report_date = $(this).children("td:nth-child(3)").text();
            let report_hour = $(this).children("td:nth-child(4)").text();
            $("#edit-fac_workername").val(fac_workername);
            $("#edit-report_date").val(report_date);
            $("#edit-report_hour").val(report_hour);
            $("#exampleModal2").modal("show");
        })
    }
    

    function edit_project() {
        $.ajax({
            type : 'post',
            url : "{{url('/manpower/updatereport')}}",
            data : {
                report_id : report_id,
                report_hour : $("#edit-report_hour").val()
            },
            success : function(data)
            {
                $("#tr-"+report_id).children("td:nth-child(4)").text($("#edit-report_hour").val());
            }
        })
    }

    function get_datas() {
        const seldata = $("#sel-date").val();
        $.ajax({
            type : 'post',
            url : "{{url('/manpower/get_records')}}",
            data : {
                date : seldata
            },
            success : function(data){
                toastFunction();
                let htmtxt = '';
                for (let i = 0; i < data.length; i++) {
                    htmtxt += "<tr data-report_id='"+data[i]['report_id']+"' id='tr-"+data[i]['report_id']+"' onclick='editRow(id)'>";
                    htmtxt += "<td>"+(i+1)+"</td>";
                    htmtxt += "<td class='fac_workername'>"+data[i]['fac_workername']+"</td>"; 
                    htmtxt += "<td class='report_date'>"+data[i]['report_date']+"</td>";                                        
                    htmtxt += "<td class='report_hour'>"+data[i]['report_hour']+"</td>";                                        
                    htmtxt += "</tr>";
                }
                $("#table-saverecord_tbody").html(htmtxt);
                $("#table-saverecord").DataTable()
                editRow()
            }
        })
    }
</script>
@endsection