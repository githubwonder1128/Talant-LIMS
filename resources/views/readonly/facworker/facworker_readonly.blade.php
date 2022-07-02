@extends('layouts.app')

@section('content')
<style>
table td{
    font-size : 10px!important;
    padding : 5px 5px 5px 5px !important;
    height : auto!important;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class='col-md-3'>
                        <select class="form-control" id="sel-hour" onchange="sethour()">
                            @for($i = 1; $i < 4; $i++) 
                                <option>{{$i*8}}</option>
                            @endfor
                        </select>
                    </div>
                    
                </div>
                <div class="row">
                    <table class='table table-striped'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fac.Worker.Name</th>
                                <th>Date</th>
                                <th>Working Hour</th>
                            </tr>
                        </thead>
                        <tbody id="table-facworker-tbody">
                            @for($i = 0; $i < count($facworkers); $i++)
                                <tr data-worker="{{$facworkers[$i]->fac_id}}">
                                    <td>{{$i+1}}</td>
                                    <td>{{$facworkers[$i]->fac_workername}}</td>
                                    <td><input  type="date" value="{{date('Y-m-d')}}" class="form-control"></td>
                                    <td><input type="number" value="8"  class="form-control edit-hour"></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <button class="btn btn-primary" onclick="saveData()">Save</button>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script>
    $(document).ready(function(){
        $("#table-saverecord").DataTable()
    })

    function sethour() {
        let hour = $("#sel-hour").val();
        $(".edit-hour").val(hour)
    }

    function saveData() {
        let totalData = [];
        $("#table-facworker-tbody tr").filter(function(){
            let report_worker = $(this).data("worker");
            let report_date = $(this).children("td:nth-child(3)").children("input").val();
            let report_hour = $(this).children("td:nth-child(4)").children('input').val();
            totalData.push({report_worker : report_worker,report_date : report_date,report_hour : report_hour});
        })
        console.log(totalData);
        $.ajax({
            type : "post",
            url : "{{url('/manpower/savereport')}}",
            data : {
                saveData : totalData
            },
            success : function(data)
            {
                toastFunction();
            }
        })
    }
</script>
@endsection