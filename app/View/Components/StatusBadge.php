<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    public string $text = '';
    public string $style = '';

    /**
     * Create a new component instance.
     */
    public function __construct(String $text)
    {
        $this->text = static::getFormattedStatusText($text);
        $this->style = static::getStyle($text);
    }

    protected function getFormattedStatusText(string $text): string
    {
        return __(ucfirst($text));
    }

    protected function getStyle(string $text): string
    {
        return match ($text) {
            Post::STATUS_PUBLISHED => 'border-green-500 text-green-500',
            Post::STATUS_REJECTED => 'border-red-500 text-red-500',
            Post::STATUS_PENDING => 'border-yellow-500 text-yellow-500',
            Post::STATUS_DRAFT => '',
            default => '',
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.status-badge');
    }
}
