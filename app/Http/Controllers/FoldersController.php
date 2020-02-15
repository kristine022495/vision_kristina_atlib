<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use DB;
use Log;


class FoldersController extends Controller
{
    
	public function getFoldersList() {

		// $db_folders = new \App\Folder;
		// $folders = $db_folders->where('archived', 0)->get();

		// $query = 'SELECT DISTINCT COLLEGE FROM kristine.file_sets';
		$colleges = DB::table('kristine.file_sets')
							->select('college')
							->distinct()
							->get();

		Log::info(print_r($colleges, true));

		return view('files.folders', compact('colleges'));

	}

	public function getFilesList($college, $program) {

		// $db_school_year = DB::table('kristine.file_sets')
		// 					->select('school_year')
		// 					->distinct()
		// 					->where('college', $college)
		// 					->where('program', $program)
		// 					->get();

		// $school_years = array();

		$file_sets = DB::table('kristine.file_sets')
							->select('*')
							->where('college', $college)
							->where('program', $program)
							->get();

		return view('files.files_list', compact('program', 'college', 'file_sets'));

	}

	public function getSubFolders($folder_id) {

		// $fileset_db = new \App\FileSet;
		// $folder_db = new \App\Folder;
		// $folder_name = $folder_db->where('id', $folder_id)->get()[0]->name;
		// $sub_folders = $fileset_db->where('folder_id', $folder_id)->get();

		$programs = DB::table('kristine.file_sets')
							->select('program')
							->distinct()
							->where('college', $folder_id)
							->get();

		Log::info(print_r($programs, true));

		return view('files.sub_folders', compact('folder_id', 'programs'));

	}

	public function getSubFolderDetails(Request $request) {

		$fileset_db = new \App\FileSet;
		$result = $fileset_db
						->where('name', $request->sub_folder_name)
						->where('folder_id', $request->folder_id)->get();

		if ($result->count() > 0) {
			$response = array(
				'record_exists' => 'true',
				'data' => $result[0]
			);
		} else {
			$response = array(
				'record_exists' => 'false'
			);
		}

		return compact('response');

	}

	public function getSubFoldersList(Request $request) {

		try {

			$sub_folders = new \App\FileSet;
			$list = $sub_folders::where('folder_id', $request->folder_id)->get();
			$response = $list->toArray();

			return compact('response');	

		} catch (\Exception $e) {
			
			return $e->getMessage();

		}

	}

	public function manageFolders(Request $request) {

		$folder = new \App\Folder;
		$folders = $folder->get();

		return view('files.edit_folders', compact('folders'));

	}

	public function updateName(Request $request) {
		
		$db_folders = new \App\Folder;
		$folder = $db_folders->where('id', $request->id)->get()[0];

		$folder->name = $request->new_name;
		$folder->save();

		return response(array(
			'message' => 'success'
		));

	}

	public function toggleArchive(Request $request) {

		$response = array('message' => '');

		try {
		
			$db_folders = new \App\Folder;
			$id = $request->id;
			$folder = $db_folders->where('id', $id)->get()[0];
			$archived = $folder->archived;

			if ($archived == 1) {
				$folder->archived = 0;
			} else {
				$folder->archived = 1;
			}

			$folder->save();
			$response = array('message' => 'success');

		} catch (\Exception $e) {
			$response = array('message' => $e->getMessage());
		}

		return response($response);

	}

	public function addFolder(Request $request) {
		
		$folder = new \App\Folder;
		$folder->name = $request->folder_name;
		$folder->save();

		return response(array(
			'message'=> 'folder added'.$request->folder_name
		));

	}

}
