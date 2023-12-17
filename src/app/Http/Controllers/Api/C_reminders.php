<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reminders;
use Illuminate\Http\Request;

class C_reminders extends Controller
{
    public function create(Request $request)
    {
        try {
            $data = new Reminders();
            $data->title = $request->title;
            $data->description = $request->description;
            $data->remind_at = $request->remind_at;
            $data->event_at = $request->event_at;
            $data->save();

            return response()->json([
                'ok' => true,
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function list(Request $request)
    {
        try {
            if(empty($request->limit)){
                $lim = 10;
            }else{
                $lim = $request->limit;
            }
            $data = Reminders::limit($lim)->get();

            return response()->json([
                'ok' => true,
                'data' => ([
                    'reminders' => $data
                ]),
                'limit' => $lim
                ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function views(Request $request, $id)
    {
        try {
          
            $data = Reminders::where('id',$id)->get();

            return response()->json([
                'ok' => true,
                'data' => $data
                ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $hasil = Reminders::where('id',$id)->first();
            $data = Reminders::where('id',$id)
            ->update([
                'title' => $request->title ?: $hasil->title,
                'description' => $request->description ?: $hasil->description,
                'remind_at' => $request->remind_at ?: $hasil->remind_at,
                'event_at' => $request->event_at ?: $hasil->event_at
            ]);

            $ok = Reminders::where('id',$id)->get();
            
            return response()->json([
                'ok' => true,
                'data' => $ok
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function delete($id)
    {
        try {
            $data = Reminders::where('id',$id)->delete();
            
            return response()->json([
                'ok' => true
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

}
