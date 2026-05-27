<?php

namespace App\Support;

use Illuminate\Support\HtmlString;

class ChatMarkdown
{
    public static function render(?string $text): HtmlString
    {
        $html = e($text ?? '');

        $html = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $html);
        $html = preg_replace('/\*(.+?)\*/s', '<em>$1</em>', $html);
        $html = nl2br($html);

        return new HtmlString($html);
    }
}
