@extends('layouts.app')

@section('content')
<style>
    table td,th{
        font-size : 10px!important;
        padding : 5px 5px 5px 5px !important;
        height : auto!important;
    }
</style>
<div class='container'>
    <div class="row justify-content-center" style="margin-top: 20px;">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
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
                    <div class="col-sm-4">
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
                    <div class="col-sm-4">
                        <select class='form-control' id="sel-date" onchange="get_datas()">
                            <option value="1">1st-15th</option>
                            <option value="2">16st-month end</option>
                            <option value="3">full month</option>
    
                        </select>
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
                                <th>Total Working Hour</th>
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
                                    <td class="total"></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#table_report").DataTable();
        $(".dataTables_filter").hide()
    })

    let reports_txt =  `<?php echo json_encode($reports)?>`;
    let reports = JSON.parse(reports_txt);
    console.log(reports);
    display(1)
    function display(type) {
        let Tdate = $("#sel-year").val()+"-"+$("#sel-month").val();
        switch (type*1) {
            case 1:
                for (let i = 0; i < reports.length; i++) {
                    Tdate = $("#sel-year").val()+"-"+$("#sel-month").val();

                    let worker_id = reports[i]['fac_id'];
                    let lLdate = reports[i]['report_date'].split("-")[2]
                    let date = lLdate * 1;
                    let report_hour = reports[i]['report_hour'];
                    console.log(worker_id,date);
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
                display(type);
            }
        })
    }

    function calc_total() {
        $("#table_report-tbody tr").filter(function(){
            let total = 0;
            $(this).children(".edit").filter(function(){
                total += $(this).text() * 1;
            })
            $(this).children(".total").text(total);
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

</script>
@endsection