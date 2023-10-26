<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function getfile()
    {
        $path = storage_path('app');

        // Lấy danh sách các thư mục và file trong thư mục storage
        $directories = array_filter(glob($path . '/*'), 'is_dir');
        $files = array_filter(glob($path . '/*'), 'is_file'); // Sử dụng '/*.*' để lấy danh sách các tệp
        //return view('storage', ['directories' => $directories,'files' => $files]);
        return view('storage', compact('directories', 'files'));
        return 'Thư mục rỗng';
    }

    public function showDirectory($directory)
    {
        $path = storage_path('app/' . $directory);

        if (is_dir($path)) {
            $directories = array_filter(glob($path . '/*'), 'is_dir');
            $files = array_filter(glob($path . '/*'), 'is_file'); // Sử dụng '/*.*' để lấy danh sách các tệp
            return view('storage', compact('directories', 'files'));
            //return view('storage', ['files' => $files]);
        }
    }
}