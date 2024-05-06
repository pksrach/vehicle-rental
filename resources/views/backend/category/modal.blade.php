<div class="modal" id="disabledAnimation" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('backend.categories.create') }}" method="post" autocomplete="off"
              enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{--Attachment--}}
                    <div class="mb-3">
                        <label for="attachment" class="form-label">Attachment</label>
                        <input class="form-control form-control-md" name="attachment" id="attachment" type="file"
                               accept="image/*" onchange="previewImg(event)">
                        @error('attachment')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--Preview Image--}}
                    <div style="text-align: center;">
                        <img src="" alt="" id="img1" width="300">
                    </div>

                    {{--ID hidding--}}
                    <input type="hidden" name="id" id="id">
                    {{--Name--}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ old('name', request()->input('name')) }}">
                        @error('name')
                        <div class="text-sm text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--Description--}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </div>
                {{--Button--}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="submitButton" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
