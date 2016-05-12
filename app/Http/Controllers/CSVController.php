<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Contact;
use App\ContactImport;
use Auth;
use Excel;
use App\Event;

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

    flash('You have successfully imported a list of contacts!');
  }
  public function exportGuestList($event_id)
  {
    $event = Event::find($event_id);
    $event_name = $event->event_name;
    $guestLists = $event->guestList;
    // Foreach Guests //

    foreach( $guestLists as $guest)
    {
      if($guest->checked_in_by != null){
        $oneGuest['rsvp'] = "Attended";
      }else{
        if($guest->rsvp == 1){
          $oneGuest['rsvp'] = "No Show";
        }else{
          $oneGuest['rsvp'] = "Did Not Attend";
        }
      }
      $first_name = $guest->contact()->withTrashed()->get()->toArray()[0]['first_name'];
      $last_name = $guest->contact()->withTrashed()->get()->toArray()[0]['last_name'];
      $oneGuest['name'] = $first_name . " " . $last_name;

      $occupation = $guest->contact()->withTrashed()->get()->toArray()[0]['occupation'];
      $company = $guest->contact()->withTrashed()->get()->toArray()[0]['company'];
      $oneGuest['work'] = $occupation . " " . $company;
      $oneGuest['additional_guests'] = $guest->additional_guests;
      $oneGuest['note'] = $guest->contact()->withTrashed()->get()->toArray()[0]['notes'];
      $data [] = $oneGuest;
    }
    return Excel::create($event_name, function($excel) use ($data) {
      $excel->sheet('sheet1', function($sheet) use($data) {
        $sheet->fromArray($data);
      });
    })->export('csv');
  }
  public function rsvpStatus (){
    return("null");
  }
  public function importContacts(Request $request)
  {
    $this->validate($request, ['csvContacts' => 'required|mimes:csv,txt,xlsx'], ['required' => 'You must input a csv or xlsx file.']);//TURN ON extension=php_fileinfo.dll IN php.ini, restart server after.

    if ($request->hasFile('csvContacts')) {
      $fileName = 'contactsImport.' . $request->file('csvContacts')->getClientOriginalExtension();
      $request->file('csvContacts')->move(
        base_path() . '/public/imports/', $fileName
      );
    } else {
      // no file
    }

    // add break for pop up proceed/cancel
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
