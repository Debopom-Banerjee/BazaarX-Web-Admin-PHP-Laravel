<!-- initiate head with meta tags, css and script -->
@include('backend.include.head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    @import url('https://cdn-uicons.flaticon.com/uicons-bold-straight/css/uicons-bold-straight.css');
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap');

    .controller a {
        font-size: 20px;
        cursor: pointer;
        text-decoration: none;

    }

</style>




@section('meta_data')
	@php
		$meta_title = 'User Attachment'.' | '.getSetting('app_name');
		$meta_description = 'User Attachment' ?? getSetting('seo_meta_description');
		$meta_keywords = '-'.'' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');
		$meta_abstract = '' ?? getSetting('site_motto');
		$meta_author_name = '' ?? 'Defenzelite';
		$meta_author_email = '' ?? 'support@defenzelite.com';
		$meta_reply_to = '' ?? getSetting('frontend_footer_email');
		$meta_img = ' ';
	@endphp
@endsection
<div class="container" style="min-height: 100vh">
	@if($check)
		<ul class="list-group mt-2">

			@forelse ($attachments as $index => $item)
				<li class="list-group-item p-3 mb-2">
					<div class="row p-1">
						<div class="col-10">
							<h6 class="m-0 p-0"> {{$item->file_name}}</h6>

							<small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</small>
						</div>
						<div class="col-2 controller  p-0">
							<div class="d-flex justify-content-end mr-3">
								<a href="{{route('panel.deleteImg',$item->id)}}" class="ml-5 delete-item mr-2">
									<i class="fi fi-bs-trash text-danger"></i>
								</a>
								<a download href="{{$item->path}}">
									<i class="fi fi-bs-download text-success"></i>
								</a>
							</div>
						</div>
					</div>

				</li>

			@empty
				<li class="list-group-item disabled p-5">
					
					<h6 class="text-muted text-center p-5">
						<i class="fa fa-file text-center mb-1"></i>
						<br>
						No Files Uploaded Yet!</h6>
				</li>
			@endforelse
		</ul>
		<div class="paginate mt-4">
			{{$attachments->links()}}
		</div>

		<form action="{{route('panel.fileManager')}}" method="post" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="mb-3 d-flex justify-content-between">
				<div>
					<label for="formFile" class="form-label">Select Your Files</label>
					<input type="hidden" name="order_id" value="{{$order_id}}">
					<input required class="form-control" name="files[]" type="file" style="padding: 5px;" id="formFile" multiple="multiple">
				</div>
				<div style="padding-top: 29px">
					<button type="submit" class="btn btn-primary btn-sm mt-1" style="height: 35px;">Upload</button>
				</div>
			</div>
		</form>
	@else
		<div style="min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center">
			<i class="fa fa-file" style="font-size: 32px"></i>
			<h6 class="text-center">No Data Found !</h6>
			<a href="#" class="btn btn-primary" style="line-height: 1.2">Add Attachment</a>
		</div>
	@endif
</div>
