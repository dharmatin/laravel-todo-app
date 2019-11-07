<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index() {
        return Task::all();
    }

    public function create(Request $request) {
        $task = new Task;
        $task->name = $request->name;
        try {
            $task->save();
            return response()
                ->json([
                    "message" => "sucess",
                     "code" => 201, 
                     "data" => [
                         "id" => $task->id, 
                         "name" => $task->name,
                         "is_done" => false
                        ]
                    ], 201);
        } catch (\Exception $e) {
            Log::error("Something error!: " . $e->getMessage());
            return response()
                ->json(["message" => "internal server error", "code" => 500], 500);
        }
    }

    public function update(Request $request, $id) {
        $task = Task::find($id);
        $task->is_done = $request->isDone == "true";
        try {
            $task->save();
            return response()
                ->json(["message" => "sucess", "code" => 200], 200);
        } catch (\Exception $e) {
            Log::error("Something error!: " . $e->getMessage());
            return response()
                ->json(["message" => "internal server error", "code" => 500], 500);
        }
    }

    public function delete($id) {
        $task = Task::find($id);
        try {
            $task->delete();
            return response()
                ->json(["message" => "sucess", "code" => 200], 200);
        } catch (\Exception $e) {
            Log::error("Something error!: " . $e->getMessage());
            return response()
                ->json(["message" => "internal server error", "code" => 500], 500);
        }
    }

    public function bulkDelete(Request $request) {
        $ids = $request->ids;
        try {
            Task::destroy($ids);
            return response()
                ->json(["message" => "sucess", "code" => 200], 200);
        } catch (\Exception $e) {
            Log::error("Something error!: " . $e->getMessage());
            return response()
                ->json(["message" => "internal server error", "code" => 500], 500);
        }
    }
}
