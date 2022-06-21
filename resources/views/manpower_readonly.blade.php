@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="row" style="margin-top:10px">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <label>P.code</label>
                        </div>
                        <div class="col-md-9 col-sm-6">
                            <select class="form-control" id="p_code" onchange="get_name()">
                                <!-- <option></option> -->
                                @for($i = 0; $i < count($Projects); $i++)
                                    <option>{{$Projects[$i]['p_code']}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                                <label>P.Name</label>
                        </div>
                        <div class="col-md-9 col-sm-6">
                            <input class="form-control" id="p_name">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                                <label>Company Name</label>
                        </div>
                        <div class="col-md-9 col-sm-6">
                            <input class="form-control" id="company_name">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                                <label>Date</label>
                            </div>
                        <div class="col-md-9 col-sm-6" >
                            <input type="date" class="form-control" id="man_date" value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <label>Worker Name</label>
                        </div>
                        <div class="col-md-9 col-sm-6" >
                            <select class="form-control" id="worker_name" onchange="getvisor()">
                                @for($i = 0; $i < count($Workers); $i++)
                                <option value="{{$Workers[$i]->worker_id}}">{{$Workers[$i]->worker_name}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <label>Hours</label>
                        </div>
                        <div class="col-md-9 col-sm-6" >
                            <input type="number" class='form-control' id="work_rate">
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top:10px" id="supervisor">
                    <!-- <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <label>Hours</label>
                        </div>
                        <div class="col-md-9 col-sm-6" >
                            <input type="number" class='form-control' id="work_rate">
                        </div>
                    </div> -->
                </div>
                
                
            </div>
            <div class="row"  style="margin-bottom:10px;text-align:center">
                <div class="row" style="margin-top:10px;text-align:center">
                    <button class="btn btn-primary"  onclick="save()">Save</button>   
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center" style="margin-top: 20px">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <table class="table mdl-data-table" id="table_hours" style="width: 100%">
                        <thead>
                            <tr>
                                <th>P.Code</th>
                                <th>P.Name</th>
                                <th>CompanyName</th>
                                <th>Date</th>
                                <th>Worker Name</th>
                                <th>Worker ID</th>
                                <th>Hours</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($Man_power); $i++)
                                <tr>
                                    <td>{{$Man_power[$i]->p_code}}</td>
                                    <td>{{$Man_power[$i]->p_name}}</td>
                                    <td>{{$Man_power[$i]->company_name}}</td>
                                    <td>{{$Man_power[$i]->man_date}}</td>
                                    <td>{{$Man_power[$i]->worker_name}}</td>
                                    <td>{{$Man_power[$i]->worker_key}}</td>
                                    <td>{{$Man_power[$i]->man_hours}}</td>


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
    let projects = `<?php echo json_encode($Projects)?>`;
    let workers = `<?php echo json_encode($Workers)?>`;
    let total = JSON.parse(projects);
    workers = JSON.parse(workers);
    let flag_supervisor = 0;
    $(document).ready(function(){
        $("#table_hours").DataTable().order([3,'desc']).draw()
    })
    function getvisor() {
        let worker_id = $("#worker_name").val();
        let p_code = $("#p_code").val();
        $.ajax({
            type : "post",
            url : "{{url('/manpower/getvisor')}}",
            data : {
                p_code : p_code,
                worker_id : worker_id
            },
            success : function(data){
                console.log(data);
                let supervisor = data['supervisor'][0];
                flag_supervisor = supervisor;
                let p_completion = data['p_completion'][0];
                if (supervisor == 1) {
                    let superhtml = "";
                    superhtml += "<div class='row'>"
                    superhtml += "<div class='col-md-3 col-sm-6'>";
                    superhtml += "<label>Last Work Of This Project Completion %</label>"
                    superhtml += "</div>";
                    superhtml += "<div class='col-md-9 col-sm-6'>";
                    superhtml += "<select class='form-control' id='p_completion'>";
                    for (let i = 0; i <= 10; i++) {
                        if (i*10+"%" == p_completion) {
                            superhtml += "<option selected>"+(i*10)+"%</optioin>";
                            
                        }else{
                            superhtml += "<option>"+(i*10)+"%</optioin>";
                        }
                    }
                    superhtml += "</select>";
                    superhtml += "</div>";
                    superhtml += "</div>";
                    $("#supervisor").html(superhtml)
                }else{
                    $("#supervisor").html("")
                }
                

            }
        })
    }
    function get_name() {
        let chage_sel = $("#p_code").val();
        for (let i = 0; i < total.length; i++) {
            if (total[i]['p_code'] == chage_sel) {
                $("#p_name").val(total[i]['p_name']);
                $("#company_name").val(total[i]['company_name']);
                
            }
            
        }
        getvisor()
    }

    function save(){
        let p_code = $("#p_code").val();
        let worker_date = $("#man_date").val();
        let worker_name = $("#worker_name").val();
        let hours = $("#work_rate").val();
        let p_completion = $("#p_completion").val();
        let result = {man_date : worker_date,man_workerid : worker_name,man_hours : hours,p_code : p_code};
        console.log(result);
        $.ajax({
            type : 'post',
            url : "{{url('/manpower/save_man')}}",
            data : {
                insert_data : result,
                p_code : p_code,
                p_completion : p_completion,
                flag_supervisor : flag_supervisor
            },
            success : function(data){
                toastFunction()
            }
        })
    }
</script>
@endsection