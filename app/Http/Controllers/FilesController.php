<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileSet;
use DB;
use Log;
use DateTime;
use Carbon\Carbon;

class FilesController extends Controller
{

  public function runSearch(Request $request) {
    Log::info('hello there, keep going.');
    $main = $request->main;
    $type = $request->type;
    $school_year = $request->school_year;
    $uploader = $request->uploader;
    $department = $request->department;

    if ($main !=null) {
      $query_priority = "SELECT * FROM file_sets WHERE name LIKE '%{$main}%' ";
    } else {
      $query_priority = "SELECT * FROM file_sets WHERE FALSE ";
    }
    $query_additional = $query_priority;

    if ($type != null) {
      $query_priority .= "AND type LIKE '%{$type}%' ";
      $query_additional .= "OR type LIKE '%{$type}%' ";
    }
    if ($school_year != null) {
      $query_priority .= "AND school_year LIKE '%{$school_year}%' ";
      $query_additional .= "OR school_year LIKE '%{$school_year}%' ";
    }
    if ($uploader != null) {
      $query_priority .= "AND uploader LIKE '%{$uploader}%' ";
      $query_additional .= "OR uploader LIKE '%{$uploader}%' ";
    }
    if ($department != null) {
      $query_priority .= "AND department LIKE '%{$department}%' ";
      $query_additional .= "OR department LIKE '%{$department}%' ";
    }

    $results_priority = DB::select($query_priority);
    $results_additional = DB::select($query_additional);

    $queries = array(
      'priority' => $query_priority,
      'additional' => $query_additional,
    );

    $results = array(
      'priority' => $results_priority,
      'additional' => $results_additional
    );

    return compact('results');

  }

  public function wildSearch(Request $request) {

    $search = $request->search_string;

    return view('files.search', compact('search'));

  }

  public function setUpload() {

    $folders_db = new \App\Folder;
    $folders = $folders_db->all();

    return view('files.upload', compact('folders'));

  }

  public function uploadFiles(Request $request) {

    error_log('UPLOADING...');
    $fileset = new \App\FileSet;

    try {
      // check if fileset is already existing
      if ($fileset->where('name', $request->file_set)->get()->count() > 0) {
        // if fileset exists: get the id then add the files
        $fileset_id = $fileset->where('name', $request->file_set)->get()[0]->id;

        // save each file from the set
        for ($i = 0; $i < count($request['files']); $i++) {
          $index = $request['files'][$i];
          $filedata = new \App\File;
          $filedata->index = $index['index'];
          $filedata->value = $index['value'];
          $filedata->height = $index['height'];
          $filedata->extension = $index['extension'];
          $filedata->width = $index['width'];
          $filedata->file_set_id = $fileset_id;
          $filedata->save();
        }

        $response = array('id'=>$fileset_id);
        return response($response);

      } else {
        error_log('CREATING A NEW FILESET');
        error_log('TOTAL FILES: ' . count($request['files']));
        // else: create a new one
        $fileSet = new \App\FileSet;

        error_log('SAVING FILESET INFORMATION');
        $fileSet->name =          $request->name;
        $fileSet->uploader =      $request->uploader;
        $fileSet->type =          $request->file_type;
        $fileSet->school_year =   $request->school_year;
        $fileSet->college =       $request->college;
        $fileSet->program =       $request->program;
        $fileSet->authors =       $request->authors;
        $fileSet->description =   $request->description;
        $fileSet->title =         $request->title;
        $fileSet->number_of_pages = count($request['files']);
        $fileSet->save();

        // save each file from the set
        error_log('SAVING FILE/S');
        for ($i = 0; $i < count($request['files']); $i++) {
          error_log('CREATING FILES ' . $i . ' OF ' . count($request['files']));
          $index = $request['files'][$i];
          $filedata = new \App\File;
          $filedata->index = $index['index'];
          $filedata->value = $index['value'];
          $filedata->extension = $index['extension'];
          $filedata->height = $index['height'];
          $filedata->width = $index['width'];
          $filedata->file_set_id = $fileSet->id;
          $filedata->save();
        }

        error_log('FILES SAVED! SENDING BACK INFO.');

        $response = array('id'=>$fileSet->id, 'request'=> $request);
        return response($response);

      }

    } catch (\Exception $e) {

      error_log('OOPS SOMETHING WENT WRONG:');
      error_log($e->getMessage());
      return $e->getMessage();

    }

  }

  public function getSearchPage() {

    return view('files.search');

  }

  public function viewFileSet(FileSet $fileset) {

    return view('files.view', compact('fileset'));

  }

  public function viewFolders(Request $request) {

    return view('files.folders');

  }
  
  public function getPublicThesis() {

    return view('students.public_access');

  }

  public function checkThesisRecord(Request $request) {

    error_log('checking for id: ' . $request->thesis_id);

    $response = array();

    $db_file_set = DB::table('file_sets')
                        ->select('*')
                        ->where('id', $request->thesis_id)
                        ->get();

    if ($db_file_set->count() > 0) {
      $file_set = $db_file_set[0];
      $response = array(
        'has_record' => 'true',
        'title' => $file_set->title,
        'college' => $file_set->college,
        'program' => $file_set->program,
        'school_year' => $file_set->school_year
      );
    } else {
      $response = array(
        'has_record' => 'false'
      );
    }

    return response($response);

  }

  public function getTokenGenerator() {

    return view('files.generate_token');

  }

  public function getTokenGeneratorPre($fileset_id) {

    return view('files.generate_token', compact('fileset_id'));

  }

  public function generateToken(Request $request) {

    $db_token = new \App\ThesisToken;

    $date_now = Carbon::now();
    $expiration_date = $date_now->addDays($request->days_available);

    $db_token->thesis_id        = $request->thesis_id;
    $db_token->days_available   = $request->days_available;
    $db_token->purpose          = $request->purpose;
    $db_token->requesting_id    = $request->requesting_id;
    $db_token->date_requested   = Carbon::now();
    $db_token->expiration_date  = $expiration_date;
    $db_token->token            = $request->token;

    $db_token->save();
    
    Log::info(print_r($db_token, true));

    $response = $db_token;

    return view('files.generate_token', compact('response'));

  }

  public function viewAllTokens() {

    $tokens = DB::table('thesis_tokens')
                      ->select('*')
                      ->get();

    return view('files.view_token', compact('tokens'));

  }

  public function retrievePublicThesis(Request $request) {

    $db_thesis = DB::table('thesis_tokens')
                    ->select('*')
                    ->where('token', $request->token)
                    ->where('requesting_id', $request->requesting_id)
                    ->where('thesis_id', $request->thesis_id)
                    ->get();

    if ($db_thesis->count() > 0) {
      
      // Check token if expired
      $date_now = Carbon::now();
      
      if ($date_now->lt($db_thesis[0]->expiration_date)) {

        $success_redirect = (object) array(
          'id' => $db_thesis[0]->thesis_id
        );
        return view('students.public_access', compact('success_redirect'));

      } else {

        error_log('Sorry, token has expired');
        $error_response = (object) array(
          'message' => 'Sorry, token has expired.'
        );
        return view('students.public_access', compact('error_response'));

      }

    } else {

      error_log('Sorry, no record found');
      $error_response = (object) array(
        'message' => 'Sorry, no record found.'
      );
      return view('students.public_access', compact('error_response'));

    }

  }

  public function retrievePublicThesisApproved(FileSet $fileset) {

    return view('students.retrieve_thesis', compact('fileset'));

  }

  public function retrieveRestrictedPublicThesisApproved(FileSet $fileset) {

    return view('students.retrieve_thesis_restricted', compact('fileset'));

  }

}
