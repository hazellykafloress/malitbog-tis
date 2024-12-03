@extends('layouts/contentNavbarLayout')

@section('title', 'Headline News List')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('news.create') }}" class="btn btn-primary rounded my-2 py-2 d-flex gap-3">
            <i class="bx bx-news"></i>
            Add
        </a>
    </div>
    <div class="bg-white shadow rounded p-4">
        <livewire:news-table />
    </div>
    @livewireStyles
    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Livewire !== 'undefined') {
                Livewire.on('confirmDeleteNews', (rowId) => {
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
                            Livewire.dispatch('deleteNews', rowId);
                        }
                    });
                });

                Livewire.on('newsDeleted', () => {
                    Swal.fire({
                        title: "Success",
                        text: "News has been deleted!",
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

                Livewire.on('eventNotDeleted', () => {
                    Swal.fire({
                        title: "Error",
                        text: "Something went wrong deleting the news!",
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
                text: "News has been added!",
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
                text: "News has been updated!",
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
