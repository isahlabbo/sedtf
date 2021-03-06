    <tr>
    	<td>
            {{strtoupper($registration->sessionRegistration->student->first_name)}} {{strtoupper($registration->sessionRegistration->student->middle_name)}}
    		{{strtoupper($registration->sessionRegistration->student->last_name)}}
    	</td>

    	<td>
    		{{$registration->sessionRegistration->student->admission->admission_no}}
    	</td>

    	<td >
    		@foreach($registration->courseRegistrations->where('cancelation_status',0) as $course_registration)
    		    {{$course_registration->course->code}}<br>
    		@endforeach
    	</td>

    	<td>
    		@foreach($registration->courseRegistrations->where('cancelation_status',0) as $course_registration)
    		{{$course_registration->course->unit}}<br>
    		@endforeach
    	</td>

    	<td>
    		@foreach($registration->courseRegistrations->where('cancelation_status',0) as $course_registration)
    		    @if($course_registration->result->waved())
                    <i><strong class="h4">{{$course_registration->result->grade}}</strong></i>
                @else
                    {{$course_registration->result->grade}}
                @endif
                <br>
    		@endforeach
    	</td>

    	<td>
        	@foreach($registration->courseRegistrations->where('cancelation_status',0) as $course_registration)
    		{{number_format($course_registration->result->points,2)}}<br>
    		@endforeach
    	</td>
            
    	<td>
    		@foreach($registration->courseRegistrations->where('cancelation_status',0) as $course_registration)
    		{{number_format($course_registration->course->unit * $course_registration->result->points,2)}}
    		<br>
    		@endforeach
    	</td>

    	<td>
    		{{number_format($registration->cummulativeGradePoints(),2) ?? ' '}}
    	</td>

    	<td>
    		{{number_format($registration->cummulativeGradePointsAverage(),2) ?? ' '}}
    	</td>

    	
    	<td>
            {{$registration->sessionRegistration->student->generalRemarks()['remark']}}<br>
    	</td>
    </tr>