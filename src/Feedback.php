<?php

namespace FredBradley\Feedback;

use FredBradley\Feedback\Models\FeedbackRecord;
use FredBradley\Feedback\Models\FeedbackSite;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Feedback
{
    /**
     * @param  string|null  $url
     *
     * @return \Illuminate\Support\Collection
     */
    public function bySite(string $url = null): Collection
    {
        if (is_null($url)) {
            $url = config('app.url');
        }

        return FeedbackRecord::whereHas('site', function ($query) use ($url) {
            return $query->where('url', '=', $url);
        })->orderByDesc('id')->get();
    }

    /**
     * @param  array  $feedback
     * @param  string|null  $furtherComments
     *
     * @return FeedbackRecord
     */
    public function log(array $feedback, string $furtherComments = null): FeedbackRecord
    {
        $site = FeedbackSite::firstOrCreate([
            'name' => config('app.name', 'unknown'),
            'url'  => config('app.url', 'unknown'),
        ]);

        return FeedbackRecord::create([
            'site_id'        => $site->id,
            'feedback'       => $feedback,
            'client_meta'    => $this->getClientMeta(request()),
            'other_comments' => $furtherComments,
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    private function getClientMeta(Request $request): array
    {
        $authID = optional(auth()->user())->getAuthIdentifier();

        return [
            'UserAgent' => $request->header('user-agent'),
            'UserID'    => $authID,
        ];
    }
}
