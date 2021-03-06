<!-- modal -->
<div class="modal fade" id="edit_{{$programme->id}}" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">	
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            	<form method="post" action="{{route('coodinator.programme.update',[$programme->id])}}">
            		@csrf
            		<div class="form-group">
                        <label class="text text-danger">Programme Name</label>
                        <input type="text" name="name" class="form-control" value="{{$programme->name}}" placeholder="Certificate in Computer Science">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text text-danger">Programme Type</label>
                        <select name="type">
                        	<option value="{{$programme->programmeType->id}}">{{$programme->programmeType->name}}</option>
                        	@foreach($programmeTypes->where('id','!=',$programme->programmeType->id) as $programmeType)
                                <option value="{{$programmeType->id}}">{{$programmeType->name}}</option>
                        	@endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text text-danger">Programme Application</label>
                        <select name="application_status">
                        	<option value="{{$programme->applictaion_status}}">{{$programme->application_status == 0 ? 'Not Active' : 'Active'}}</option>
                        	@if($programme->application_status == 0)
                                <option value="1">Activate {{$programme->name}} Application</option>
                            @else
                                <option value="0">De-Activate {{$programme->name}} Application</option>
                        	@endif
                        </select>
                    </div>

            		<div class="form-group">
                        <label class="text text-danger">No of Batches</label>
                        <input type="number" name="batches" class="form-control" value="{{$programme->batches}}" placeholder="3">
                        @error('batches')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="text text-danger">No of Semesters</label>
                        <input type="number" name="semesters" class="form-control" value="{{$programme->semesters}}" placeholder="2">
                        @error('semesters')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="text text-danger">Duration in Month</label>
                        <input type="number" name="duration" class="form-control" value="{{$programme->duration}}" placeholder="6">
                        @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="text text-danger">Fee</label>
                        <input type="number" name="fee" class="form-control" value="{{$programme->fee}}">
                        @error('fee')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="text text-danger">Code</label>
                        <input type="text" name="code" class="form-control" value="{{$programme->code}}">
                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="text text-danger">About Programme</label>
                        <textarea type="text" name="about" class="form-control"  placeholder="Write some thing small about the programme" value="{{$programme->about}}">{{$programme->about}}</textarea> 
                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if($programme->hasMorningSchedule())
                    <div class="form-group">
                        <label class="text text-danger">Remove Morning Schedule</label>
                        <select name="remove[]" class="form-control">
                            <option value="">Remove Schedule</option>
                            <option value="1">Morning Schedule</option>
                        </select>
                    </div>
                    @else
                    <div class="form-group">
                        <label class="text text-danger">Add Morning Schedule</label>
                        <select name="add[]" class="form-control">
                            <option value="">Add Schedule</option>
                            <option value="1">Morning Schedule</option>
                        </select>
                    </div>
                    @endif

                    @if($programme->hasEveningSchedule())
                    <div class="form-group">
                        <label class="text text-danger">Remove Evening Schedule</label>
                        <select name="remove[]" class="form-control">
                            <option value="">Remove Schedule</option>
                            <option value="2">Evening Schedule</option>
                        </select>
                    </div>
                    @else
                    <div class="form-group">
                        <label class="text text-danger">Add Evening Schedule</label>
                        <select name="add[]" class="form-control">
                            <option value="">Add Schedule</option>
                            <option value="2">Evening Schedule</option>
                        </select>
                    </div>
                    @endif

                    <button class="button-fullwidth cws-button bt-color-1 btn-block">Update Changes</button>
            	</form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->