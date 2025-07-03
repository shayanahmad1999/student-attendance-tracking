<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AutomatedAttendanceReportExporter;
use App\Mail\SendAttendanceReportMail;

class SendAttendanceReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:send-report {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily or weekly attendance report via email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        if ($type == 'daily') {
            $startDate = $yesterday;
            $endDate = $today;
        } elseif ($type == 'weekly') {
            $startDate = $today->copy()->startOfWeek();
            $endDate = $today->copy()->endOfWeek();
        } else {
            $this->error('Invalid type of report');
            return;
        }

        $fileName = "attendance_report_{$type}.xlsx";
        $filePath = "attendance_reports/{$fileName}";
        $fullPath = storage_path("app/public/{$filePath}");

        Excel::store(new AutomatedAttendanceReportExporter($startDate, $endDate), $filePath, 'public');

        Mail::to(config('app.send_email'))->send(new SendAttendanceReportMail($type, $fullPath, $filePath));

        $this->info("{$type} attendance report has been sent successfully!");
    }
}
