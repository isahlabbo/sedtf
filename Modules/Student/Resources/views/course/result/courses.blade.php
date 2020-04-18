@extends('student::layouts.master')

@section('page-content')
@php
$count = 1;
@endphp
<input type="checkbox" name="">
<div class="col-md-1"></div>
<div class="col-md-10">
	@foreach(student()->sessionRegistrations as $session_registration)
	<br>
	<div class="card shadow">
		<div class="card-header h3 bt-color-1"> Batch {{student()->batch()}} {{$session_registration->session->name}} {{student()->admission->programme->name}} Registered Courses</div>
		<div class="card-body shadow">
			<table class="table shadow">
				<head>
					<tr>
						<td>S/N</td>
						<td>Course Title</td>
						<td>Course Code</td>
						<td>Course Unit</td>
						<td>Semester</td>
					</tr>
				</head>
				<tbody>
					@foreach($session_registration->semesterRegistrations as $semester_registration)
					    @foreach($semester_registration->courseRegistrations as $course_registration)
							<tr>
								<td>{{$count++}}</td>
								<td>{{$course_registration->course->title}}</td>
								<td>
									{{$course_registration->course->code}}
								</td>
								<td>
									{{$course_registration->course->unit}}
								</td>
								
								<td>
									{{$course_registration->course->semester->name}}
								</td>
							</tr>
					    @endforeach
					@endforeach
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="strong h4">Registered Units</td>
						<td class="strong h4">{{$session_registration->registeredUnits()}}</td>
					</tr>
				</tbody>
			</table>	
		</div>
	</div><br>
	@endforeach
</div> 
@endsection
