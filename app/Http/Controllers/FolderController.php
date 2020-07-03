<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Folder;
use App\Minifolder;
use App\Word;
use App\User;

class FolderController extends Controller
{
    public function index() {
      $folders = Folder::all();
      if (Auth::check()) {
        for ($i=1; $i <= 6; $i++) {
          $clear_data_n = 'clear_data_' . $i;
          $clear_data[] = Auth::user()->$clear_data_n;
        }
      } else {
        $clear_data = [0, 0, 0, 0, 0, 0];
      }
      return view('folders.index', [
        'folders' => $folders,
        'clear_data' => $clear_data,
      ]);
    }

    public function showFolder(Folder $folder) {
      $folders = Folder::all();
      // $minifolders = Minifolder::where('folder_id', $folder->id)->get();
      $minifolders = $folder->minifolders()->get();
      // $words = Word::where('folder_id', $folder->id)->get();
      $words = $folder->words()->get();
      if (Auth::check()) {
        for ($i=1; $i <= 6; $i++) {
          $clear_data_n = 'clear_data_' . $i;
          $clear_data[] = Auth::user()->$clear_data_n;
        }
      } else {
        $clear_data = [0, 0, 0, 0, 0, 0];
      }
      return view('folders.folder', [
        'current_folder' => $folder,
        'folders' => $folders,
        'minifolders' => $minifolders,
        'words' => $words,
        'clear_data' => $clear_data,
      ]);
    }

    public function clear(int $folderId, int $newClearData) {
      $user = Auth::user();
      $clear_data_n = 'clear_data_' . $folderId;
      $user->$clear_data_n = $newClearData;
      $user->save();
    }
}
