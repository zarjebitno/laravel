<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index(Request $request) {
        $allPostsNum = count(Post::all());
        $latestPosts = Post::where('created_at', '>', Carbon::now()->subDay())
                        ->where('created_at', '<', Carbon::now())
                        ->get();
        $latest = count($latestPosts);
        $latestComments = Comment::where('created_at', '>', Carbon::now()->subDay())
                                    ->where('created_at', '<', Carbon::now())
                                    ->get();
        $latestComments = count($latestComments);

        $logPath = storage_path() . '/logs/myCustomLogFile.log';
        $logFile = array_reverse(file($logPath));

        $perPage = 10;
        $logEntries = count($logFile);
        $currentPage = $request->currentPage ? $request->currentPage : 1;
        $paginatedLog = array_slice($logFile, ($perPage * $currentPage - $perPage), $perPage);
        $totalPages = ceil($logEntries / $perPage);

        return view('admin.pages.index', [
            'allPostsNum' => $allPostsNum,
            'latestPosts' => $latest,
            'latestComments' => $latestComments,
            'logFile' => $paginatedLog,
            'totalPages' => $totalPages
        ]);
    }

    public function pagination(Request $request) {
        $logPath = storage_path() . '/logs/myCustomLogFile.log';
        $logFile = file($logPath);
        $perPage = 10;
        $filtered = [];

        $logEntries = count($logFile);
        $currentPage = $request->page ? $request->page : 1;
        $paginatedLog = array_slice($logFile, ($perPage * $currentPage - $perPage), $perPage);

        foreach($logFile as $line) {
            $logDate = substr($line, 1, 10);

            if($logDate === $request->logDate)
                array_push($filtered, $line);
        }

        if($request->logDate) {
            $currentPage = 1;
            $paginatedLog = array_slice($filtered, ($perPage * $currentPage - $perPage), $perPage);
            $totalPages = ceil(count($paginatedLog) / $perPage);

            return array($paginatedLog, $totalPages);
        }

        return $paginatedLog;

    }

    public function viewComments() {
        $comments = Comment::paginate(10);

        return view('admin.comments.index', [
            'comments' => $comments
        ]);
    }
}
