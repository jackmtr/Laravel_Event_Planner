<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contact;
use App\ContactImport;
use Excel;

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

  public function importContacts()
  {
    Excel::filter('chunk')->load(Input::file('csvContacts'))->chunk(250, function($results)
    {
      dd($results);
      // foreach($results as $row)
      // {
      //
      // }
    });
  }

}
