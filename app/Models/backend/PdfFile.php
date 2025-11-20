<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfFile extends Model
{
    use HasFactory;

    protected $fillable = [
        "pdf_file_title_hi",
        "pdf_file_title_en",
        "pdf_page_id",
        "short_description_hi",
        "short_description_en",
        "file_status",
        "pdf_file",
        "file_language",
        "thumbnail",
        "downloads"
    ];
}
