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
                <div class="row" style="margin-top:10px">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <label>P.code</label>
                        </div>
                        <div class="col-md-9 col-sm-6">
                            <select class="form-control" id="p_code" onchange="get_name()">
                                <!-- <option></option> -->
                                @for($i = 0; $i < count($Projects); $i++)
                                    <option value="{{$Projects[$i]['p_code']}}">{{$Projects[$i]['p_code']}}-{{$Projects[$i]['p_name']}}</option>
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
    <div class="row" style="margin-top:10px">
        <div class="card">
            <div class="card-body">
                <div class="row">
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

    <div class="row justify-content-center" style="margin-top: 20px">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <table class="table mdl-data-table" id="table_hours" style="width: 100%">
                        <thead>
                            <tr id="table_man_power-0">
                                <th class="p_code-header">P.Code</th>
                                <th class="p_name-header">P.Name</th>
                                <th class="company_name-header">CompanyName</th>
                                <th class="man_date-header">Date</th>
                                <th class="worker_name-header">Worker Name</th>
                                <th class="worker_key-header">Worker ID</th>
                                <th class="man_hours-header">Hours</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($Man_power); $i++)
                                <tr id="table_man_power-{{$Man_power[$i]->man_id}}" ondblclick="editRow(id)">
                                    <td class="p_code" data-text="{{$Man_power[$i]->p_code}}">{{$Man_power[$i]->p_code}}</td>
                                    <td class="p_name" data-text="{{$Man_power[$i]->p_name}}">{{$Man_power[$i]->p_name}}</td>
                                    <td class="company_name" data-text="{{$Man_power[$i]->company_name}}">{{$Man_power[$i]->company_name}}</td>
                                    <td class="man_date" data-text="{{$Man_power[$i]->man_date}}">{{$Man_power[$i]->man_date}}</td>
                                    <td class="worker_name" data-text="{{$Man_power[$i]->worker_name}}">{{$Man_power[$i]->worker_name}}</td>
                                    <td class="worker_key" data-text="{{$Man_power[$i]->worker_id}}">{{$Man_power[$i]->worker_key}}</td>
                                    <td class="man_hours" data-text="{{$Man_power[$i]->man_hours}}">{{$Man_power[$i]->man_hours}}</td>


                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
    
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid" id="modal-content">

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="update_btn" onclick="edit_project('update')">Update</button>
          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>

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

    let summary_id = -1 ; 
    let present_table = '';
    let selects = {
            'company_value' : [1,2,3,4,5,6,7,8],
            'p_status':['active','work Done',"aborted","fully paid"],
            'p_type':['Main cone','Sub-con'],
            'p_work':['Steel Trusses','Steel Trusses & Roofing','Fbarication Only','Fbarication & Install','Others'],
            'p_ic':['WYF','WKL','WkM','CMH','Other'],
            'include_materials':['YES','NO'],
            'include_roofing' : ["YES","NO"],
            'p_award':['Letter of Award','Approved Quotation','Purchase Order','Verbally','None'],
            'f_completion' : ['0%','10%','20%','30%','40%','50%','60%','70%','80%','90%','100%'],
            'p_completion' : ['0%','10%','20%','30%','40%','50%','60%','70%','80%','90%','100%'],
            'sub_description' : ['Purchasing Materials','Crane','Lorry','Referer Fee','Painting','Wages','Others']
        }
    $(document).ready(function(){
        $("#table_hours").DataTable({
            searching :false,
            "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
        }).order([3,'desc']).draw();
        $("#table_projectsummary").DataTable();
    })

    let present_Id;
    function editRow(id) {
        
        let disableEdit = [];
        let deleteEdit = ['progress_total','total_work_done','amount_due_to_claim','p_name','company_name',"worker_name"];
        present_table = id.split("-")[0];
        present_Id = id.split("-")[1];
        let edit_status = $("#"+id);
        let contenthtml = "";
        // $("#"+id).toggleClass("edit_status");

        //make p_code select
        
        
        $("#"+id+" td").filter(function(){
            //show create,update,delte button show
           console.log($(this).data('text'));
            let columnClass = $(this).attr('class').split(" ")[0];

            if ($("."+columnClass+"-header").html().search("upload") == -1) {
                contenthtml += "<div class='row' style = 'margin-top:10px'>";
                contenthtml += "<div class='col-md-6'>"
                contenthtml += "<label>";
                contenthtml += $("."+columnClass+"-header").html();
                contenthtml += "</label>"
                contenthtml += "</div>"
                
                contenthtml += "<div class='col-md-6'>"
                if (selects[columnClass] !== null && selects[columnClass] !== undefined) {
                    contenthtml += "<select class='form-control edit_set' id='edit-"+columnClass+"'>";
                        console.log(columnClass);
                    for (let k = 0; k < selects[columnClass].length; k++) {
                        if (selects[columnClass][k] == $(this).data('text')) {
                            contenthtml += "<option selected>"+selects[columnClass][k]+"</option>"
                        }else{
                            contenthtml += "<option>"+selects[columnClass][k]+"</option>"
                        }
                    }
                    contenthtml += "</select>";

                }else if(columnClass == "p_code"){
                    let p_codes = [];
                    $("#table_projectsummary-tbody .p_code").filter(function(){
                        p_codes[$(this).text()] = 0;
                    })
                    let select_p_codes = "<select class='form-control edit_set' id= 'edit-p_code'>";
                    for(p_code in p_codes)
                    {
                        if (p_code == $(this).data('text')) {
                            select_p_codes += "<option selected>"+p_code+"</option>";  
                        }else{
                            select_p_codes += "<option>"+p_code+"</option>";
                        }
                    }
                    select_p_codes += "</select>";
                    contenthtml += select_p_codes;
                }else if(columnClass == "worker_key"){
                    let select_worker_codes = "<select class='form-control edit_set' id= 'edit-worker_key'>"
                    for (let k = 0; k < workers.length; k++) {
                        if (workers[k]['worker_id'] == $(this).data('text')) {
                            select_worker_codes += "<option selected value='"+workers[k]['worker_id']+"'>"+workers[k]['worker_name']+"</option>";  
                        }else{
                            select_worker_codes += "<option value='"+workers[k]['worker_id']+"'>"+workers[k]['worker_name']+"</option>";
                        }
                    }
                    select_worker_codes += "</select>";
                    contenthtml += select_worker_codes;
                }
                else{
                    let inputtype = 'text';
                    if (columnClass.search("date") != -1) {
                        inputtype = 'date'
                    }
                    console.log($(this).data('text'));
                    contenthtml += "<input type='"+inputtype+"' class='form-control edit_set' id='edit-"+columnClass+"' value='"+$(this).data('text')+"'>";

                    
                }
                contenthtml += "</div>"
                contenthtml += "</div>";
            };
            

        })
        $("#modal-content").html(contenthtml);
        $("#exampleModal").modal('show');
        //disable edit column
        for (let i = 0; i < disableEdit.length; i++) {
            $("#edit-"+disableEdit[i]).attr('disabled','');            
        }
        for (let i = 0; i < deleteEdit.length; i++) {
            $("#edit-"+deleteEdit[i]).parent().parent().remove()
        }
    }
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

    function edit_project(editType) {
        let editData = {};
        let p_code = $("#edit-p_code").val();
        let date = $("#edit-man_date").val();
        let worker_id = $("#edit-worker_key").val();
        let man_hours = $("#edit-man_hours").val();
        let p_name = $("#edit-p_name").val();
        let company_name = $("#edit-companu_name").val();
        editData['man_date'] = date;
        editData['man_workerid'] = worker_id;
        editData['man_hours'] = man_hours;
        editData['p_code'] = p_code;
        console.log(editData);
        $.ajax({
            type: 'post',
            url: "{{url('/manpower/edit')}}",
            data: {
                editType: editType,
                present_Id: present_Id,
                editData: editData
            },
            success: function (data) {
                // displaymans();  
                $("#"+present_table+"-"+present_Id+" td").filter(function(){
                let columnClass = $(this).attr('class').split(" ")[0];
                $(this).text(editData[columnClass]);
                $(this).attr("data-text",editData[columnClass])
                // $(this).data('text') = result[columnClass]
            })
            console.log("update"); 
                toastFunction()
            }
        })
    }
</script>
@endsection