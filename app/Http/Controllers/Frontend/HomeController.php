<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\CartHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\FeedbackRequest;
use App\Models\Backend\Blog;
use App\Models\Backend\BlogCategory;
use App\Models\Backend\Brand;
use App\Models\Backend\Category;
use App\Models\Backend\Comment;
use App\Models\Backend\Coupon;
use App\Models\Backend\Faq;
use App\Models\Backend\Feedback;
use App\Models\Backend\Information;
use App\Models\Backend\Room;
use App\Models\Backend\Service;
use App\Models\Frontend\Order;
use App\Models\Frontend\Rating;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function __construct()
    {
        View::composer('*', function ($view) {
            $brands = Brand::take(6)->orderBy('position', 'asc')->get();
            $info = Information::get()->first();

            $view->with([
                'brands' => $brands,
                'info' => $info
            ]);
        });
    }

    public function index()
    {
        $rooms = Room::latest()->take(6)->get();

        $all_rooms = Room::all();

        $services = Service::take(6)->get();

        $feedbacks = Feedback::take(4)->get();

        $info = Information::get()->first();

        return view('frontend.home', compact('rooms', 'all_rooms', 'services', 'feedbacks', 'info'));
    }

    public function category(Request $request)
    {
        $params = $request->all();

        $all_rooms = Room::select('price')->get()->toArray();

        // Get max and min price
        $max_price = max($all_rooms);

        $max_price = $max_price['price'];

        $min_price = min($all_rooms);

        $min_price = $min_price['price'];

        $rooms = Room::filter($params)->filterPrice()->paginate(4);

        $categories = Category::all();

        return view('frontend.pages.category', compact('rooms', 'categories', 'max_price', 'min_price'));
    }

    public function categoryAjax()
    {
        $rooms = Room::sortBy()->get();

        $html = view('frontend.pages.category-ajax')->with('rooms', $rooms)->render();

        return response()->json(['status' => 'success', 'html' => $html]);
    }

    public function room($slug)
    {
        $room = Room::where('slug', $slug)->first();

        $ratings = Rating::where('room_id', $room->id)->latest()->get();

        $total_ratings = $ratings->count();

        $rating_avg = $ratings->avg('star');

        return view('frontend.pages.room-detail', compact('room', 'ratings', 'total_ratings', 'rating_avg'));
    }

    function checkUserBooking($orders, $request)
    {
        if ($orders) {
            foreach ($orders as $order) {
                if ($order) {
                    foreach ($order->orderDetails as $item) {
                        if ($item->room_id == $request->room_id) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    public function rating(Request $request)
    {

        $orders = Order::where('user_id', $request->user_id)->get();

        $check_user_booking = $this->checkUserBooking($orders, $request);

        // Check user was booking room
        if ($check_user_booking) {
            // Check user was rating
            $check_review_exits = Rating::where($request->only('user_id', 'room_id'))->first();

            if ($check_review_exits) {
                // Update review
                $check_review_exits->update($request->only('star', 'message'));

                // return response()->json(['status' => true, 'message' => 'Your rating has been updated !']);

                return redirect()->back()->with('success', 'Your rating has been updated !');
            } else {
                // Add new review
                $review = Rating::addRating($request);

                if ($review) {
                    // return response()->json(['status' => true, 'message' => 'Your rating  has been added !']);

                    return redirect()->back()->with('success', 'Your rating  has been added !');
                } else {
                    return redirect()->back()->with('error', 'Your rating have a problem !');
                }
            }
        }

        // User wasn't booking room
        return redirect()->back()->with('error', 'You must booking room first to rate !');

        // return response()->json(['status' => false, 'message' => 'You must booking room first to rate']);
    }

    public function sortRating(Request $request)
    {

        $ratings = Rating::sort($request->sort_by)->get();

        $html = view('frontend.pages.sort-ratings')->with('ratings', $ratings)->render();

        return response()->json(['success' => true, 'html' => $html]);
    }

    // Blog method
    public function blog(Request $request)
    {
        $params = $request->all();

        $blogs = Blog::latest()->filter($params)->paginate(4);

        $new_blogs = Blog::latest()->take(3)->get();

        $new_blog_categories = BlogCategory::latest()->take(3)->get();

        return view('frontend.pages.blogs', compact('blogs', 'new_blogs', 'new_blog_categories'));
    }

    // Blog detail method
    public function blogDetail($slug, Request $request)
    {
        $params = $request->all();

        $blog = Blog::where('slug', $slug)->first();

        $comments = $blog->comment()->latest()->get();

        $total_comments = $comments->count();

        $new_blogs = Blog::latest()->take(3)->where('slug', '<>', $slug)->get();

        $new_blog_categories = BlogCategory::latest()->take(3)->get();

        return view('frontend.pages.blog-details', compact('blog', 'new_blogs', 'new_blog_categories', 'comments', 'total_comments'));
    }

    // Comment method
    public function comment()
    {
        // Add new comment
        $comment = Comment::addComment();

        if ($comment) {
            return redirect()->back()->with('success', 'Your rating  has been added !');
        } else {
            return redirect()->back()->with('error', 'Your rating have a problem !');
        }
    }

    public function sortComment(Request $request)
    {
        $comments = Comment::sort($request->sort_by)->get();

        $html = view('frontend.pages.sort-comments')->with('comments', $comments)->render();

        return response()->json(['success' => true, 'html' => $html]);
    }

    public function profile()
    {
        $user = Auth::user();

        return view('frontend.pages.profile', compact('user'));
    }

    public function updateProfile(Request $request, UploadService $uploadService, User $user)
    {
        $user_id = Auth::user()->id;

        $user_update = $user->find($user_id);

        if ($request->hasFile('image_avt')) {
            $category_name = $request->name;

            $file = $request->file('image_avt');

            // Method Upload
            $path = 'uploads/avatars';
            $image_name = $uploadService->uploadImageHandler($file, $category_name, $path);

            // Merge field image -> request
            $request->merge(['avatar' => $image_name]);
        }


        // dd($user_update);

        $user_update = $user_update->update($request->all());

        if ($user_update) {
            return redirect()->back()->with('success', 'Update profile successfully !');
        } else {
            return redirect()->back()->with('success', 'Update profile failed !');
        }
    }

    function checkUsedOnlyOne($orders, $coupon_id)
    {
        if ($orders) {
            foreach ($orders as $order) {
                if ($order->coupon_id == $coupon_id) {
                    return true;
                }
            }
        }

        return false;
    }

    public function checkCoupon(Request $request, Coupon $coupon, CartHelper $cart)
    {
        if ($request->ajax()) {
            $code = $request->code;

            $total_amount = $request->total_amount;

            $check_coupon_exits = $coupon->findByCode($code);

            // Check life time coupon
            $check_expiration_date = $check_coupon_exits->checkExpirationDate()->first();

            // Check status
            $check_status = $check_coupon_exits->status;

            // check each person is only used once
            $user_id = Auth::user()->id;
            $orders = Order::where('user_id', $user_id)->get();
            $check_used_one = $this->checkUsedOnlyOne($orders, $check_coupon_exits->id);

            if ($check_coupon_exits->limit > 0 && $check_expiration_date && !$check_used_one && $check_status == 1 && $check_coupon_exits->min_price >= $total_amount) {

                // Remove old session coupon
                $request->session()->forget('coupon');

                // Add new session coupon
                $request->session()->push('coupon', $request->code);

                // Get percent discount
                $percent = $check_coupon_exits->percent;

                if ($request->page == 'checkout') {
                    $total = $request->total_amount;
                } else {
                    $total = $cart->getTotalAmount();
                }

                $discount = ($total * $percent) / 100;

                $total_amount = $total - $discount;

                return response()->json(['type' => 'success', 'discount' => $discount, 'total_amount' => $total_amount, 'coupon_id' => $check_coupon_exits->id]);
            } else {
                // Remove old session coupon
                $request->session()->forget('coupon');

                // Send error
                return response()->json(['type' => 'error', 'message' => 'Coupon invalid !'])->setStatusCode(500);
            }
        }
    }

    public function contact()
    {
        $info = Information::get()->first();

        return view('frontend.pages.contact', compact('info'));
    }

    public function sendMessage(FeedbackRequest $request)
    {
        $feedback = Feedback::create($request->all());

        if ($feedback) {
            return redirect()->back()->with('success', 'You have feedback successfully');
        }

        return redirect()->back()->with('error', 'Your feedback have a problem');
    }

    public function services()
    {
        $services = Service::take(6)->orderBy('position', 'asc')->get();

        $faqs = Faq::take(4)->orderBy('position', 'asc')->get();

        $feedbacks = Feedback::take(4)->get();

        return view('frontend.pages.service', compact('services', 'faqs', 'feedbacks'));
    }

    public function about()
    {

        $total_room = Room::sum('quantity');

        $total_service = Service::all()->count();

        $new_blogs = Blog::take(3)->get();

        $benefits = Service::take(3)->get();

        $feedbacks = Feedback::take(4)->get();

        return view('frontend.pages.about', compact('total_room', 'total_service',  'new_blogs', 'benefits', 'feedbacks'));
    }

    public function selectService(Request $request)
    {
        if ($request->ajax()) {
            $total_service_price = $request->total_service_price;

            $total = $request->total_amount;

            $total_amount = $total + $total_service_price;

            // Success
            return response()->json(['type' => 'success', 'total_amount' => $total_amount]);
        } else {
            // Send error
            return response()->json(['type' => 'error', 'message' => 'Coupon invalid !'])->setStatusCode(500);
        }
    }
}
