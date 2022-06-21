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
                                <option></option>
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
                <div class="row" style="margin-top : 10px">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <label>F.completion</label>
                        </div>
                        <div class="col-md-9 col-sm-6">
                            <select class="form-control" id="f_completion">
                                @for($i = 0; $i < 11; $i++)
                                    <option>{{10*$i}}%</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="row"  style="margin-bottom:10px;text-align:center">
                <div class="row" style="margin-top:10px;text-align:center">
                    <button class="btn btn-primary"  onclick="save()">Save</button>   
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-top: 20px;">
        <div class="card">
            <div class="card-body">
                <table id="table_projectsummary" class="mdl-data-table" style="width:100%">
                    <thead>
                        <tr id="table_projectsummary-0">
                            <th class="p_code-header">P.Code</th>
                            <th class="p_date-header">Date</th>
                            <th class="p_name-header">P.Name</th>
                            <th class="company_name-header">CompanyName</th>
                            <th class="p_work-header">P.Work</th>
                            <th class="p_ic-header">PIC</th>
                            <th class="include_materials-header">Include Materials</th>
                            <th class="p_award-header">P.Award</th>
                            <th class="f_completion-header">F.completion</th>
                        </tr>
                    </thead>
                    <tbody id="table_projectsummary-tbody">
                        @for($i = 0; $i < count ($Projects); $i ++)
                        <tr id="table_projectsummary-{{$Projects[$i]['p_id']}}" ondblclick="editRow(id)">
                            <td class="p_code" data-text="{{$Projects[$i]['p_code']}}">{{$Projects[$i]['p_code']}}</td>
                            <td class="p_date" data-text="{{$Projects[$i]['p_date']}}">{{$Projects[$i]['p_date']}}</td>
                            <td class="p_name" data-text="{{$Projects[$i]['p_name']}}">{{$Projects[$i]['p_name']}}</td>
                            <td class="company_name" data-text="{{$Projects[$i]['company_name']}}">{{$Projects[$i]['company_name']}}</td>
                            <td class="p_work" data-text="{{$Projects[$i]['p_work']}}">{{$Projects[$i]['p_work']}}</td>
                            <td class="p_ic" data-text="{{$Projects[$i]['p_ic']}}">{{$Projects[$i]['p_ic']}}</td>
                            <td class="include_materials" data-text="{{$Projects[$i]['include_materials']}}">{{$Projects[$i]['include_materials']}}</td>
                            <td class="p_award" data-text="{{$Projects[$i]['p_award']}}">{{$Projects[$i]['p_award']}}</td>
                            <td class="f_completion" data-text="{{$Projects[$i]['f_completion']}}">{{$Projects[$i]['f_completion']}}</td>
                
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    let projects = `<?php echo json_encode($Projects)?>`;
    let workers = `<?php echo json_encode($Workers)?>`;
    let total = JSON.parse(projects);
    console.log(total);
    function get_name() {
        let chage_sel = $("#p_code").val();
        for (let i = 0; i < total.length; i++) {
            if (total[i]['p_code'] == chage_sel) {
                $("#p_name").val(total[i]['p_name']);
                $("#company_name").val(total[i]['company_name']);
                $("#f_completion").val(total[i]['f_completion'])
            }
            
        }
        // getvisor()
    }

    function save() {
        let p_code = $("#p_code").val();
        let f_completion = $("#f_completion").val();
        let f_date = $("#man_date").val();
        $.ajax({
            type : "post",
            url : "{{url('/manpower/savefcompletion')}}",
            data : {
                p_code : p_code,
                f_completion : f_completion,
                f_date : f_date
            },
            success : function(data){
                toastFunction();
            }
        })
    }
</script>
@endsection