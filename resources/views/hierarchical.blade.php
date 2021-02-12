@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
<style>
    .hierarchical{
        margin-left: 30px;
        margin-top: 20px;
        background: #000;
        color:#fff;
        width: 100%;
        align-content: center;
    }
    ul{
        margin-left: 20px;
        list-style: none;
    }
    ul>ol{
        list-style: none;
    }
</style>
@include('layouts.headers.cards')
<div class="container-">
    <div class="row">
        <div class="hierarchical">
            <h1 class="text-center">HierarchicalOrder</h1>
            <div class="nation">
                <h1>NationalHospital</h1>
                <ol->
                    <li>Director</li>
                    <li>Staff Members</li>
                </li->
            </div>
            <div class="nation">
                <h1>RegionalHospital</h1>
                <ol->
                    <li>Superintendent</li>
                    <li>Senior Officers</li>
                </ol->
            </div>
        
            <div class="nation">
                <h1>GeneralHospital</h1>
                <ol->
                    <li>Head</li>
                    <li>Officers</li>
                </ol->
            </div>
        </div>
    </div>
</div>

    
@endsection