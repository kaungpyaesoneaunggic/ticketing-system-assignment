<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{
    use HasFactory;
    public static function fetchOverview()
    {
        return [
            'user_total' => User::count(),
            'category_totals' => Category::withCount('tickets')->get(['name', 'tickets_count']),
            'label_totals' => Label::withCount('tickets')->get(['name', 'tickets_count']),
            'priority_counts' => Ticket::priorityCounts(),
            'status_counts' => Ticket::statusCounts(),
            'opened_count' => Ticket::statusCounts()->get('open', 0),
            'closed_count' => Ticket::statusCounts()->get('closed', 0),
        ];
    }
}
