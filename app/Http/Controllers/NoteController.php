<?php

namespace App\Http\Controllers;

use App\Helpers\GetNoteableType;
use App\Notes;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(Request $request): Object
    {
      return Notes::create([
        'title' => $request->get('title'),
        'description' => $request->get('description'),
        'noteable_id' => $request->get('noteableId'),
        'noteable_type' => (new GetNoteableType())->getNoteable($request->get('noteableType')),
      ]);
    }
}
