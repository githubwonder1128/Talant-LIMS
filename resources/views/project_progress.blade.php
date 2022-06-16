@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-body">
                    <table id="table_projectsummary" class="mdl-data-table" style="width:100%">
                        <thead>
                            <tr id="table_projectsummary-0">
                                <th class="p_code-header">P.Code</th>
                                <th class="p_name-header">P.Name</th>
                                <th class="company_name-header">CompanyName</th>
                                <th class="p_status-header">P.status</th>
                                <th class="p_work-header">P.Work</th>
                                <th class="include_materials-header">Include Materials</th>
                                <th class="include_roofing-header">Include Roofing</th>
                                <th class="p_completion-header">P.completion</th>
                                <th class="p_date_update-header">Date Update</th>
                                <th class="p_date_delay-header">Days delay</th>

                                <th class="f_completion-header">F.completion</th>
                                <th class="f_date_update-header">Date Update</th>
                                <th class="f_date_delay-header">Days delay</th>
                            </tr>
                        </thead>
                        <tbody id="table_projectsummary-tbody"> 
                            @for($i = 0; $i < count ($Projects); $i ++)
                            <tr id="table_projectsummary-{{$Projects[$i]['p_id']}}" ondblclick="editRow(id)">
                                <td class="p_code" data-text="{{$Projects[$i]['p_code']}}">{{$Projects[$i]['p_code']}}</td>
                                <td class="p_name" data-text="{{$Projects[$i]['p_name']}}">{{$Projects[$i]['p_name']}}</td>
                                <td class="company_name" data-text="{{$Projects[$i]['company_name']}}">{{$Projects[$i]['company_name']}}</td>
                                <td class="p_status" data-text="{{$Projects[$i]['p_status']}}">{{$Projects[$i]['p_status']}}</td>
                                <td class="p_work" data-text="{{$Projects[$i]['p_work']}}">{{$Projects[$i]['p_work']}}</td>
                                <td class="include_materials" data-text="{{$Projects[$i]['include_materials']}}">{{$Projects[$i]['include_materials']}}</td>
                                <td class="include_roofing" data-text="{{$Projects[$i]['include_roofing']}}">{{$Projects[$i]['include_roofing']}}</td>
                                <td class="p_completion" data-text="{{$Projects[$i]['p_completion']}}">{{$Projects[$i]['p_completion']}}</td>
                                <td class="p_completion_date" data-text="{{$Projects[$i]['p_completion_date']}}">{{$Projects[$i]['p_completion_date']}}</td>
                                <td class="p_completion_delay">{{date_diff(date_create(date("Y-m-d")),date_create($Projects[$i]['p_completion_date']))->format("%a")  }}</td>
                               
                                <td class="f_completion" data-text="{{$Projects[$i]['f_completion']}}">{{$Projects[$i]['f_completion']}}</td>
                                <td class="f_completion_date" data-text="{{$Projects[$i]['f_completion_date']}}">{{$Projects[$i]['f_completion_date']}}</td>
                                <td class="p_completion_delay">{{date_diff(date_create(date("Y-m-d")),date_create($Projects[$i]['f_completion_date']))->format("%a")  }}</td>
                    
                            </tr>
                            @endfor
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
<script>
</script>


@endsection