<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsletterSubscriberController extends Controller
{
    public function index(Request $request)
    {
        $searchInput = $request->query('search', '');
        $search = is_string($searchInput) ? trim(substr($searchInput, 0, 254)) : '';
        $query = NewsletterSubscriber::query();

        if ($search !== '') {
            $query->where('email', 'like', '%' . $search . '%');
        }

        $subscribers = $query->orderBy('id', 'desc')
            ->paginate(20)
            ->appends(['search' => $search]);

        $totalSubscribers = NewsletterSubscriber::count();

        return view('admin.newsletter-subscribers.index', compact('subscribers', 'totalSubscribers', 'search'));
    }

    public function create()
    {
        return view('admin.newsletter-subscribers.create');
    }

    public function store(Request $request)
    {
        $this->normalizeEmail($request);

        $data = $request->validate([
            'email' => ['required', 'email:rfc', 'max:254', 'unique:newsletter_subscribers,email'],
        ]);

        NewsletterSubscriber::create($data);

        return redirect()->route('admin.newsletter-subscribers.index')
            ->with('success', 'Newsletter subscriber added successfully.');
    }

    public function edit(NewsletterSubscriber $newsletter_subscriber)
    {
        return view('admin.newsletter-subscribers.edit', [
            'subscriber' => $newsletter_subscriber,
        ]);
    }

    public function update(Request $request, NewsletterSubscriber $newsletter_subscriber)
    {
        $this->normalizeEmail($request);

        $data = $request->validate([
            'email' => [
                'required',
                'email:rfc',
                'max:254',
                Rule::unique('newsletter_subscribers', 'email')->ignore($newsletter_subscriber->id),
            ],
        ]);

        $newsletter_subscriber->update($data);

        return redirect()->route('admin.newsletter-subscribers.index')
            ->with('success', 'Newsletter subscriber updated successfully.');
    }

    public function destroy(NewsletterSubscriber $newsletter_subscriber)
    {
        $newsletter_subscriber->delete();

        return redirect()->route('admin.newsletter-subscribers.index')
            ->with('success', 'Newsletter subscriber deleted successfully.');
    }

    private function normalizeEmail(Request $request)
    {
        if (is_string($request->input('email'))) {
            $request->merge([
                'email' => strtolower(trim($request->input('email'))),
            ]);
        }
    }
}
