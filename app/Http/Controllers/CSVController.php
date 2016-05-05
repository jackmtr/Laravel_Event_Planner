<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contact;
use App\ContactImport;
use Auth;
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

  public function importContacts(Request $request)
  {
    if ($request->hasFile('csvContacts')) {
      $fileName = 'contactsImport.' . $request->file('csvContacts')->getClientOriginalExtension();
      $request->file('csvContacts')->move(
        base_path() . '/public/imports/', $fileName
      );
    } else {
      // no file
    }
    Excel::filter('chunk')->load(base_path() . '/public/imports/' . $fileName)->chunk(250, function($results)
    {
      $authId = Auth::user()->user_id;
      foreach($results as $row)
      {
        $contact = Contact::firstOrNew([
          'first_name'=>$row->first_name,
          'last_name'=>$row->last_name,
          'email'=>$row->email
        ]);
        if ($contact->exists) {
          //contact already in db
        } else {
          $newContact = Contact::create([
            'first_name'=>$row->first_name,
            'last_name'=>$row->last_name,
            'email'=>$row->email,
            'occupation'=>$row->occupation,
            'company'=>$row->company,
            'wechat_id'=>$row->wechat_id,
            'notes'=>$row->notes,
            'added_by'=>$authId
          ]);
        }
      }
    });
    return redirect()->action('ContactController@index');
  }
}
