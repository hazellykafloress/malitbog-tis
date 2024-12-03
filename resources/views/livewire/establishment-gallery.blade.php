<div>
    {{-- <div class="d-flex flex-column justify-content-center mb-3">
        <div class="mb-6">
            <label class="form-label" for="name">Name <small class="text-danger">*</small></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Free Food"
                wire:model="name" value="{{ old('name') }}" />
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-6">
            <label class="form-label" for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*"
                wire:model="image">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="d-grid gap-2 d-md-block">
            <button wire:click="save" type="submit" class="btn btn-primary d-flex gap-1">
                <i class="bx bx-plus"></i>
                Upload
            </button>
        </div>
    </div> --}}

    <livewire:table-refresher tableName='EstablishmentGalleryTable'>
        <livewire:establishment-gallery-table :establishment=$establishment />
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
                            Livewire.dispatch('deleteGallery', rowId);
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
                text: "Account and its establishment has been added!",
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
