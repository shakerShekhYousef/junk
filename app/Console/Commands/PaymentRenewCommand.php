<?php

namespace App\Console\Commands;

use App\Mail\SendEmailForPurcahesExpire;
use App\Models\Notification;
use App\Models\Order;
use App\Models\PackagesMember;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class PaymentRenewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'junk:paymentrenew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $packagesfinishedlistafter0d = [];
        $packagesfinishedlistafter2d = [];
        $notificationlist = [];
        $users = User::where('role_id', 4)->get();

        // finish todays packages
        $packages = PackagesMember::where('purchase_status', 'valid')->whereDate('valid_till', today()->toDateString())->get();
        foreach ($packages as $key => $package) {
            $package->purchase_status = "invalid";
            $package->save();
            $packagesfinishedlistafter0d[] = ['email' => $users->where('id', $package->member_id)->first()->email, 'body' => 'Dear <b>' . $users->where('id', $package->member_id)->first()->username() . '</b> your purchase has been expired today you should buy a new package to continue in our junk fitness club'];
            $notificationlist[] = ['notification_type' => 'Purchase expiration', 'member_id' => $package->member_id, 'message' => 'Dear ' . $users->where('id', $package->member_id)->first()->username() . ' your purchase has been expired today you should buy a new package to continue in our junk fitness club'];
        }
        
        // packages finish after tow days
        $packages = PackagesMember::where('purchase_status', 'valid')->whereDate('valid_till', today()->addDays(2)->toDateString())->get();
        foreach ($packages as $key => $package) {
            $packagesfinishedlistafter2d[] = ['email' => $users->where('id', $package->member_id)->first()->email, 'body' => "Dear <b>" . $users->where('id', $package->member_id)->first()->username() . "</b> purchase will expire at <b>" . today()->addDays(2)->toDateString() . "</b> you should buy a new package to continue in our junk fitness club"];
            $notificationlist[] = ['notification_type' => 'Purchase expiration', 'member_id' => $package->member_id, 'message' => 'Dear ' . $users->where('id', $package->member_id)->first()->username() . ' your purchase purchase will expire at <b>' . today()->addDays(2)->toDateString() . '</b> you should buy a new package to continue in our junk fitness club'];
        }
        
        Notification::insert($notificationlist);
        
        foreach ($packagesfinishedlistafter0d as $key => $item) {
            Mail::to($item['email'])->send(new SendEmailForPurcahesExpire($item['body']));
        }

        foreach ($packagesfinishedlistafter2d as $key => $item) {
            Mail::to($item['email'])->send(new SendEmailForPurcahesExpire($item['body']));
        }
        

        // package will finish after two days
        // foreach ($users as $key => $user) {
        //     $packages = $user->packages;

        //     foreach ($packages as $key => $package) {
        //         $packagedate = $package->created_at;
        //         $diffinmonths = Carbon::parse($packagedate)->diffInMonths(today());
        //         $islreadyrenewed = Order::where('package_id', $package->id)->where('member_id', $user->id)->whereDate('created_at', today())->count();
        //         if ($package->type == "1") // one time package
        //         {
        //             // 
        //         } else if ($package->type == "2") // monthly recuring
        //         {
        //             if ($diffinmonths == 1 && $islreadyrenewed == 0) {
        //                 // renew package
        //                 Order::create([
        //                     'package_id' => $package->id,
        //                     'member_id' => $user->id,
        //                     'cost' => $package->cost
        //                 ]);
        //                 // execute payment
        //             }
        //         } else if ($package->type == "3") //3 monthly recuring
        //         {
        //             if ($diffinmonths == 3 && $islreadyrenewed == 0) {
        //                 // renew package
        //                 Order::create([
        //                     'package_id' => $package->id,
        //                     'member_id' => $user->id,
        //                     'cost' => $package->cost
        //                 ]);
        //                 // execute payment
        //             }
        //         } else if ($package->type == "4") //6 monthly recuring
        //         {
        //             if ($diffinmonths == 6 && $islreadyrenewed == 0) {
        //                 // renew package
        //                 Order::create([
        //                     'package_id' => $package->id,
        //                     'member_id' => $user->id,
        //                     'cost' => $package->cost
        //                 ]);
        //                 // execute payment
        //             }
        //         } else if ($package->type == "5") //12 monthly recuring
        //         {
        //             $diffinyears = Carbon::parse($packagedate)->diffInYears(today());
        //             if ($diffinyears == 1 && $islreadyrenewed == 0) {
        //                 // renew package
        //                 Order::create([
        //                     'package_id' => $package->id,
        //                     'member_id' => $user->id,
        //                     'cost' => $package->cost
        //                 ]);
        //                 // execute payment
        //             }
        //         }
        //     }
        // }
    }
}
