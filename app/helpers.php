<?php 

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Str;


if(!function_exists('formatDate'))
{
    /**
     * format date
     */
    function formatDate($date, $opt="fulldate")
    {
        return match($opt) {
            default => '',
            'dateInput' => date('Y-m-d'),
            'fulldate' => date('F d,Y', strtotime($date)),
            'dateTime' => date('M d,Y h:iA', strtotime($date)),
            'dateTimeWithSeconds' => date('Y-m-d h:i:s', strtotime($date)),
            'dateTimeLocal' => date('Y-m-d\TH:i', strtotime($date)),
            'time' => date('h:iA', strtotime($date)),
        };
    }

}

if(!function_exists('getAge'))
{
    /**
     * get the age by birth date
     */
     function getAge($birth_date)
    {
        return Carbon::parse($birth_date)->age;
    }

}


if(!function_exists('getDateDiff'))
{
    /**
     * get the difference of two dateTime
     */
    function getDateDiff($startdate,$enddate){


        if($startdate && $enddate) {

            $startTime = Carbon::parse($startdate);
            $endTime = Carbon::parse($enddate);
    
            $totalDuration =  $startTime->diff($endTime)->format('%d');
    
            return $totalDuration;
        }

        return '';
     
    }
}


if(!function_exists('handleNullAvatar'))
{
    /**
     * handle Null Avatar Image
     */
    function handleNullAvatar($img)
    {
        return $img ?? '/img/noimg.svg';
    }
}


if(!function_exists('handleNullImage'))
{
    /**
     * handle Null Image
     */
    function handleNullImage($img)
    {
        return $img ?? '/img/noimg.png';
    }
}

if(!function_exists('handleNullFeaturedPhoto'))
{
    /**
     * handle Null Image
     */
    function handleNullFeaturedPhoto($img)
    {
        return $img ?? '/img/image_not_found.svg';
    }
}


if(!function_exists('handleOrderStatus'))
{
     /**
     * handle the order status
     */
    function handleOrderStatus($bool)
    {
        return match($bool) {
            0 => "<span class='badge badge-info'>Pending <i class='fas fa-spinner ml-1'></i></span>",
            1 => "<span class='badge badge-success'>Approved <i class='fas fa-check-circle ml-1'></i></span>",
            2 => "<span class='badge badge-danger'>Rejected <i class='fas fa-times-circle ml-1'></i></span>",
            3 => "<span class='badge badge-info'>On Delivery <i class='fas fa-shipping-fast ml-1'></i></span>",
            4 => "<span class='badge badge-success'>Delivered <i class='fas fa-check-circle ml-1'></i></span>",
            5 => "<span class='badge badge-danger'>Canceled <i class='fas fa-times-circle ml-1'></i></span>",
        };
    }

}

if(!function_exists('handleOrderStatusTextOnly'))
{
     /**
     * handle the order status
     */
    function handleOrderStatusTextOnly($bool)
    {
        return match($bool) {
            0 => "<span class='badge badge-info'>Pending <i class='fas fa-spinner ml-1'></i></span>",
            1 => "<span class='badge badge-success'>Approved <i class='fas fa-check-circle ml-1'></i></span>",
            2 => "<span class='badge badge-danger'>Rejected <i class='fas fa-times-circle ml-1'></i></span>",
            3 => "<span class='badge badge-info'>On Delivery <i class='fas fa-shipping-fast ml-1'></i></span>",
            4 => "<span class='badge badge-success'>Delivered <i class='fas fa-check-circle ml-1'></i></span>",
        };
    }

}

if(!function_exists('displayImageByOrderStatus'))
{
     /**
     * display order status image
     */
    function displayImageByOrderStatus($bool)
    {
        return match($bool) {
            0 => "<img class='img-fluid d-block mx-auto' src='/img/order/pending.svg' alt='pending'>",
            1 => "<img class='img-fluid d-block mx-auto' src='/img/order/approved.svg' alt='approved'>",
            2 => "<img class='img-fluid d-block mx-auto' src='/img/order/rejected.png' alt='rejected'>",
        };
    }

}


if (!function_exists('getOrderMonths')) {
    /**
     * get all the months on the orders table
     */
    function getOrderMonths()
    {
        \DB::statement("SET SQL_MODE=''"); // set the strict to false

        return Order::selectRaw("
        month(created_at) as month_no, 
        DATE_FORMAT(created_at, '%M-%Y') AS new_date,
        YEAR(created_at) AS year,
        monthname(created_at) AS month"
        )
        ->groupBy('new_date')       
        ->orderByRaw('month_no')
        ->get('month');
    }
}
if (!function_exists('getOrderYears')) {
    /**
     * get all the years on the orders table
     */
    function getOrderYears()
    {
        \DB::statement("SET SQL_MODE=''"); // set the strict to false

        return Order::selectRaw("
        DATE_FORMAT(created_at, '%M-%Y') AS new_date,
        YEAR(created_at) AS year,
        monthname(created_at) AS month"
        )
        ->groupBy('year')       
        ->orderByRaw('year')
        ->get('month');
    }
}


if(!function_exists('isLikedByAuthUser'))
{
     /**
     * check if this model is liked by authenticated user
     */
    function isLikedByAuthUser($auth_user, $likers) 
    {
        $post_likers = [];// users who likes the post

        foreach($likers as $liker) {
        $post_likers[] = $liker->user_id; // get user id 
        }

        return  (in_array($auth_user, $post_likers)) ? true : false; // check if the user has already liked the post
    }
}



if(!function_exists('isOnline'))
{
     /**
     * check if the payment method status is approved
     */
    function isOnline($bool)
    {
        return $bool  ? "<span class='badge badge-success'>Online <i class='fas fa-check-circle ml-1'></i></span>" : "<span class='badge badge-danger'>Offline</span>";
    }

}

if(!function_exists('isVerified'))
{
     /**
     * check if the user email is verified
     */
    function isVerified($bool)
    {
        return $bool  ? "<span class='badge badge-success'>Verified <i class='fas fa-check-circle ml-1'></i></span>" : "<span class='badge badge-danger'>Unverified</span>";
    }
}


if(!function_exists('isActivated'))
{
     /**
     * check if the status is approved
     */
    function isActivated($bool)
    {
        return $bool == 0 
        ? "<span class='badge bg-danger text-white'>Deactivated <i class='fas fa-times-circle ml-1'></i></span>"
        : "<span class='badge bg-success text-white'>Activated <i class='fas fa-check-circle ml-1'></i></span>";
    }

}


if(!function_exists('isApproved'))
{
     /**
     * check if the status is approved
     */
    function isApproved($bool)
    {
        if ($bool == 0) {
            return "<span class='badge bg-info p-2'>Pending <i class='fas fa-spinner ms-2'></i></span>";
        } else if($bool == 1) {
            return "<span class='badge bg-success p-2'>Approved</span>";
        } else {
            return "<span class='badge bg-danger p-2'>Declined</span>";
        }
    }

}

if(!function_exists('textTruncate')) 
{

    /**
     * truncate text of a string
     */
    function textTruncate($string, $length = 200)
    {
        return Str::limit($string, $length, '...');
    }
}