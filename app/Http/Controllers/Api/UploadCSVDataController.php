<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CsvRecords;
use Illuminate\Support\Facades\Mail;
use App\Mail\CSVUploadCompleted;
use File;

class UploadCSVDataController extends Controller
{

    public function uploadCSVRecords(Request $request)
    {
        try {

            $validatedData = \Validator::make($request->all(), [  
                'csv_file'  => 'required|mimes:csv,txt'
            ]);
    
            if ($validatedData->fails()) {
                return response()->json(['status' => false, 'message' => $validatedData->messages()->first()]);
            }
            
            $file = $request->file('csv_file');
            
            $fileColumnCount = fopen($file, "r"); 
            $columnCount = count(fgetcsv($fileColumnCount));

            // Checking the count of the file headers
            if($columnCount != 3)
                return response()->json(['status' => false, 'message' => 'Column counts didn\'t meet the expected please check']);

            // Creating a directory if not exist
            if(!File::exists(base_path('storage/app/csv/'))) {

                File::makeDirectory(base_path('storage/app/csv/'), 0777, true, true);
            }

            // Puttin the file into the created directory
            $filename = $file->store('csv');

            // mapping the stored file data in an array
            $csv = array_map('str_getcsv', file(base_path('storage/app/'.$filename)));

            // Checking the headings match with the required document
            if([$csv[0][0], $csv[0][1], $csv[0][2]] != ["Module_code", "Module_name", "Module_term"])
                return response()->json(['status' => false, 'message' => 'Headings not match with the file, please check your file']);

            // Initializing the error variables with null
            $moduleCodeSymbolError = '';
            $moduleNameMissingError = '';
            $termNameMissingError = '';
            $termNameSymbolError = '';

            // Reading the csv file one at a time
            for($i = 1; $i<= count($csv) - 1; $i++) { 

                // Checking the module code is alphanumeric or not
                if(!preg_match("/[A-Za-z0-9]+/", $csv[$i][0])) {
                    $moduleCodeSymbolError .= $i.', '; // appending the index
                    continue;
                }
                
                // Checking the module name is empty 
                if(trim($csv[$i][1]) == null) {
                    $moduleNameMissingError .= $i.', '; // appending the index
                    continue;
                }

                // Checking the term name is empty 
                if(trim($csv[$i][2]) == null) {
                    $termNameMissingError .= $i.', '; // appending the index
                    continue;
                }

                // Checking the term name is alphanumeric or not
                if(!preg_match("/[A-Za-z0-9]+/", $csv[$i][2])) {
                    $termNameSymbolError .= $i.', '; // appending the index
                    continue;
                }

                // Creating a record in the database
                $csvRecords = new CsvRecords();
                $csvRecords->module_code = $csv[$i][0];
                $csvRecords->module_name = $csv[$i][1];
                $csvRecords->module_term = $csv[$i][2];
                $csvRecords->save(); 
            }

            // Initialzing an array that stores the errors if any
            $errors = [];

            if($moduleCodeSymbolError != null)
                $errors[] = 'Module Code contains symbols at row '.$moduleCodeSymbolError;
            
            if($moduleNameMissingError != null)
                $errors[] = 'Module Name is missing at row '.$moduleNameMissingError;
            
            if($termNameMissingError != null)
                $errors[] = 'Term Name is missing at row '.$termNameMissingError;

            if($termNameMissingError != null)
                $errors[] = 'Term Name contains symbols at row '.$termNameMissingError;  

            Mail::to('sajeevkp1992@gmail.com')->send(new CSVUploadCompleted($errors));// tested with mailtrap using my credentials

            return response()->json(['status' => true, 'message' => 'Saved, mail notification has been sent to charush@accubits.com' ]);

        } catch(Exception $e) {
            report($e);
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}

?>