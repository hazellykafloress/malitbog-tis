<div>
    @forelse ($reviews as $review)
        <div class="text-white  mb-2 rounded">
            <div class="bg-primary d-flex p-2 rounded">
                <div class="d-flex flex-column">
                    {{ $review->name }}
                    <span class="text-warning d-flex"><i class="bx bx-star text-warning"></i>{{ $review->rate }}</span>
                </div>
                <small class="ms-auto">{{ $review->created_at->format('Y-m-d') }}</small>
            </div>
            <div class="p-2">
                <p class="overflow-auto font-italic text-primary">
                    {{ $review->description }}
                </p>
            </div>
        </div>
    @empty
        No Comments
    @endforelse

    <div class="card shadow rounded p-1 mt-3">
        <div class="card-body d-flex flex-column gap-3">
            <div class="d-flex flex-column">
                <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                    wire:model='name'>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex flex-column">
                <input type="number" name="rate" id="rate" class="form-control" placeholder="Rate"
                    wire:model='rate'>
                @error('rate')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex flex-column">
                <textarea name="description" class="form-control" id="description" cols="30" rows="10"
                    wire:model='description'></textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary" wire:click="saveReview">Save</button>
        </div>
    </div>
</div>
