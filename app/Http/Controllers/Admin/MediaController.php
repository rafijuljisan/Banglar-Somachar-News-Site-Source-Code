<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
// Import the Image Library
use Intervention\Image\Facades\Image;

class MediaController extends Controller
{
    // 1. CONFIGURATION: Allowed folders
    protected $allowedFolders = [
        'post'          => 'Post Images',
        'logo'          => 'Logos & Branding',
        'admin'         => 'Admin/System Icons',
        'frames'        => 'Photocard Frames',
        'image-album'   => 'Image Albums',
        'image-gallery' => 'Gallery Images',
        'slider'        => 'Slider Images'
    ];

    public function index(Request $request)
    {
        $currentFolder = $request->get('folder', 'post');

        if (!array_key_exists($currentFolder, $this->allowedFolders)) {
            $currentFolder = 'post';
        }

        $relativePath = 'assets/images/' . $currentFolder;
        $directory = public_path($relativePath);
        
        $files = [];

        if (File::exists($directory)) {
            foreach (File::files($directory) as $path) {
                $extension = strtolower($path->getExtension());
                if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
                    $files[] = [
                        'basename' => $path->getFilename(),
                        'time'     => $path->getMTime(),
                        'size'     => round($path->getSize() / 1024, 2)
                    ];
                }
            }
        }

        usort($files, function($a, $b) {
            return $b['time'] - $a['time'];
        });

        $files = array_slice($files, 0, 100);

        return view('admin.media.index', [
            'files'          => $files,
            'folders'        => $this->allowedFolders,
            'currentFolder'  => $currentFolder,
            'currentPath'    => $relativePath
        ]);
    }

    public function store(Request $request)
    {
        $folder = $request->input('folder', 'post');
        if (!array_key_exists($folder, $this->allowedFolders)) {
            return response()->json(['error' => 'Invalid Folder'], 400);
        }

        $rules = [
            'file' => 'required|mimes:jpeg,jpg,png,gif,webp,svg|max:10240'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        if ($request->hasFile('file')) {
            try {
                $image = $request->file('file');
                $destinationPath = public_path('assets/images/' . $folder);

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true, true);
                }

                // --- NEW LOGIC: AUTO CONVERT TO WEBP FOR 'POST' FOLDER ---
                if ($folder === 'post') {
                    // 1. Get original filename without extension
                    $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    
                    // 2. Create new name with .webp extension
                    $newName = time() . '-' . $filename . '.webp';
                    
                    // 3. Convert and Save
                    // '75' is the quality (0-100). 75 is a good balance.
                    Image::make($image)->encode('webp', 75)->save($destinationPath . '/' . $newName);
                } 
                else {
                    // --- STANDARD UPLOAD FOR OTHER FOLDERS ---
                    $name = time() . '-' . $image->getClientOriginalName();
                    $image->move($destinationPath, $name);
                }
                
                return response()->json(['success' => 'Image Uploaded Successfully']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Server Error: ' . $e->getMessage()], 500);
            }
        }
        
        return response()->json(['error' => 'No file received'], 400);
    }

    public function replace(Request $request)
    {
        $folder = $request->input('folder', 'post');
        if (!array_key_exists($folder, $this->allowedFolders)) {
            return response()->json(['error' => 'Invalid Folder'], 400);
        }

        $rules = [
            'file'     => 'required|mimes:jpeg,jpg,png,gif,webp,svg|max:10240',
            'filename' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        if ($request->hasFile('file')) {
            try {
                $image = $request->file('file');
                $name = $request->filename; 

                // Security Check
                if(basename($name) !== $name) {
                    return response()->json(['error' => 'Security Error: Invalid Filename'], 400);
                }
                
                $destinationPath = public_path('assets/images/' . $folder);

                // NOTE: We do NOT convert to WebP on replace. 
                // Why? If we replace 'image.jpg' with a converted 'image.webp', 
                // the file extension changes and the original link (image.jpg) becomes 404.
                // Replace must strictly overwrite the file as is.
                $image->move($destinationPath, $name);
                
                return response()->json(['success' => 'Image Replaced Successfully']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Server Error: ' . $e->getMessage()], 500);
            }
        }
        
        return response()->json(['error' => 'No file received'], 400);
    }

    public function delete(Request $request)
    {
        $folder = $request->input('folder', 'post');
        if (!array_key_exists($folder, $this->allowedFolders)) {
            return response()->json(['status' => false, 'message' => 'Invalid Folder']);
        }

        $filename = $request->filename;
        $filePath = public_path('assets/images/' . $folder . '/' . $filename);

        if (File::exists($filePath)) {
            try {
                File::delete($filePath);
                return response()->json(['status' => true, 'message' => 'File Deleted Successfully']);
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => 'Permission Denied']);
            }
        }

        return response()->json(['status' => false, 'message' => 'File Not Found']);
    }
}