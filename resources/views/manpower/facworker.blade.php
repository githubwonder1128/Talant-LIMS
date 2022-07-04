@extends('layouts.app')

@section('content')
<style>
   #table-report td,th{
        font-size : 10px!important;
        padding : 3px 3px 3px 3px !important;
        height : auto!important;
    }


        /* #tbl_projects_wrapper{
        width: 100%;
    } */
        .col-md-5 {
            text-align: right;
        }

        .col-md-2 .card-body {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }

        .col-md-2 .card {
            margin-top: 5px !important;
        }
</style>

<style>
    /* #tbl_projects_wrapper{
        width: 100%;
    } */
    .col-md-5 {
        text-align: right;
    }

    .col-md-2 .card-body {
        padding-top: 10px !important;
        padding-bottom: 0px !important;
    }

    .col-md-2 .card {
        margin-top: 5px !important;
    }
</style>


<div class="container-fluid">
    <div class="row">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" onclick="display()">Add Factory Worker</button>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="row">
                            <table class="table mdl-data-table" id="table_facworker" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th><b>No</b></th>
                                        <th><b>FAC WORK NAMe</b></th>
                                        <th><b>FAC RATE</b></th>
                                        <th><b>FAC MEAL</b></th>
                                        <th><b>FAC MONTHLY</b></th>
                                        <th><b>FAC ACTIVE</b></th>

                                    </tr>
                                </thead>
                                <tbody id="table_facworker-tbody">
                                    @for($i = 0; $i < count($facworkers); $i++) 
                                    <tr
                                        ondblclick="editworker('{{$facworkers[$i]->fac_id}}')"
                                        id="table_facworker-{{$facworkers[$i]->fac_id}}">

                                        <td class="fac_no" data-text="{{$i+1}}">
                                            {{$i+1}}</td>


                                        <td class="fac_workername" data-text="{{$facworkers[$i]->fac_workername}}">
                                            {{$facworkers[$i]->fac_workername}}</td>

                                        <td class="fac_rate" data-text="{{$facworkers[$i]->fac_rate}}">
                                            {{$facworkers[$i]->fac_rate}}</td>
                                        <td class="fac_meal" data-text="{{$facworkers[$i]->fac_meal}}">
                                            {{$facworkers[$i]->fac_meal}}</td>
                                        <td class="fac_monthly" data-text="{{$facworkers[$i]->fac_monthly}}">
                                            {{$facworkers[$i]->fac_monthly}}</td>
                                        <td class="fac_active" data-text="{{$facworkers[$i]->fac_active}}">
                                            {{$facworkers[$i]->fac_active}}</td>

                                        </tr>
                                        @endfor
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">

                        <div class="row">
                            <table id="table_record" class="table mdl-data-table" style="width: 100%" idisplayLength="25">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>
                                                <font color=#000080>#
                                            </b>
                                        </th>
                                        <th>
                                            <b>
                                                <font color=#000080>Fac.WorkerName
                                            </b>
                                        </th>
                                        <th><b>
                                                <font color=#000080>Date
                                            </b></th>
                                        <th><b>
                                                <font color=#000080>Working Hour
                                            </b></th>
                                        
                                    </tr>
                                </thead>

                                <tbody id="table_record-tbody">
                                    @for($i = 0; $i < count($records); $i++) <tr
                                        ondblclick="editRow('{{$records[$i]->report_id}}')"
                                        id="table_record-{{$records[$i]->report_id}}">
                                        <td class='no' data-text="{{$i+1}}">{{$i+1}}
                                        </td>
                                        <td class="report_worker" data-text="{{$records[$i]->fac_id}}"><b>
                                                <font color=#8B008B>{{$records[$i]->fac_workername}}
                                            </b></td>
                                        <td class="report_date" data-text="{{$records[$i]->report_date}}">
                                            {{$records[$i]->report_date}}</td>
                                        <td class="report_hour" data-text="{{$records[$i]->report_hour}}"><b>
                                                <font color=##0000FF>{{$records[$i]->report_hour}}
                                            </b></td>
                                        </tr>
                                        @endfor
                                </tbody>
                            </table>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="margin-top: 20px;">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="row">
                                <select class="form-control" id="sel-year" onchange="get_datas()">
                                    @for($i = date("Y")-50; $i < date("Y")+50; $i++ )
                                        @if($i == date("Y"))
                                            <option selected>{{$i}}</option>
                                        @else
                                            <option >{{$i}}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="row">
                                <select class="form-control" id="sel-month" onchange="get_datas()">
                                    @for($i = 1; $i <= 12; $i++ )
                                        @if($i == date("m"))
                                            @if($i < 10)
                                                <option selected>0{{$i}}</option>
                                            @else
                                                <option selected>{{$i}}</option>
                                            @endif
                                        @else
                                            @if($i < 10)
                                                <option>0{{$i}}</option>
                                            @else
                                                <option>{{$i}}</option>
                                            @endif
                                        @endif
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <select class='form-control' id="sel-date" onchange="get_datas()">
                                <option value="1">1st-15th</option>
                                <option value="2">16st-month end</option>
                                <option value="3">full month</option>
        
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" class="form-control" id="excelfile">
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" onclick="expertExel()">Export Excel</button>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <table class="table" id="table_report">
                            <thead>
                                <tr>
                                    <th>Fac.Worker Name</th>
                                    @for($i = 1; $i <= 31; $i++)
                                        @if($i < 10)
                                            <th>0{{$i}}</th>
                                        @else
                                            <th>{{$i}}</th>
                                        @endif
                                    @endfor
                                    <th>RateHour</th>
                                    <th>Rate/hour</th>
                                    <th>Total</th>
                                    <th>Meal Entitled</th>
                                    <th>Meal</th>
                                    <th>Total Meal</th>
                                    <th>Monthly</th>
                                    <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody id="table_report-tbody">
                                @for($i = 0; $i < count($facworkers); $i ++)
                                    <tr>
                                        <td>{{$facworkers[$i]->fac_workername}}</td>
                                        @for($j = 1; $j <= 31; $j++)
                                            @if($j < 10)
                                                <td id="{{$facworkers[$i]->fac_id}}-0{{$j}}" class="edit cols-{{$j}}"></td>
                                            @else
                                                <td id="{{$facworkers[$i]->fac_id}}-{{$j}}" class="edit cols-{{$j}}"></td>
                                            @endif
                                        @endfor
                                        <td class="fac_rate tot">{{$facworkers[$i]->fac_rate}}</td>
                                        <td  class="total tot"></td>
                                        <td class="fac_total_rate tot"></td>
                                        <td class="meal_entitled"></td>
                                        <td class="fac_meal tot">{{$facworkers[$i]->fac_meal}}</td>
                                        <td class="total_meal tot"></td>
                                        <td class="fac_monthly tot" data-monthly="{{$facworkers[$i]->fac_monthly}}">{{$facworkers[$i]->fac_monthly}}</td>
                                        <td class="grand tot"></td>
                                    </tr>
                                @endfor
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan="33"></td>
                                    <td id="fac_total"></td>
                                    <td id="fac_total_rate"></td>
                                    <td colspan="2"></td>
                                    <td id="total_meal"></td>
                                    <td id="fac_monthly"></td>
                                    <td id="fac_grand"></td>

                                </tr>
                            </tfooter>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label>FAC Worker Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control addfac" id="fac_workername">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <label>FAC RATE</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control addfac" id="fac_rate">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <label>FAC MEAL</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control addfac" id="fac_meal">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <label>FAC MONTHLY</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control addfac" id="fac_monthly">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <label>FAC ACTIVE</label>
                                </div>
                                <div class="col-md-8">
                                   <select id="fac_active" class="form-control addfac">
                                        <option>YES</option>
                                        <option>NO</option>
                                   </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="addWorker()">OK</button>
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>

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
                                    <label>FAC Worker Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control editfac" id="edit-fac_workername">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <label>FAC RATE</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control editfac" id="edit-fac_rate">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <label>FAC MEAL</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control editfac" id="edit-fac_meal">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <label>FAC MONTHLY</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control editfac" id="edit-fac_monthly">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <label>FAC ACTIVE</label>
                                </div>
                                <div class="col-md-8">
                                   <select id="edit-fac_active" class="form-control editfac">
                                        <option>YES</option>
                                        <option>NO</option>
                                   </select>
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

        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label>FAC Worker Name</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control editrecord" id="editrecord-report_worker">
                                        @for($i = 0; $i < count($facworkers); $i++)
                                            <option value="{{$facworkers[$i]->fac_id}}">{{$facworkers[$i]->fac_workername}}</option>
                                        @endfor
                                    </select>
                                    <!-- <input type="text" class="form-control editrecord" id="editrecord-fac_workername"> -->
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <label>Date</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" class="form-control editrecord" id="editrecord-report_date">
                                </div>
                            </div>
                            
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <label>Working Hour</label>
                                </div>
                                <div class="col-md-8">
                                   <input type="number" class="form-control editrecord" id="editrecord-report_hour">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="edit_record('update')">Update</button>
                        <button type="button" class="btn btn-primary" onclick="edit_record('delete')">Delete</button>

                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

             
    </div>
</div>
<script>
$(document).ready(function(){
    $("#table_report").DataTable({
        searching :false,
        "lengthMenu": [[50, 25, 10, -1], [50, 25, 10, "All"]]
    });
    $("#table_facworker").DataTable({
        searching :false,
        "lengthMenu": [[25, 10, 5, -1], [25, 10, 5, "All"]]
    });
    $("#table_record").DataTable({
        searching :false,
        "lengthMenu": [[25, 10, 5, -1], [25, 10, 5, "All"]]
    });
})
function display() {
    $("#exampleModal").modal('show');
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}  

function addWorker() {
    let insertdata = {};
    $(".addfac").filter(function(){
        let id = $(this).attr("id");
        insertdata[id] = $(this).val()
    })
    // insertdata = { worker_name: workername, worker_key: workerId, worker_rate: rate, worker_supervisor: supervisor };
    $.ajax({
        type: 'post',
        url: "{{url('/manpower/insert_facworker')}}",
        data: {
            data: insertdata
        },
        success: function (data) {
            toastFunction();
            let lastnum = 1;
            $(".fac_no").filter(function(){
                lastnum ++;
            })

            const para = document.createElement("tr");
            para.id = "table_facworker"+"-"+data;
            const dblclicktr = document.createAttribute("ondblclick")
            dblclicktr.value = "editworker(id)";
            para.setAttributeNode(dblclicktr);


            const tdpara = document.createElement("td");
            const classattr = document.createAttribute("class")
            classattr.value = "fac_no";
            tdpara.setAttributeNode(classattr);
            tdpara.innerText = lastnum;
            para.appendChild(tdpara)
            for(attr in insertdata)
            {
                const tdpara = document.createElement("td");
                const classattr = document.createAttribute("class")
                classattr.value = attr;
                tdpara.setAttributeNode(classattr);
                tdpara.innerText = insertdata[attr];
                para.appendChild(tdpara)
            }
            let tbl = $("#table_facworker").DataTable();
            console.log(para);
            tbl.row.add(para).draw();
        }
    })
}

function displayworkers() {
    $.ajax({
        type: 'post',
        url: "{{url('/manpower/getfacworkers')}}",
        success: function (data) {
            let workerhtml = "";
            console.log(data);
            $("#table_facworker").DataTable(); 
            for (let i = 0; i < data.length; i++) {
                workerhtml += "<tr ondblclick='editRow(" + data[i]['fac_id'] + ")'>";
                workerhtml += "<td class='fac_no'>"+(i+1)+"</td>"
                workerhtml += "<td class='fac_workername'>" + data[i]['fac_workername'] + "</td>";
                workerhtml += "<td class='fac_rate'>" + data[i]['fac_rate'] + "</td>";
                workerhtml += "<td class='fac_meal'>" + data[i]['fac_meal'] + "</td>";
                workerhtml += "<td class='fac_monthly'>" + data[i]['fac_monthly'] + "</td>";
                workerhtml += "<td class='fac_active'>" + data[i]['fac_active'] + "</td>";

                workerhtml += "</tr>";
            }
            $("#table_facworker-tbody").html(workerhtml);
            
        }
    })
}





let present_Id;
function editworker(fac_id) {
    present_Id = fac_id;
    let result = {};
    $("#table_facworker-" + fac_id + " td").filter(function () {
        let clname = $(this).attr("class").split(" ")[0];
        result[clname] = $(this).data("text");
        $("#edit-" + clname).val($(this).data('text'))
    })
    $("#exampleModal2").modal('show');
}

function edit_project(editType) {
    let editData = {};
    $(".editfac").filter(function(){
        let classname = $(this).attr("id").split("-")[1];
        editData[classname] = $(this).val();
    })
    console.log(editData);
    $.ajax({
        type: 'post',
        url: "{{url('/manpower/editfacworker')}}",
        data: {
            editType: editType,
            present_Id: present_Id,
            editData: editData
        },
        success: function (data) {
            displayfacs();
            toastFunction()
        }
    })
}

function edit_record(editType) {
    let editData = {};
    $(".editrecord").filter(function(){
        let classname = $(this).attr("id").split("-")[1];
        editData[classname] = $(this).val();
    })
    console.log(editData);
    $.ajax({
        type : "post",
        url : "{{url('/manpower/editrecord')}}",
        data : {
            editType : editType,
            record_id : record_id,
            editData : editData
        },
        success : function(data)
        {
            toastFunction();
            console.log(data);
            switch (editType) {
                case "update":
                   $("#table_record-"+record_id+" td").filter(function(){
                        let classname = $(this).attr("class").split(" ")[0];
                        $(this).text(editData[classname]);
                        $(this).attr("data-text",editData[classname]);
                        if (classname == "report_worker") {
                            $(this).text(data[0]);

                        }
                   })
                    break;
                case "delete":
                    $("#table_record-"+record_id).remove()
                default:
                    break;
            }
        }
    })
}
function displayfacs() {
    $.ajax({
        type: "post",
        url: "{{url('/manpower/getfacs')}}",
        data: {

        },
        success: function (data) {
            let workerhtml = "";
            for (let i = 0; i < data.length; i++) {
                workerhtml += "<tr ondblclick='editworker(" + data[i]['fac_id'] + ")'>";
                workerhtml += "<td class='fac_no'>"+(i+1)+"</td>";
                workerhtml += "<td class='fac_workername' data-text='"+data[i]['fac_workername']+"'>" + data[i]['fac_workername'] + "</td>";
                workerhtml += "<td class='fac_rate' data-text='"+data[i]['fac_rate']+"'>" + data[i]['fac_rate'] + "</td>";
                workerhtml += "<td class='fac_meal' data-text='"+data[i]['fac_meal']+"'>" + data[i]['fac_meal'] + "</td>";
                workerhtml += "<td class='fac_monthly' data-text='"+data[i]['fac_monthly']+"'>" + data[i]['fac_monthly'] + "</td>";
                workerhtml += "<td class='fac_active' data-text='"+data[i]['fac_active']+"'>" + data[i]['fac_active'] + "</td>";
                workerhtml += "</tr>";
            }
            $("#table_facworker-tbody").html(workerhtml);
            // editRow()
        }   
    })
}

let record_id ;
function editRow(id) {
    let result = {};
    record_id = id;
    $("#table_record-"+id + " td").filter(function(){
        let clname = $(this).attr("class").split(" ")[0];
        console.log(clname);
        result[clname] = $(this).data("text");
        $("#editrecord-" + clname).val($(this).data('text'))
    })
    $("#exampleModal3").modal('show');

}

// 
let reports_txt =  `<?php echo json_encode($reports)?>`;
let reports = JSON.parse(reports_txt);
displayreport(1);
function displayreport(type) {
    let Tdate = $("#sel-year").val()+"-"+$("#sel-month").val();
    switch (type*1) {
        case 1:
            for (let i = 0; i < reports.length; i++) {
                Tdate = $("#sel-year").val()+"-"+$("#sel-month").val();

                let worker_id = reports[i]['fac_id'];
                let lLdate = reports[i]['report_date'].split("-")[2]
                let date = lLdate * 1;
                let report_hour = reports[i]['report_hour'];
                if (date <= 15) {
                    $("#"+worker_id+"-"+lLdate).text(report_hour);
                }                    
            }
            break;
        case 2:
            for (let i = 0; i < reports.length; i++) {
                Tdate = $("#sel-year").val()+"-"+$("#sel-month").val();
                let worker_id = reports[i]['fac_id'];
                let lLdate = reports[i]['report_date'].split("-")[2]
                let date = lLdate * 1;
                let report_hour = reports[i]['report_hour'];
                Tdate += "-15";
                if (date > 15) {
                    $("#"+worker_id+"-"+lLdate).text(report_hour);
                }                    
            }
            break;
        case 3:
            for (let i = 0; i < reports.length; i++) {
                let worker_id = reports[i]['fac_id'];
                let date = reports[i]['report_date'].split("-")[2];
                let report_hour = reports[i]['report_hour'];
                $("#"+worker_id+"-"+date).text(report_hour);         
            }
            break;
    }
    calc_total();
    getSunday()
}

function get_datas() {
    $.ajax({
        type : 'post',
        url : "{{url('/manpower/get_reports')}}",
        data : {
            year : $("#sel-year").val(),
            month : $("#sel-month").val(),
        },
        success : function(data){
            $(".edit").text('');
            reports = data[0];
            let days = data[1];
            let workers = data[2];
            let htmltxt = "";

            let type = $("#sel-date").val();
            displayreport(type);
        }
    })
}

function calc_total() {
    let fac_total = 0;
    let total_meal = 0;
    let fac_monthly = 0;
    let grand = 0;
    let fac_total_rate = 0;
    $("#table_report-tbody tr").filter(function(){
        let total = 0;
        let entitled = 0;
        $(this).children(".edit").filter(function(){
            let val =  $(this).text() * 1;
            total += val;
            if (val >= 16) {
                entitled ++;
            }
        })
        if ($()) {
            
        }
        if ($("#sel-date").val() != 3) {
            $(this).children(".fac_monthly").text($(this).children(".fac_monthly").data("monthly")/ 2)
        }else{
            $(this).children(".fac_monthly").text($(this).children(".fac_monthly").data("monthly"))

        }
        let meal = $(this).children(".fac_meal").text() * 1;
        $(this).children(".fac_total_rate").text(total * $(this).children(".fac_rate").text())
        $(this).children(".meal_entitled").text(entitled);
        $(this).children(".total").text(total);
        $(this).children(".total_meal").text(entitled * meal);
        let grandtotal = total * $(this).children(".fac_rate").text() + entitled * meal + $(this).children(".fac_monthly").text() * 1;
        $(this).children(".grand").text(grandtotal);

        fac_total_rate += total * $(this).children(".fac_rate").text(); 
        fac_total += total;
        total_meal += entitled * meal;
        fac_monthly += $(this).children(".fac_monthly").text() * 1;
        grand += grandtotal;
    })
    $("#fac_total_rate").text(numberWithCommas(fac_total_rate.toFixed(2)) )
    $("#fac_total").text(numberWithCommas(fac_total.toFixed(2)) );
    $("#total_meal").text(numberWithCommas(total_meal.toFixed(2)));
    $("#fac_monthly").text(numberWithCommas(fac_monthly.toFixed(2)));
    $("#fac_grand").text(numberWithCommas(grand.toFixed(2)));

    $(".tot").filter(function(){
        $(this).text(numberWithCommas(($(this).text()*1).toFixed(2)))
        
    })
}

function getSunday() {
    for (let i = 0; i <= 31; i++) {
        $(".cols-"+i).css("background-color","");
        
    }
    let year = $("#sel-year").val() * 1;
    let month = $("#sel-month").val() * 1 - 1;
    for(let i=1;i<=31;i++){    //looping through days in month
        let newDate = new Date(year,month,i)
        if(newDate.getDay()==0){   //if Sunday
            $(".cols-"+i).css("background-color","red");
        }

    }
}

function expertExel() {
    var wb = XLSX.utils.table_to_book(document.getElementById('table_report'),{sheet: "Sheet name"})

    var wbout = XLSX.write(wb, {bookType: 'xlsx', bookSST: true, type: 'binary'});

    function s2ab(s) {
      var buf = new ArrayBuffer(s.length);
      var view = new Uint8Array(buf);
      for (var i = 0; i < s.length; i++) {
        view[i] = s.charCodeAt(i) & 0xFF;
      }
      return buf;
    }

    saveAs(new Blob([s2ab(wbout)], {type:"application/octet-stream"}), 'test.xlsx');
    // $.ajax({
    //     type : "post",
    //     url : "{{url('/project/createexcel')}}",
    //     data : {
    //         table_data : $("#table_report").html()
    //     },
    //     success : function(data){
    //         console.log(data);
    //     }
    // })
}
</script>
@endsection