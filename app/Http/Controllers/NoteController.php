<?php

namespace App\Http\Controllers;

use App\Helpers\GetNoteableType;
use App\Http\Requests\NoteRequest;
use App\Notes;

class NoteController extends Controller
{
  public function store(NoteRequest $request): Object
  {
    return Notes::create([
      'title' => $request->get('title'),
      'description' => $request->get('description'),
      'noteable_id' => $request->get('noteableId'),
      'noteable_type' => (new GetNoteableType())->getNoteable($request->get('noteableType')),
    ]);
  }
}
