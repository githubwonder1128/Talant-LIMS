@extends('layouts.app')

@section('content')
<style>
    .row{
        margin-top : 10px
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <select class="form-control editfac" id="p_code">
                        @for($i = 0; $i < count($projects); $i++)
                            <option value="{{$projects[$i]->p_code}}">{{$projects[$i]->p_code}}-{{$projects[$i]->p_name}}</option>
                        @endfor
                    </select>
                </div>
                <div class="row">
                    <input type="date" class="form-control editfac" value="{{date('Y-m-d')}}" id="material_recorddate">
                </div>
                <div class="row">
                    <select class="form-control editfac" id="material_recordtype">
                        @for($i = 0; $i < count($material); $i++)
                            <option value="{{$material[$i]->mat_id}}">{{$material[$i]->mat_type}}</option>
                        @endfor
                    </select>
                </div>
                <div class="row">
                    <input type="text" class="form-control editfac" id="material_recordnote" placeholder="Note">
                </div>
                <div class="row">
                    <input type="text" class="form-control editfac" id="material_recordquantity" placeholder="Quantity">
                </div>
                <div class="row">
                    <button class="btn btn-primary" onclick="save()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function save() {
        let total = {};
        $(".editfac").filter(function(){
            let id = $(this).attr("id");
            total[id] = $(this).val()
        })
        console.log(total);
        $.ajax({
            type : "post",
            url : "{{url('/manpower/savematerialrecord')}}",
            data : {
                total : total
            },
            success : function(data){
                toastFunction();
            }
        })
    }
</script>
@endsection