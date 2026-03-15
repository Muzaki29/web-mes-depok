<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function download(string $slug)
    {
        $document = Document::where('slug', $slug)->firstOrFail();
        if (! Gate::allows('download-document', $document)) {
            abort(403);
        }
        $disk = 'public';
        if (! Storage::disk($disk)->exists($document->path)) {
            abort(404);
        }
        $downloadName = $document->title;
        $ext = pathinfo($document->path, PATHINFO_EXTENSION);
        if ($ext && ! str_ends_with(strtolower($downloadName), '.'.strtolower($ext))) {
            $downloadName .= '.'.$ext;
        }

        return response()->download(Storage::disk($disk)->path($document->path), $downloadName);
    }
}
