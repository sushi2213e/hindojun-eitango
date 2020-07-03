<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sentence;
use App\UserSentence;

class SentenceController extends Controller
{
  public function index() {
    $sentences = Sentence::orderBy('id', 'desc')->paginate(10);
    return view('sentences.index', [
      'sentences' => $sentences,
    ]);
  }

  public function create(Request $request) {
    $sentence = new Sentence();
    $sentence->create_user_id = $request->input('create_user_id');
    $sentence->create_user_name = $request->input('create_user_name');
    $sentence->lemma = $request->input('lemma');
    $sentence->meaning = $request->input('meaning');
    $sentence->sentence_english = $request->input('sentence_english');
    $sentence->sentence_japanese = $request->input('sentence_japanese');
    $sentence->save();
    $user_sentence = new UserSentence();
    $user_sentence->user_id = $request->input('create_user_id');
    $user_sentence->sentence_id = $sentence->id;
    $user_sentence->save();
    return response()->json();
  }


  public function save(Request $request) {
    $user_sentence_exists = UserSentence::where('user_id', $request->input('user_id'))
                                            ->where('sentence_id', $request->input('sentence_id'))
                                            ->get();
    if ($user_sentence_exists->count()) {
      return response()->json(['save' => false]);
    }
    $user_sentence = new UserSentence();
    $user_sentence->user_id = $request->input('user_id');
    $user_sentence->sentence_id = $request->input('sentence_id');
    $user_sentence->save();
    return response()->json(['save' => true]);
  }

  public function showList(int $lang, int $achieved, int $order) {
    $user = Auth::user();
    $list_blade = 'sentences.list' . $lang;
    if ($lang === 0) {
      if ($achieved !== 2) {
        if ($order === 0) {
          $sentences = $user->sentences()->where('achieve', $achieved)->orderBy('pivot_id', 'desc')->get();
        } elseif ($order === 1) {
          $sentences = $user->sentences()->where('achieve', $achieved)->orderBy('pivot_id', 'asc')->get();
        } else {
          $sentences = $user->sentences()->where('achieve', $achieved)->get()->shuffle();
        }
      } else {
        if ($order === 0) {
          $sentences = $user->sentences()->orderBy('pivot_id', 'desc')->get();
        } elseif ($order === 1) {
          $sentences = $user->sentences()->orderBy('pivot_id', 'asc')->get();
        } else {
          $sentences = $user->sentences()->get()->shuffle();
        }
      }
    } else {
      if ($achieved !== 2) {
        if ($order === 0) {
          $sentences = $user->sentences()->where('accomplish', $achieved)->orderBy('pivot_id', 'desc')->get();
        } elseif ($order === 1) {
          $sentences = $user->sentences()->where('accomplish', $achieved)->orderBy('pivot_id', 'asc')->get();
        } else {
          $sentences = $user->sentences()->where('accomplish', $achieved)->get()->shuffle();
        }
      } else {
        if ($order === 0) {
          $sentences = $user->sentences()->orderBy('pivot_id', 'desc')->get();
        } elseif ($order === 1) {
          $sentences = $user->sentences()->orderBy('pivot_id', 'asc')->get();
        } else {
          $sentences = $user->sentences()->get()->shuffle();
        }
      }
    }
    $count_achieved = 0;
    $count_not_achieved = 0;
    $count_accomplished = 0;
    $count_not_accomplished = 0;
    $all_sentences = $user->sentences()->get();
    foreach ($all_sentences as $all_sentence) {
      if ($all_sentence->pivot->achieve) {
        $count_achieved++;
      } else {
        $count_not_achieved++;
      }
    }
    foreach ($all_sentences as $all_sentence) {
      if ($all_sentence->pivot->accomplish) {
        $count_accomplished++;
      } else {
        $count_not_accomplished++;
      }
    }
    return view($list_blade, [
      'sentences' => $sentences,
      'lang' => $lang,
      'achieved' => $achieved,
      'order' => $order,
      'count_list_data' => [$count_achieved, $count_not_achieved, $count_accomplished, $count_not_accomplished]
    ]);
  }

  public function achieve(Request $request) {
    $user_sentence = UserSentence::where('user_id', $request->input('user_id'))
                                            ->where('sentence_id', $request->input('sentence_id'))
                                            ->first();
    $user_sentence->achieve = 1;
    $user_sentence->save();
    return response()->json();
  }

  public function accomplish(Request $request) {
    $user_sentence = UserSentence::where('user_id', $request->input('user_id'))
                                            ->where('sentence_id', $request->input('sentence_id'))
                                            ->first();
    $user_sentence->accomplish = 1;
    $user_sentence->save();
    return response()->json();
  }

  public function forget(Request $request) {
    $user_sentence = UserSentence::where('user_id', $request->input('user_id'))
                                            ->where('sentence_id', $request->input('sentence_id'))
                                            ->first();
    $user_sentence->achieve = 0;
    $user_sentence->save();
    return response()->json();
  }

  public function unlearn(Request $request) {
    $user_sentence = UserSentence::where('user_id', $request->input('user_id'))
                                            ->where('sentence_id', $request->input('sentence_id'))
                                            ->first();
    $user_sentence->accomplish = 0;
    $user_sentence->save();
    return response()->json();
  }

  public function delete(Request $request) {
    $user_sentence = UserSentence::where('user_id', $request->input('user_id'))
                                            ->where('sentence_id', $request->input('sentence_id'))
                                            ->first();
    $user_sentence->delete();
    return response()->json();
  }
}
