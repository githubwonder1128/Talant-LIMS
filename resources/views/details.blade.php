@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="row">
            <div class="card">
                
            </div>
        </div>
        <div class = "row" style="margin-top:20px">
            <div class="card">
                <div class="card-body col-md-12">
                    <!-- <h5 class="card-title">Project Summary</h5> -->
                    <div class="row">
                        <table id="table_projectsummary" class="mdl-data-table" style="width:100%">
                            <thead>
                                <tr id="table_projectsummary-0">
                                    <th class="p_code-header">P.Code</th>
                                    <th class="p_date-header">Date</th>
                                    <th class="p_name-header">P.Name</th>
                                    <th class="company_name-header">Client</th>
                                    <th class="p_status-header">P.status</th>
                                    <th class="p_type-header">P.Type</th>
                                    <th class="p_work-header">P.Work</th>
                                    <th class="p_ic-header">PIC</th>
                                    <th class="include_materials-header">Materials</th>
                                    <th class="include_roofing-header">Roofing</th>
                                    <th class="date_startWork-header">Date Start Work</th>
                                    <th class="date_completion-header">Date Completion</th>
                                    <th class="p_award-header">P.Award</th>
                                    <th class="f_completion-header">Fab%</th>
                                    <th class="p_completion-header">Site%</th>
                                    <!-- <th class="balance_collectible_value">Bal.Collectible</th> -->
                                </tr>
                            </thead>
                            <tbody id="table_projectsummary-tbody"> 
                                @for($i = 0; $i < count ($Projects); $i ++)
                                <tr id="table_projectsummary-{{$Projects[$i]->p_id}}" ondblclick="editRow(id)">
                                    <td class="p_code" data-text="{{$Projects[$i]->p_code}}">{{$Projects[$i]->p_code}}</td>
                                    <td class="p_date" data-text="{{$Projects[$i]->p_date}}">{{$Projects[$i]->p_date}}</td>
                                    <td class="p_name" data-text="{{$Projects[$i]->p_name}}">{{$Projects[$i]->p_name}}</td>
                                    <td class="company_name" data-text="{{$Projects[$i]->company_name}}">{{$Projects[$i]->company_name}}</td>
                                    <td class="p_status" data-text="{{$Projects[$i]->p_status}}">{{$Projects[$i]->p_status}}</td>
                                    <td class="p_type" data-text="{{$Projects[$i]->p_type}}">{{$Projects[$i]->p_type}}</td>
                                    <td class="p_work" data-text="{{$Projects[$i]->p_work}}">{{$Projects[$i]->p_work}}</td>
                                    <td class="p_ic" data-text="{{$Projects[$i]->p_ic}}">{{$Projects[$i]->p_ic}}</td>
                                    <td class="include_materials" data-text="{{$Projects[$i]->include_materials}}">{{$Projects[$i]->include_materials}}</td>
                                    <td class="include_roofing" data-text="{{$Projects[$i]->include_roofing}}">{{$Projects[$i]->include_roofing}}</td>
                                    
                                    <td class="date_startWork" data-text="{{$Projects[$i]->date_startWork}}">{{$Projects[$i]->date_startWork}}</td>
                                    <td class="date_completion" data-text="{{$Projects[$i]->date_completion}}">{{$Projects[$i]->date_completion}}</td>
                                    <td class="p_award" data-text="{{$Projects[$i]->p_award}}">{{$Projects[$i]->p_award}}</td>
                                    <td class="f_completion" data-text="{{$Projects[$i]->f_completion}}">{{$Projects[$i]->f_completion}}</td>
                                    <td class="p_completion" data-text="{{$Projects[$i]->p_completion}}">{{$Projects[$i]->p_completion}}</td>
                                    
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            
        </div>
    
        <div class="row" style="margin-top: 20px;">
            <div class="card">
                <div class="card-body">
                    <!-- Tabs navs -->
                    <ul class="nav nav-tabs mb-3" id="ex-with-icons" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="ex-with-icons-tab-1" data-mdb-toggle="tab" href="#table_approved_project_value" role="tab"
                            aria-controls="ex-with-icons-tabs-1" aria-selected="true"><i class="fas fa-chart-pie fa-fw me-2"></i>Approved P.Value</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex-with-icons-tab-2" data-mdb-toggle="tab" href="#table_approved_vo_value" role="tab"
                            aria-controls="ex-with-icons-tabs-2" aria-selected="false"><i class="fas fa-chart-line fa-fw me-2"></i>Approved V.O Value</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#table_progress_claims" role="tab"
                            aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i class="fas fa-cogs fa-fw me-2"></i>Progress Claims</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#table_payment_certificate" role="tab"
                            aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i class="fas fa-cogs fa-fw me-2"></i>Payment Certificate</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#table_invoice_billed" role="tab"
                            aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i class="fas fa-cogs fa-fw me-2"></i>Invoice Billed</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#table_sub_con_claims" role="tab"
                            aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i class="fas fa-cogs fa-fw me-2"></i>Sub Con</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#table_cidb_levy" role="tab"
                            aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i class="fas fa-cogs fa-fw me-2"></i>CIDB Levy</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#table_car_insurance" role="tab"
                            aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i class="fas fa-cogs fa-fw me-2"></i>Car Insurance</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#table_remarks" role="tab"
                            aria-controls="ex-with-icons-tabs-3" aria-selected="false"><i class="fas fa-cogs fa-fw me-2"></i>Remarks</a>
                        </li>
                    </ul>
                    <!-- Tabs navs -->
                    
                    <!-- Tabs content -->
                    <div class="tab-content" id="ex-with-icons-content">
                        <div class="tab-pane fade show active" id="table_approved_project_value" role="tabpanel" aria-labelledby="ex-with-icons-tab-1">
                        Tab 1 content
                        </div>
                        <div class="tab-pane fade" id="table_approved_vo_value" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
                        Tab 2 content
                        </div>
                        <div class="tab-pane fade" id="table_progress_claims" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
                        Tab 3 content
                        </div>
                        <div class="tab-pane fade" id="table_payment_certificate" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
                        Tab 4 content
                        </div>
                        <div class="tab-pane fade" id="table_invoice_billed" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
                        Tab 5 content
                        </div>
                        <div class="tab-pane fade" id="table_sub_con_claims" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
                        Tab 6 content
                        </div>
                        <div class="tab-pane fade" id="table_cidb_levy" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
                        Tab 7 content
                        </div>
                        <div class="tab-pane fade" id="table_car_insurance" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
                        Tab 8 content
                        </div>
                        <div class="tab-pane fade" id="table_remarks" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
                        Tab 9 content
                        </div>
                    </div>
                    <!-- Tabs content -->
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
          <button type="button" class="btn btn-primary" id="insert_clr" onclick="display()">Clear</button>
          <button type="button" class="btn btn-primary" id="insert_btn" onclick="edit_project('insert')" disabled>Insert</button>
          <button type="button" class="btn btn-primary" id="update_btn" onclick="edit_project('update')">Update</button>
          <button type="button" class="btn btn-primary" id="delete_btn" onclick="edit_project('delete')">Delete</button>
          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
  
<script>

    $(document).ready(function () {
        // new Datatable($("#tbl_prjects"), data, {})
        $('#table_projectsummary')
            .DataTable({
                autoWidth: false,
                columnDefs: [
                    {
                        targets: ['_all'],
                        className: 'mdc-data-table__cell',
                    },
                ]
                
            })
            .order([0,'desc'])
            .draw();
        // backgroundColor();
    })

    function backgroundColor() {
        $("#table_projectsummary-tbody tr td").filter(function(){
            switch ($(this).data('text')) {
                case 'active':
                    $(this).parent().css('background-color',"#00bfff")
                    break;
                case 'complete':
                    $(this).parent().css('background-color',"#808080")
                    break;
                case 'aborted':
                    $(this).parent().css('background-color',"#dc143c")
                    break;
            }
        })
    }

    function numberWithCommas(x) {
       return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }    

    function commasWithnumber(x) {
        let a = x;
        a=a.replace(/\,/g,''); // 1125, but a string, so convert it to number
        a=parseInt(a,10);
        return a;
    }

    let headers = {
        'table_approved_project_value':['p_code','approved_date','approved_options','approved_amount','uploadbtn','approved_uploadurl'],
        'table_approved_vo_value':['p_code',"vo_date","vo_options","vo_amount","uploadbtn","vo_uploadurl"],
        'table_progress_claims':['p_code',"progress_date","progress_no","progress_Ref","progress_contract_value","progress_vo_value","progress_total","progress_gross_work_done","progress_vo_done","total_work_done","progress_less_retention","progress_less_payment","amount_due_to_claim","uploadbtn","progress_uploadurl"],
        'table_payment_certificate':['p_code','payment_date','payment_certificate','payment_amount',"uploadbtn",'payment_uploadurl'],
        'table_invoice_billed':['p_code','invoice_date','invoice_no','invoice_amount','uploadbtn_invoice','invoice_uploadurl','invoice_payment_date','invoice_folio','invoice_payment_made','uploadbtn_invoice_payment','invoice_payment_uploadurl'],
        'table_sub_con_claims':['p_code','sub_con_date','sub_con_invoice_no','sub_description','sub_con_amount',"uploadbtn",'sub_con_uploadurl'],
        'table_cidb_levy':['p_code','cidb_date','cidb_invoice_no','cidb_amount',"uploadbtn",'cidb_uploadurl'],
        'table_car_insurance' : ['p_code','insurance_date','insurance_policy_no','insurance_date_due','insurance_amount',"uploadbtn",'insurance_uploadurl'],
        'table_remarks':['p_code','remark_content']
    };
    let identify = {
        'table_approved_project_value':'approved_id',
        'table_approved_vo_value':"vo_id",
        'table_progress_claims':"progress_id",
        'table_payment_certificate':"payment_id",
        'table_sub_con_claims':"sub_con_id",
        'table_cidb_levy':"cidb_id",
        'table_car_insurance' : "insurance_id",
        'table_remarks':"remark_id",
        'table_invoice_billed' : 'invoice_id'
    }

    trClickEvent();
    function trClickEvent() {
        $("tbody tr").click(function(){
            let rowId = $(this).attr("id").split("-")[1];
            $("tr").css("background-color","")
            $(this).css("background-color","green")
            get_detail(rowId);
        })
    }
    

    function get_all_datas() {
        $.ajax({
            type : 'post',
            url : "{{url('/projects/get_all_datas')}}",
            data : {
                present_table : present_table
            },
            success : function(data)
            {
                console.log(data);
            }
        })
    }
        
    function get_detail(pId) {
        $.ajax({
            type : "post",
            url : "{{url('/projects/get_detail')}}",
            data : {
                p_id : pId
            },
            success : function(data){
                
                for(table_name in data)
                { 
                    let htmstr = "<div class='table-responsive'><table class = 'table align-middle mb-0 bg-white' >";
                    let contextId = "#"+table_name;
                    //create header
                    htmstr += "<thead>";
                    htmstr += "<tr id='"+table_name+"-0"+"'>";
                    for (let i = 0; i < headers[table_name].length; i++) {
                        htmstr += "<th class='"+headers[table_name][i]+"-header"+"'>"+headers[table_name][i]+"</th>";
                    }
                    htmstr += "</tr>";

                    //body
                    htmstr += "<tbody id='"+table_name+"-tbody"+"'>";
                    for (let index = 0; index < data[table_name].length; index++) 
                    {
                        htmstr += "<tr id='"+table_name+"-"+data[table_name][index][identify[table_name]]+"' ondblclick='editRow(id)'>";
                        for (let attr = 0; attr < headers[table_name].length; attr++) {
                            if (headers[table_name][attr].search("uploadbtn") == 0) {
                                htmstr += "<td class='"+headers[table_name][attr]+"' aria-orientation='vertical'>";
                                htmstr += "<input type='file' class='form-control form-control-sm' id='file_"+table_name+"-"+headers[table_name][attr]+"-"+data[table_name][index][identify[table_name]]+"' />";
                                htmstr += '<button class="form-control " onClick = "uploadfile(\''+table_name+"-"+headers[table_name][attr]+"-"+data[table_name][index][identify[table_name]] +'\')"><i class="fa fa-upload"></i></button>';
                                htmstr += "</td>";
                            }
                            else if(headers[table_name][attr].search("upload") > 0){
                                htmstr += "<td class='"+headers[table_name][attr]+"'><a href='{{asset('files')}}/"+data[table_name][index][headers[table_name][attr]]+"'>"+data[table_name][index][headers[table_name][attr]]+"</a></td>";
                            }else{
                                htmstr += "<td class='"+headers[table_name][attr]+"' data-text='"+data[table_name][index][headers[table_name][attr]]+"'>"+data[table_name][index][headers[table_name][attr]] +"</td>";
                            }
                            
                        }
                    }
                    htmstr += "</tbody>";
                    htmstr += "<tfoot>";
                    htmstr += "<tr>"
                    htmstr += "<td colspan='"+headers[table_name].length+"' id='"+table_name+"-tfoot"+"'></td>";
                    htmstr += "</tr>"
                    htmstr += "</tfoot>";
                    htmstr += "</table></div>";
                    $(contextId).html(htmstr)
                }
                theadClickEvent();
                // backgroundColor()
                calctotal();
            }
        })
    }
    function calctotal() {
        let totals_attr = {
            "table_approved_project_value" : ['approved_amount'],
            "table_approved_vo_value" : ['vo_amount'],
            "table_payment_certificate" : ['payment_amount'],
            "table_invoice_billed" : ['invoice_amount','invoice_payment_made'],
            'table_sub_con_claims' : ['sub_con_amount'],
            'table_cidb_levy':['cidb_amount'],
            'table_car_insurance':['insurance_amount'],
        };
        let total = {};
        for(tablename in totals_attr){
            total[tablename] = [];
            for (let i = 0; i < totals_attr[tablename].length; i++) {
                let amount = totals_attr[tablename][i];
                if ( total[tablename][amount] == null) {
                    total[tablename][amount] = 0;
                }
                $("."+amount).filter(function(){
                    total[tablename][amount] += ($(this).text() * 1);
                })
            }
        }
        for(tablename in total)
        {
            let footerhtm = "";
            for(attr in total[tablename])
            {
                footerhtm += "<label>";
                footerhtm += "Total "+attr + ":"
                footerhtm += numberWithCommas(total[tablename][attr].toFixed(2)) ;
                footerhtm += "</label>";
            }
            $("#"+tablename+"-tfoot").html(footerhtm)
        }


        //progress_claims
        let progress_total = {total_work_done : 0,retention : 0,amount_due_to_claim : 0};
        $(".progress_total").filter(function(){
            let progress_contract_value = $(this).parent().find(".progress_contract_value").text() * 1;
            let progress_vo_value = $(this).parent().find(".progress_vo_value").text() * 1;
            $(this).text(progress_contract_value + progress_vo_value)
        })
        $(".total_work_done").filter(function(){
            let progress_gross_work_done = $(this).parent().find(".progress_gross_work_done").text() * 1;
            let progress_vo_done = $(this).parent().find(".progress_vo_done").text() * 1;
            progress_total['total_work_done'] += progress_gross_work_done + progress_vo_done;
            $(this).text(progress_gross_work_done + progress_vo_done)
        })
        let retention = 0;
        let amount_due_to_claim = 0;
        $(".amount_due_to_claim").filter(function(){
            let progress_gross_work_done = $(this).parent().find(".progress_gross_work_done").text() * 1;
            let progress_vo_done = $(this).parent().find(".progress_vo_done").text() * 1;

            let progress_less_retention = $(this).parent().find(".progress_less_retention").text() * 1;
            let progress_less_payment = $(this).parent().find(".progress_less_payment").text() * 1;
            progress_total['retention'] += progress_less_retention;
            progress_total['amount_due_to_claim'] += progress_gross_work_done + progress_vo_done - progress_less_retention - progress_less_payment;
            $(this).text(progress_gross_work_done + progress_vo_done - progress_less_retention - progress_less_payment)
        })
        
        let  footerhtm = "";
        for(attr in progress_total)
        {
            footerhtm += "<label>";
            footerhtm += "Total "+attr + ":"
            footerhtm += numberWithCommas(progress_total[attr].toFixed(2)) ;
            footerhtm += "</label>";
        }
        $("#table_progress_claims-tfoot").html(footerhtm)

        $("table tr td").filter(function(){
            if($(this).html() * 1 > 0){
                $(this).html(numberWithCommas($(this).text()))
            }
        })
    }

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
    
    function editRow(id) {
        
        let disableEdit = [];
        let deleteEdit = ['progress_total','total_work_done','amount_due_to_claim'];
        present_table = id.split("-")[0];
        summary_id = id.split("-")[1];
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

    theadClickEvent()
    function theadClickEvent() {
        let deleteEdit = ['progress_total','total_work_done','amount_due_to_claim'];
        
        $("thead tr").on("dblclick",function(){
            let Id = $(this).attr('id');
            let rowId = $(this).attr("id").split("-")[0];
            let contenthtml = "";
            present_table = Id.split("-")[0];
            let select_p_codes = ''
            if (present_table != "table_projectsummary") {
                console.log(3);
                let p_codes = [];
                $("#table_projectsummary-tbody .p_code").filter(function(){
                    p_codes[$(this).text()] = 0;
                })
                select_p_codes = "<select class='form-control edit_set' id= 'edit-p_code'>";
                for(p_code in p_codes)
                {
                    select_p_codes += "<option>"+p_code+"</option>";
                }
                select_p_codes += "</select>";
            }
        $("#"+Id+" th").filter(function(){
                
                let columnClass = $(this).attr('class').split(" ")[0].split("-")[0];
                if ($("."+columnClass+"-header").html().search("upload") == -1){
                    contenthtml += "<div class='row' style = 'margin-top:10px'>";
                    contenthtml += "<div class='col-md-6'>"
                    contenthtml += "<label>";
                    contenthtml += $(this).text();
                    contenthtml += "</label>"
                    contenthtml += "</div>"

                    contenthtml += "<div class='col-md-6'>"
                    if (selects[columnClass] !== null && selects[columnClass] !== undefined) {
                        contenthtml += "<select class='form-control edit_set' id='edit-"+columnClass+"'>";
                        for (let k = 0; k < selects[columnClass].length; k++) {
                            if (selects[columnClass][k] == $(this).text()) {
                                contenthtml += "<option selected>"+selects[columnClass][k]+"</option>"
                            }else{
                                contenthtml += "<option>"+selects[columnClass][k]+"</option>"
                            }
                        }
                        contenthtml += "</select>";

                    }else if(present_table != 'table_projectsummary' && columnClass == "p_code"){
                        console.log(select_p_codes);
                        contenthtml += select_p_codes;
                    }
                    else{
                        let inputtype = 'text';
                        if (columnClass.search("date") != -1) {
                            inputtype = 'date'
                        }
                        contenthtml += "<input type='"+inputtype+"' class='form-control edit_set' id='edit-"+columnClass+"' value='"+$(this).text()+"'>";

                        
                    }
                    contenthtml += "</div>"
                    contenthtml += "</div>";
                }
                
        })
            $("#modal-content").html(contenthtml);
            $("#exampleModal").modal('show');
            display();
            for (let i = 0; i < deleteEdit.length; i++) {
                $("#edit-"+deleteEdit[i]).parent().parent().remove()
            }
        })
    }
    

    function edit_project(edittype) {
        let result = {};
        let notedit = ['progress_total','total_work_done','amount_due_to_claim'];
        $(".edit_set").filter(function(){
            let attr = $(this).attr("id").split("-")[1];
            if ($(this).val() == undefined || $(this).val() == null || $(this).val() == '') {
                $("#toast").show()
                return;
            }
            if (notedit.indexOf(attr) == -1) {
                result[attr] = $(this).val() 
            }
        })

        $.ajax({
            type : 'post',
            url : "{{url('/projects/edit')}}",
            data : {
                present_table : present_table,
                summary_id : summary_id,
                editType : edittype,
                data : result,
            },
            success : function(data)
            {

                switch (edittype) {
                    case "insert":
                        // let appendhtml  = "<tr id = '"+present_table+"-"+data+"'>";
                        const para = document.createElement("tr");
                        para.id = present_table+"-"+data;
                        const dblclicktr = document.createAttribute("ondblclick")
                        dblclicktr.value = "editRow(id)";
                        para.setAttributeNode(dblclicktr);
                        for(attr in result)
                        {
                            console.log(attr);
                            const tdpara = document.createElement("td");
                            const classattr = document.createAttribute("class")
                            classattr.value = attr;
                            tdpara.setAttributeNode(classattr);
                            tdpara.innerText = result[attr];
                            para.appendChild(tdpara)
                            // appendhtml += "<td class='"+attr+"'>"+result[attr]+"</td>";
                        }
                        if (present_table == "table_projectsummary") {
                            console.log(para);
                            let tbl = $("#"+present_table).DataTable();
                            tbl.row.add(para).draw();
                            trClickEvent();
                            
                        }else{
                            let appendhtml = "<tr id = '"+present_table+"-"+data+"' ondblclick='editRow(id)'>";
                            for(let attr = 0; attr < headers[present_table].length; attr++ ){
                                if (headers[present_table][attr].search("uploadbtn") == 0) {
                                    appendhtml += "<td class='"+headers[present_table][attr]+"' aria-orientation='vertical'>";
                                    appendhtml += "<input type='file' class='form-control form-control-sm' id='file_"+present_table+"-"+headers[present_table][attr]+"-"+data+"' />";
                                    appendhtml += '<button class="form-control " onClick = "uploadfile(\''+present_table+"-"+headers[present_table][attr]+"-"+data +'\')"><i class="fa fa-upload"></i></button>';
                                    appendhtml += "</td>";
                                }else {
                                    appendhtml += "<td class='"+headers[present_table][attr]+"' data-text='"+result[headers[present_table][attr]]+"'>"+result[headers[present_table][attr]]+"</td>";
                                }
                            }
                            appendhtml += "</tr>"
                            $("#"+present_table+"-tbody").append(appendhtml)
                        }
                        calctotal();
                        break;
                    case 'update':
                        
                        $("#"+present_table+"-"+summary_id+" td").filter(function(){
                            let columnClass = $(this).attr('class').split(" ")[0];
                            $(this).text(result[columnClass]);
                            $(this).attr("data-text",result[columnClass])
                            // $(this).data('text') = result[columnClass]
                        })
                        console.log("update");
                        break;
                    case 'delete':
                        let deltr = $("#"+present_table+"-"+summary_id);
                        if(present_table == 'table_projectsummary'){
                            let deltbl = $("#"+present_table).DataTable();
                            deltbl.row(deltr).remove().draw()
                        }else{
                           $("#"+present_table+"-"+summary_id).remove()
                        }
                        break;
                }
                toastFunction();
                calctotal();
                // backgroundColor()
            }
            
        })
    }

    function display() {
        let disableEdit = ['p_code','company_value'];
        $("#insert_btn").removeAttr("disabled");
        for (let i = 0; i < disableEdit.length; i++) {
            $("#edit-"+disableEdit[i]).removeAttr('disabled');             
        }
        // $("#update_btn").attr("disabled","");
        // $("#delete_btn").attr("disabled","");

        $(".edit_set").val('');
    }


    function uploadfile(tmp) {
        let file_data = $('#file_'+tmp).prop('files')[0];
        let form_data = new FormData();                  
        form_data.append('file', file_data);
        form_data.append("option",tmp);                            
        $.ajax({
            url: "{{url('/projects/upload')}}", // <-- point to server-side PHP script 
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(filename){
                toastFunction();
                let imgsrc = "<a href='{{asset('files/')}}"+filename+"'>";
                imgsrc += filename;
                imgsrc += "</a>";
                $("."+tmp).html(imgsrc)
            }
        });
    }

    
</script>
@endsection
