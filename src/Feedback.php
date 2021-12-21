<?php

namespace FredBradley\Feedback;

use FredBradley\Feedback\Models\FeedbackRecord;
use FredBradley\Feedback\Models\FeedbackSite;
use Illuminate\Http\Request;

class Feedback
{
    /**
     * @param  array  $feedback
     * @param  string|null  $furtherComments
     *
     * @return void
     */
    public function add(array $feedback, string $furtherComments = null)
    {
        $site = FeedbackSite::firstOrCreate([
            'name' => config('app.name'),
            'url' => config('app.url'),
        ]);

        $feedback = FeedbackRecord::create([
            'site_id' => $site->id,
            'feedback' => $feedback,
            'client_meta' => $this->getClientMeta(request()),
            'other_comments' => $furtherComments,
        ]);

        return $feedback;
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
            'UserID' => $authID,
        ];
    }
}
