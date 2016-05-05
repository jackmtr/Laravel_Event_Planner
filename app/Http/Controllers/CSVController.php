<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Excel;
use App\Contact;

class CSVController extends Controller
{
  public function exportContactList()
    {
        $data = Contact::all();
        return Excel::create('export1', function($excel) use($data) {
          $excel->setTitle('Our new awesome title')
                ->setCreator('Maatwebsite')
                ->setCompany('Maatwebsite')
                ->setDescription('A demonstration to change the file properties');

          $excel->sheet('export1_sheet1', function($sheet) use($data) {
            $sheet->fromModel($data);
          });
        })->export('csv');
    }




}
