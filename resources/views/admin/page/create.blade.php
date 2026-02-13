@extends('admin.layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Page Information</h3>
    </div>
    <div class="card-body">
        <form action="{{route('admin.page.store')}}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="title">Page Title *</label>
                    <input type="text" id="title" name="title" required placeholder="Enter page title">
                </div>

                <div class="form-group">
                    <label for="heading">Page Heading</label>
                    <input type="text" id="heading" name="heading" placeholder="Enter page heading">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="url_key">URL Key *</label>
                    <input type="text" id="url_key" name="url_key" required placeholder="e.g., about-us, contact">
                    <small style="color: #7f8c8d;">This will be used in the URL (e.g., /about-us)</small>
                </div>


            </div>

            <div class="form-group">
                <label for="description">Page Content *</label>
                <textarea id="description" name="description" class="html-editor">
                                        <p>Enter your page content here...</p>
                                    </textarea>
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