<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('exam-officer')
    ->name('exam.officer.')
    ->group(function() {

        Route::prefix('department/course')
		->name('department.course.')
		->namespace('Course')
		->group(function() {

			Route::get('/', 'CourseController@index')->name('index');
			Route::get('/create-course', 'CourseController@create')->name('create');
			Route::post('{course_id}/update-course', 'CourseController@update')->name('update');
			Route::get('{course_id}/edit-course', 'CourseController@edit')->name('edit');
			Route::post('/register-course', 'CourseController@register')->name('register');
			Route::get('{course_id}/delete-course', 'CourseController@delete')->name('delete');

			Route::prefix('allocation')
			->name('allocation.')
			->group(function() {
			    Route::get('/', 'CourseAllocationController@index')->name('index');
			    Route::post('/register', 'CourseAllocationController@register')->name('register');
			    Route::get('/programme/{programmeId}/view', 'CourseAllocationController@viewCourses')->name('view');
			    Route::post('/search', 'CourseAllocationController@searchCourses')->name('search');
			});
			
		});

		// files routes

		Route::prefix('files')
		->name('file.')
		->namespace('Results')
		->group(function() {

			Route::prefix('upload')
			->name('upload.')
			->group(function() {

				Route::prefix('result')
				->name('result.')
				
				->group(function() {

					Route::get('/', 'FileController@index')->name('index');
					
				});

				// other uploaded files
				
			});

			// other files categories here
			
		});

        //admission routes
        Route::prefix('student/admission')
		->name('student.admission.')
		->namespace('Admission')
		->group(function() {

			Route::get('/', 'AdmissionController@index')->name('index');

			Route::get('/generate-admission-number', 
			'AdmissionController@generateNumberIndex')
			->name('generate.number.index')->middleware('canAdmitt');

			Route::post('{admission_id}/update-admission', 
			'AdmissionController@update')
			->name('update');

			Route::post('{admissionNo}/schedule/{schedule}/register-genrated-number', 
			'AdmissionController@registerGeneratedNumber')
			->name('register.generated.number')->middleware('canAdmitt');

			Route::get('{admission_id}/edit-admission', 
			'AdmissionController@edit')
			->name('edit');

			Route::get('{admissionNo}/schedule/{schedule}/generated-number-registration', 
			'AdmissionController@generatedNumberRegistration')
			->name('register.generated.number.index')->middleware('canAdmitt');

			Route::get('{admission_id}/revoke-admission', 
			'AdmissionController@revokeAdmission')
			->name('revoke');

			Route::post('/generate-number', 
			'AdmissionController@generateNumber')
			->name('generate.number');

			Route::get('{admission_id}/delete-admission', 
			'AdmissionController@delete')
			->name('delete');
			
		});
		
		//student biodatas route
		Route::prefix('students/')
		->name('student.')
		->namespace('Student')
		->group(function() {
            Route::get('{studentID}/biodata/view', 'StudentController@viewBiodata')->name('view.biodata');
            Route::get('{studentID}/biodata/edit', 'StudentController@editBiodata')->name('biodata.edit');
            Route::post('{studentID}/biodata/update', 'StudentController@updateBiodata')->name('biodata.update');
            Route::get('/', 'StudentController@student')->name('student.index');
            Route::get('/{state}/{session}/admitted', 'StudentController@availableStudent')->name('student.available');
            Route::post('/search', 'StudentController@searchStudent')->name('student.search');

		});


        Route::get('/', 'ExamOfficerController@verify')->name('verify');
	    Route::get('/dashboard', 'ExamOfficerController@index')->name('dashboard');
	    Route::get('/login', 'Auth\ExamOfficerLoginController@showLoginForm')->name('auth.login');
	    Route::post('/login', 'Auth\ExamOfficerLoginController@login')->name('login');
	    Route::post('logout', 'Auth\ExamOfficerLoginController@logout')->name('auth.logout');
		Route::get('/Authorisation/fail', 'Auth\ExamOfficerLoginController@unauthorize')->name('auth.auth');
	//graduation routes
    Route::prefix('graduation')
    ->name('graduation.')
    ->namespace('Graduation')
    ->group(function() {
        Route::get('/', 'GraduationController@graduationIndex')->name('graduate.index');
        Route::get('/spill', 'GraduationController@spillOverIndex')->name('spill.index');
        Route::get('/with-draw', 'GraduationController@withDrawIndex')->name('withdraw.index');
        Route::post('/search/graduates', 'GraduationController@searchGraduateStudents')->name('search.graduates');
        Route::post('/search/spill-overs', 'GraduationController@searchSpillingStudents')->name('search.spills');
        Route::post('/search/with-draws', 'GraduationController@searchWithDrawedStudents')->name('search.withdraws');
    });
	//result routes    
    Route::prefix('results')
    ->name('result.')
    ->namespace('Results')
    ->group(function() {

    	//vetting result routes
        Route::prefix('vetting')
	    ->name('vetting.')
	    ->group(function() {
            Route::get('/', 'VettingResultController@index')->name('index');
		    Route::post('/search', 'VettingResultController@search')->name('search');
		    Route::get('/semester/{semester_id}/view', 'VettingResultController@view')->name('view');
	    });
        //wave result routes
	    Route::prefix('student/wave')
	    ->name('student.wave.')
	    ->group(function() {
            Route::get('/', 'WaveResultController@index')->name('index');
		    Route::post('/search', 'WaveResultController@search')->name('search');
		    Route::get('/semester/{semester_id}/view', 'WaveResultController@view')->name('view');
		    Route::get('/result/{result_id}/register', 'WaveResultController@waveResult')->name('register');
	    });

	    //score sheet routes
	    Route::prefix('score-sheet')
	    ->name('scoresheet.')
	    ->group(function() {
            Route::get('/download', 'ScoreSheetController@downloadIndex')->name('download.index');
            Route::post('/download/score-sheet', 'ScoreSheetController@downloadScoreSheet')->name('download');
            Route::post('/upload/result', 'ScoreSheetController@uploadScoreSheet')->name('upload');
		    Route::get('/upload', 'ScoreSheetController@uploadIndex')->name('upload.index');
	    });
	    //student results routes
	    Route::prefix('student')
	    ->name('student.')
	    ->group(function() {
            Route::get('/create', 'StudentResultController@index')->name('index');
            Route::get('semester/{semester_id}/view', 'StudentResultController@viewResult')->name('view');
            Route::post('/search', 'StudentResultController@searchResult')->name('search');
            Route::get('result/{result_id}/edit', 'StudentResultController@edit')->name('edit');
		    Route::post('result/{result_id}/update', 'StudentResultController@update')->name('update');
		    //emc verdict remark registrations
		    Route::prefix('remark')
			->name('remark.')
			->group(function() {
			    Route::get('/', 'ResultRemarkController@index')->name('index');
			    Route::post('semester/{semester_id}/register', 'ResultRemarkController@register')->name('register');
			    Route::post('/registration/search', 'ResultRemarkController@searchRegistration')->name('registration.search');
			    Route::get('semester/{semester_id}/registration/view', 'ResultRemarkController@viewRegistration')->name('registration.view');
			});
        });

        //course results routes
        Route::prefix('course')
	    ->name('course.')
	    ->group(function() {
            Route::get('/create', 'CourseResultController@index')->name('index');
            Route::get('upload/{upload_id}/view', 'CourseResultController@review')->name('review');
            Route::post('upload/{upload_id}/comment', 'ResultCommentController@store')->name('comment');
            Route::post('/search', 'CourseResultController@search')->name('search');
            Route::get('result/{result_id}/amend', 'CourseResultController@amend')->name('amend');
			Route::post('result/{result_id}/approve', 'CourseResultController@approve')->name('approve');
			Route::post('result/{result_id}/amend/register', 'CourseResultController@amendResult')->name('amend.register');
			Route::get('result/{result_id}/edit', 'CourseResultController@editCourseResult')->name('edit');
        });
    });
	    
});
