<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Item;
use App\Models\Category;

use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Http\Requests\ItemImageUpdateRequest;

use App\Services\FileUploadService;

class AdminController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth', 'checkAdmin']);
    }
    
    public function index()
    {
        return view('admin.dashboard', [
        ]);
    }
    
    public function item()
    {
        $categories = Category::with(['item' => function($query){
            $query->latest();
        }])->get();
        
        return view('admin.manage_item', [
            'categories' => $categories,
        ]);
    }
    
    public function user()
    {
        $users = User::all();
        return view('admin.manage_user', [
            'users' => $users,
        ]);
    }
}