@extends('main')

@section('title', ' | Contact')

@section('content')
<form>

</form>

<div class="row">
	<div class="col-md-12">
		<h1>Contact US</h1>
		<hr>
		<form>

			<div class="form-group">
				<label id="email">Email:</label>
				<input type="email" class="form-control" id="email" placeholder="Example@example.com">
			</div>

			<div class="form-group">
				<label id="subject">Subject:</label>
				<input type="text" class="form-control" id="subject" placeholder="Subject">
			</div>

			<div class="form-group">
				<label id="message">Message:</label>
				<textarea class="form-control" id="message" rows="3" placeholder="Type your message here..."></textarea>
			</div>

			<button type="submit" class="btn btn-success">Send Message</button>

		</form>

	</div>
</div>
@endsection