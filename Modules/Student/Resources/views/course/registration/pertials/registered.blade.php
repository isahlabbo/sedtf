<div class="card">
	<div class="card-header text text-center h3 bt-color-1">{{student()->admission->programme->name}} {{currentSession()->name}} Session Courses Registered</div>
	<div class="card-body ">
		<div class="table-responsive">
			<table class="table table-triped">
				<head>
					<tr>
						<td>S/N</td>
						<td>Course Title</td>
						<td>Course Code</td>
						<td>Course Unit</td>
						<td>Semester</td>
						<td>lecturer</td>
						<td></td>
					</tr>
				</head>
				<tbody>
					@foreach($registrations as $registration)
						@foreach($registration->semesterRegistrations as $semester_registration)
							@foreach($semester_registration->courseRegistrations as $course_registration)
							<tr>
								<td>
									{{$loop->index+1}}
								</td>
								<td>
									{{$course_registration->course->title}}
								</td>
								<td>
									{{$course_registration->course->code}}
								</td>
								<td>
									{{$course_registration->course->unit}}
								</td>
								<td>
									{{$course_registration->course->semester->name}}
								</td>
								<td>
									{{$course_registration->course->courseLecturer() ? $course_registration->course->courseLecturer()->staff->first_name.' '.$course_registration->course->courseLecturer()->staff->last_name :  'Not available'}}
								</td>
								<td>
									<input type="checkbox" value="{{$course_registration->course->id}}" checked="1" class="form-control" name="remove[]">
								</td>
							</tr>
							@endforeach
						@endforeach
					@endforeach
				</tbody>
			</table>
		</div>	
	</div>
</div>