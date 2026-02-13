@extends('admin.layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Page Information</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.page.update',$pages->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="title">Page Title *</label>
                    <input type="text" id="title" name="title" value="{{$pages->title}}" required placeholder="Enter page title">
                </div>

                <div class="form-group">
                    <label for="heading">Page Heading</label>
                    <input type="text" id="heading" name="heading" value="{{$pages->heading}}" placeholder="Enter page heading">
                </div>
            </div>


            <div class="form-group">
                <label for="url_key">URL Key *</label>
                <input type="text" id="url_key" name="url_key" value="{{$pages->url_key}}" required placeholder="e.g., about-us, contact">
                <small style="color: #7f8c8d;">This will be used in the URL (e.g., /about-us)</small>
            </div>



            <div class="form-group">
                <label for="description">Description *</label>
                <textarea id="description" name="description" class="html-editor">
                {{ $pages->description }}
                </textarea>

                </input>
            </div>





            <div class="d-flex gap-1" style="margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">Create Page</button>
                <button type="submit" name="save_draft" class="btn btn-secondary">Save</button>
                <a href="{{route('admin.page.index')}}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>


</div>
</main>








@endsection