@extends('layouts/contentNavbarLayout')

@section('title', 'Galleries')

@section('content')
<div>
    <div class="d-flex flex-column justify-content-center mb-3">
        <form action="{{ url('/my-galleries') }}" method="POST" enctype="multipart/form-data">
            {{-- <form method="POST" action="{{ route('accounts.store') }}"> --}}
            @csrf
            <div class="d-flex flex-column justify-content-center mb-3">
                <div class="mb-6">
                    <label class="form-label" for="establishment_name">Establishment <small
                            class="text-danger">*</small></label>
                    <select class="select_mode form-select" name="establishment_name">
                        <option value="" disabled selected>Select one</option>
                        @foreach ($establishmentselect as $establishment)
                            <option value="{{ $establishment->id }}" @if ($establishment->id == old('establishment_name')) selected @endif>
                                {{ $establishment->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('establishment_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="form-label" for="name">Name <small class="text-danger">*</small></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Free Food" value="{{ old('name') }}" />
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="form-label" for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button type="submit" class="btn btn-primary d-flex gap-1">
                        <i class="bx bx-plus"></i> Upload
                    </button>
                </div>
            </div>
        </form>
    </div>

    <livewire:table-refresher tableName='OwnerGalleryTable'>
        <livewire:owner-gallery-table />
    </livewire:table-refresher>
    @livewireStyles
    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Livewire !== 'undefined') {
                Livewire.on('confirmDeleteGallery', (rowId) => {
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
                            Livewire.dispatch('deleteOwnerGallery', rowId);
                        }
                    });
                });

                Livewire.on('galleryDeleted', () => {
                    Swal.fire({
                        title: "Success",
                        text: "Gallery has been deleted!",
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

                Livewire.on('galleryNotDeleted', () => {
                    Swal.fire({
                        title: "Error",
                        text: "Something went wrong deleting the gallery!",
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
                text: "Gallery has been added!",
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
                text: "Account and its establishment has been updated!",
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
</div>
@endsection
