<?php
namespace App\OnboardingService;
use Illuminate\Support\Facades\DB;
use App\Models\InitialEnquiry;

class InitialEnquiryService
{
    public function save(array $data): InitialEnquiry
    {
       return InitialEnquiry::create($data);

    }
}
