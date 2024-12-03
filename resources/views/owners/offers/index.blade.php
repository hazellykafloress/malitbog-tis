@extends('layouts/layoutWithScript')

@section('title', 'Establishment Offers')

@section('content')
    @include('owners.offers._partials.create')

    <div class="bg-white shadow p-3 p-md-5 rounded-3">
        <livewire:table-refresher tableName='OwnerOfferingTable'>
            <livewire:owner-offer-table />
        </livewire:table-refresher>
    </div>
@endsection

@section('jsScripts')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script async>
        $(document).ready(function() {
            $('.select_mode').select2()
            $('#description').summernote({
                height: 200
            })
        });
    </script>
@endsection
