<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PublicAccessController extends Controller
{
    
    public function browse() {

        $colleges = DB::table('file_sets')
                        ->select('college')
                        ->distinct()
                        ->get();

        return view('students.browse', compact('colleges'));

    }

    public function browsePrograms($folder_id) {

        $programs = DB::table('file_sets')
                        ->select('program')
                        ->distinct()
                        ->where('college', $folder_id)
                        ->get();

        return view('students.browse_programs', compact('programs', 'folder_id'));

    }

    public function browseThesisFiles($college, $program) {

        $file_sets = DB::table('file_sets')
							->select('*')
							->where('college', $college)
							->where('program', $program)
							->get();

        return view('students.browse_thesis_list',
                    compact('college', 'file_sets', 'program'));

    }

    public function publicSearch(Request $request) {
        
        return view('students.search');

    }

}
