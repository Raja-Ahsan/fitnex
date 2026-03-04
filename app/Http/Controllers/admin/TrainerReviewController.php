<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TrainerReview;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerReviewController extends Controller
{
    /**
     * List trainer reviews. Admin approves reviews (status 0 = pending, 1 = approved).
     * Supports AJAX search by reviewer name/email, comment, or trainer name; filter by status.
     */
    public function index(Request $request)
    {
        $page_title = 'Trainer Reviews';
        $query = TrainerReview::with('trainer.user')->orderBy('created_at', 'desc');

        if ($request->filled('status') && $request->status !== 'All') {
            if ($request->status === 'pending') {
                $query->where('status', 0);
            } elseif ($request->status === 'approved') {
                $query->where('status', 1);
            }
        }

        if ($request->filled('search') && $request->search !== '') {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('reviewer_name', 'like', '%' . $term . '%')
                    ->orWhere('reviewer_email', 'like', '%' . $term . '%')
                    ->orWhere('comment', 'like', '%' . $term . '%')
                    ->orWhereHas('trainer.user', function ($uq) use ($term) {
                        $uq->where('name', 'like', '%' . $term . '%')
                            ->orWhere('last_name', 'like', '%' . $term . '%');
                    });
            });
        }

        $reviews = $query->paginate(15)->withQueryString();

        if ($request->ajax()) {
            return (string) view('admin.trainer_review.search', compact('reviews'));
        }

        return view('admin.trainer_review.index', compact('reviews', 'page_title'));
    }

    /**
     * Show a single trainer review.
     */
    public function show($id)
    {
        $review = TrainerReview::with('trainer.user')->findOrFail($id);
        $page_title = 'Review #' . $review->id . ' - ' . $review->reviewer_name;
        return view('admin.trainer_review.show', compact('review', 'page_title'));
    }

    /**
     * Approve a review (admin only). Sets status = 1 so it appears on the trainer's profile.
     */
    public function approve($id)
    {
        $review = TrainerReview::findOrFail($id);
        $review->status = 1;
        $review->save();
        return redirect()->route('admin.trainer_review.index')->with('message', 'Review approved. It will now show on the trainer\'s profile.');
    }

    /**
     * Reject/delete a review (admin only). Optionally soft-delete or set status to rejected.
     */
    public function reject($id)
    {
        $review = TrainerReview::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.trainer_review.index')->with('message', 'Review removed.');
    }
}
