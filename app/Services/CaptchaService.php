<?php

namespace App\Services;

use Illuminate\Support\Str;

class CaptchaService
{
    public static function generate()
    {
        $code = strtoupper(Str::random(5));
        session(['captcha_answer' => $code]);

        $width = 150;
        $height = 50;

        $svg = '<svg width="'.$width.'" height="'.$height.'" xmlns="http://www.w3.org/2000/svg">';

        // Background
        $svg .= '<rect width="100%" height="100%" fill="#f0fdf4"/>'; // emerald-50

        // Noise lines
        for ($i = 0; $i < 5; $i++) {
            $x1 = rand(0, $width);
            $y1 = rand(0, $height);
            $x2 = rand(0, $width);
            $y2 = rand(0, $height);
            $stroke = rand(1, 2);
            $color = '#'.dechex(rand(0xAAAAAA, 0xCCCCCC));
            $svg .= '<line x1="'.$x1.'" y1="'.$y1.'" x2="'.$x2.'" y2="'.$y2.'" stroke="'.$color.'" stroke-width="'.$stroke.'"/>';
        }

        // Text
        $x = 20;
        for ($i = 0; $i < strlen($code); $i++) {
            $char = $code[$i];
            $angle = rand(-20, 20);
            $y = rand(30, 40);
            $color = '#'.dechex(rand(0x047857, 0x065F46)); // emerald-700/800
            $svg .= '<text x="'.$x.'" y="'.$y.'" font-family="Arial, sans-serif" font-size="24" font-weight="bold" fill="'.$color.'" transform="rotate('.$angle.','.$x.','.$y.')">'.$char.'</text>';
            $x += 25;
        }

        $svg .= '</svg>';

        return 'data:image/svg+xml;base64,'.base64_encode($svg);
    }

    public static function verify($input)
    {
        return strtolower($input) === strtolower(session('captcha_answer'));
    }
}
