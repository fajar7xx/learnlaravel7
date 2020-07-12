<div class="form-group">
    <label for="thumbnail">Thumbnail</label>
    <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
</div>
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $post->title }}">
    @error('title')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="category">Category</label>
    <select name="category" id="category" class="form-control">
            <option disabled selected>Choose One!</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected':'' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ old('body') ?? $post->body }}</textarea>
    @error('body')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="tags">Tags</label>
    <select name="tags[]" id="tags" class="form-control tags" multiple>
        {{-- <option disabled selected>Choose one!</option> --}}
        @foreach ($post->tags as $tag)
            <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
        @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>
    @error('tags')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
    @enderror
</div>
<button class="btn btn-primary">{{ $submit ?? 'Update' }} Post</button>

@section('css')
    <link  rel="stylesheet" href="/select2/dist/css/select2.min.css">
@endsection

@push('scripts')
    <script src="/select2/dist/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tags').select2({
                placeholder: "Chose tags"
            });
        });
    </script>
@endpush