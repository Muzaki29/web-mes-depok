<?php

namespace App\Services;

use App\Models\LetterCounter;
use App\Models\LetterTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LetterNumberingService
{
    public function issueNumber(LetterTemplate $template): string
    {
        $period = $this->period($template->reset_cycle);

        return DB::transaction(function () use ($template, $period) {
            $counter = LetterCounter::lockForUpdate()->firstOrCreate(
                ['template_id' => $template->id, 'period' => $period],
                ['current_seq' => 0]
            );
            $seq = $counter->current_seq + 1;
            $counter->current_seq = $seq;
            $counter->save();

            return $this->format($template->numbering_pattern, [
                'DEPT' => 'MES',
                'CODE' => $template->code,
                'SEQ' => $seq,
                'YYYY' => now()->format('Y'),
                'MM' => now()->format('m'),
            ]);
        });
    }

    protected function period(string $cycle): string
    {
        return match ($cycle) {
            'month' => now()->format('Y-m'),
            'year' => now()->format('Y'),
            default => 'all',
        };
    }

    protected function format(string $pattern, array $vars): string
    {
        $formatted = $pattern;
        $formatted = preg_replace_callback('/\\{SEQ(?::(\\d+))?\\}/', function ($m) use ($vars) {
            $width = isset($m[1]) ? (int)$m[1] : 3;
            return str_pad((string)$vars['SEQ'], $width, '0', STR_PAD_LEFT);
        }, $formatted);
        foreach ($vars as $k => $v) {
            $formatted = str_replace('{'.$k.'}', (string)$v, $formatted);
        }
        return Str::upper($formatted);
    }
}

