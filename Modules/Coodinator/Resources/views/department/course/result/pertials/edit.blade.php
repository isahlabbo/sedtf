<div class="col-md-1"></div>
<div class="col-md-10">
	<br>
	<div class="card shadow">
		<div class="card-header bt-color-2">Edit Result</div>
		<div class="card-body">
			<table class="table shadow">
				<head>
					<tr>
						<td>S/N</td>
						<td>Name</td>
						<td>Admission No</td>
						<td>CA Score</td>
						<td>Exam Score</td>
						<td>Total Score</td>
						<td>Grade</td>
						<td>Points</td>
						<td>Remark</td>
						<td></td>
					</tr>
				</head>
				<tbody>
					@foreach($upload->results as $result)
					<tr>
						<td>
							{{$loop->index+1}}
						</td>
						<td>
							{{$result->courseRegistration->semesterRegistration->sessionRegistration->student->first_name}} {{$result->courseRegistration->semesterRegistration->sessionRegistration->student->last_name}}
						</td>
						<td>
							{{$result->courseRegistration->semesterRegistration->sessionRegistration->student->admission->admission_no}}
						</td>
						<td>
							{{$result->ca}}
						</td>
						<td>
							{{$result->exam}}
						</td>
						<td>
							{{$result->accessment() + $result->examination()}}			
						</td>
						<td>
							{{$result->grade}}
						</td>
						<td>
							{{$result->points}}
						</td>
						<td>
							{{$result->points > 0 ? 'PASSED' : 'FAILED'}}
						</td>
						<td>
							@if(lecturer())
							<button class="btn bt-color-4">
								<a href="{{route($route ?? 'department.result.student.edit',[$result->id])}}" style="color: white">Edit</a>
							</button>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>	
		</div>
	</div><br>
</div>