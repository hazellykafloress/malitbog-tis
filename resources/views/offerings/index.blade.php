@extends('layouts/contentNavbarLayout')

@section('title', 'Establishment Offerings List')

@section('content')
    {{-- <div class="d-flex justify-content-end">
        <a href="{{ route('offerings.create') }}" class="btn btn-primary rounded my-2 py-2 d-flex gap-2">
            <i class="bx bx-store"></i>
            Add
        </a>
    </div> --}}
    <div class="bg-white shadow p-3 p-md-5 rounded-3">
        <livewire:table-refresher tableName='EstablishmentOfferingTable'>
            <livewire:establishment-offering-table />
        </livewire:table-refresher>
    </div>
    @livewireStyles
    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Livewire !== 'undefined') {
                Livewire.on('confirmDeleteOffering', (rowId) => {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action cannot be undone!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        customClass: {
                            title: 'alert-title',
                            icon: 'alert-icon',
                            confirmButton: 'alert-confirmButton',
                            cancelButton: 'alert-cancelButton',
                            container: 'alert-container',
                            popup: 'alert-popup'
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.dispatch('deleteOffering', rowId);
                        }
                    });
                });

                Livewire.on('offeringDeleted', () => {
                    Swal.fire({
                        title: "Success",
                        text: "Offering has been deleted!",
                        icon: "success",
                        customClass: {
                            title: 'alert-title',
                            icon: 'alert-icon',
                            confirmButton: 'alert-confirmButton',
                            cancelButton: 'alert-cancelButton',
                            container: 'alert-container',
                            popup: 'alert-popup'
                        },
                    });
                });

                Livewire.on('offeringNotDeleted', () => {
                    Swal.fire({
                        title: "Error",
                        text: "Something went wrong deleting the offering!",
                        icon: "error",
                        customClass: {
                            title: 'alert-title',
                            icon: 'alert-icon',
                            confirmButton: 'alert-confirmButton',
                            cancelButton: 'alert-cancelButton',
                            container: 'alert-container',
                            popup: 'alert-popup'
                        },
                    });
                });
            } else {
                console.log('Livewire is not loaded.');
            }
        });
    </script>
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success',
                text: "Offering has been added!",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                customClass: {
                    title: 'alert-title',
                    icon: 'alert-icon',
                    confirmButton: 'alert-confirmButton',
                    cancelButton: 'alert-cancelButton',
                    container: 'alert-container',
                    popup: 'alert-popup'
                },
            }).then(() => {
                @php
                    session()->forget('success');
                @endphp
            });
        });
    </script>
    @endif

    @if(session('update'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success',
                text: "Offering has been updated!",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                customClass: {
                    title: 'alert-title',
                    icon: 'alert-icon',
                    confirmButton: 'alert-confirmButton',
                    cancelButton: 'alert-cancelButton',
                    container: 'alert-container',
                    popup: 'alert-popup'
                },
            }).then(() => {
                @php
                    session()->forget('update');
                @endphp
            });
        });
    </script>
    @endif
@endsection
