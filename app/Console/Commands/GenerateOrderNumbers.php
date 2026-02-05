<?php

namespace App\Console\Commands;

use App\Models\Transport;
use Illuminate\Console\Command;

class GenerateOrderNumbers extends Command
{
    protected $signature = 'transports:generate-order-nos';
    protected $description = 'Generate unique order numbers for existing transports';

    public function handle()
    {
        $transports = Transport::orderBy('id', 'asc')->get();
        $counter = 0;

        foreach ($transports as $transport) {
            if (empty($transport->order_no)) {
                $transport->order_no = $this->generateOrderNo($transport->id);
                $transport->save();
                $counter++;
            }
        }

        $this->info("Generated order numbers for {$counter} transports.");
        return 0;
    }

    private function generateOrderNo($id)
    {
        $prefix = 'TR';
        $number = str_pad($id, 3, '0', STR_PAD_LEFT);
        return $prefix . $number;
    }
}
