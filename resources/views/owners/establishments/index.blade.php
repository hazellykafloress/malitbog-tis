@extends('layouts/layoutWithScript')

@section('title', 'My Establishment')

@section('content')
    <div class="row">
        <div class="col-xl">
            <form method="POST" action="{{ route('owners.establishment-update') }}" enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-primary d-flex gap-1">
                        <i class="bx bx-plus"></i>
                        Save
                    </button>
                </div>
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Establishment Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-6">
                            <label class="form-label" for="establishment_name">Name <small
                                    class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="establishment_name" name="establishment_name"
                                placeholder="Starbucks" value="{{ old('establishment_name') }}" />
                            @error('establishment_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control"
                                value="{{ old('image') }}" accept="image/*">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="establishment_description">Description <small
                                    class="text-danger">*</small></label>
                            <textarea id="establishment_description" class="form-control" name="establishment_description"
                                placeholder="Short Information About the establishmment">{{ old('establishment_description') }}</textarea>
                            @error('establishment_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="establishment_address">Address <small
                                    class="text-danger">*</small></label>
                            <textarea id="establishment_address" class="form-control" name="establishment_address"
                                placeholder="Malitbog, Southern Leyte">{{ old('establishment_address') }}</textarea>
                            @error('establishment_address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="establishment_geolocation_longitude">Geolocation
                                Longitude</label>
                            <input type="text" class="form-control" id="establishment_geolocation_longitude"
                                name="establishment_geolocation_longitude" placeholder="125.00094211920187"
                                value="{{ old('establishment_geolocation_longitude') }}" />
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="establishment_geolocation_latitude">Geolocation
                                Latitude</label>
                            <input type="text" class="form-control" id="establishment_geolocation_latitude"
                                name="establishment_geolocation_latitude" placeholder="10.158163827849396"
                                value="{{ old('establishment_geolocation_latitude') }}" />
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="establishment_contact_number">Contact Number <small
                                    class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="establishment_contact_number"
                                name="establishment_contact_number" placeholder="+6391234567890"
                                value="{{ old('establishment_contact_number') }}" />
                            @error('establishment_contact_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="establishment_mode_of_access">Mode Of Access <small
                                    class="text-danger">*</small></label>
                            <select class="select_mode form-select" name="establishment_mode_of_access[]"
                                multiple="multiple">
                                <option value="Car Access" @if (in_array('Car Access', old('establishment_mode_of_access') ?? [])) selected @endif>Car Access
                                </option>
                                <option value="Foot Access" @if (in_array('Foot Access', old('establishment_mode_of_access') ?? [])) selected @endif>Foot Access
                                </option>
                            </select>
                            <div class="form-text"> Hold ctrl key or command to select multiple items </div>
                            @error('establishment_mode_of_access')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="establishment_type_of_business">Type of Business <small
                                    class="text-danger">*</small></label>
                            <select class="select_mode form-select" name="establishment_type_of_business">
                                <option value="" disabled selected>Select one</option>
                                @foreach ($businessTypes as $businessType)
                                    <option value="{{ $businessType->id }}"
                                        @if ($businessType->id == old('establishment_type_of_business')) selected @endif>{{ $businessType->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('establishment_type_of_business')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
            <div class="bg-white shadow p-3 p-md-5 rounded-3">
                <livewire:table-refresher tableName='OwnerEstablismentList'>
                    <livewire:owner-establishment-table />
                </livewire:table-refresher>
            </div>
        </div>
    </div>
    @livewireStyles
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .alert-container {
        z-index: 8888;
        }
        .alert-popup {
        font-size: 1rem;
        padding-left: 2rem;
        padding-right: 2rem;
        background-color: #fff;
        z-index: 9999 !important; /* Set the z-index to a very high value */
        }

        .alert-confirmButton, .alert-cancelButton{
        padding: 0.3rem 1.5rem;
        font-size: 1rem;
        border-radius: 0.5rem;
        outline: none;
        border: none;
        }

        .alert-confirmButton:focus {
        outline: none;
        border: none;
        }

        .alert-title {
        padding: 0;
        font-size: 1.5rem;
        }
        .alert-icon {
        font-size: 0.7rem;
        }
        .alert-input {
        min-height: calc(1.5em + (0.5rem + 2px));
        padding: 0.25rem 0.25rem;
        font-size: 0.75rem;
        border-radius: 0.2rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Livewire !== 'undefined') {
                Livewire.on('confirmDeleteEstablishment', (rowId) => {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'The establishment will be set to inactive. You can just set it to active anytime!',
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
                            Livewire.dispatch('deleteEstablishment', rowId);
                        }
                    });
                });

                Livewire.on('establishmentDeleted', () => {
                    Swal.fire({
                        title: "Success",
                        text: "Establishment has been deleted!",
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

                Livewire.on('establishmentNotDeleted', () => {
                    Swal.fire({
                        title: "Error",
                        text: "Something went wrong deleting the establishment!",
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

                Livewire.on('establishmentNotAllowedDeleted', () => {
                    Swal.fire({
                        title: "Error",
                        text: "You must have at least one establishment!",
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
                 text: "Establishment has been added!",
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
 
     @if(session('error'))
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             Swal.fire({
                 title: 'Error',
                 text: "Something went wrong!",
                 icon: 'error',
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
                     session()->forget('error');
                 @endphp
             });
         });
     </script>
     @endif
@endsection

@section('jsScripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('.select_mode').select2();
        });
    </script>
@endsection
