<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SocialMediaService
{
    /**
     * INSTAGRAM API
     * Requires: Instagram Graph API Token
     * Get token: https://developers.facebook.com/apps/
     */
    public function getInstagramPosts($limit = 3)
    {
        $token = env('INSTAGRAM_ACCESS_TOKEN');
        $userId = env('INSTAGRAM_USER_ID');
        
        if (!$token || !$userId) {
            return $this->getDummyPosts('instagram');
        }
        
        return Cache::remember('instagram_posts', 3600, function () use ($token, $userId, $limit) {
            try {
                $response = Http::get("https://graph.instagram.com/{$userId}/media", [
                    'fields' => 'id,caption,media_type,media_url,permalink,timestamp',
                    'access_token' => $token,
                    'limit' => $limit
                ]);
                
                if ($response->successful()) {
                    return $response->json()['data'];
                }
            } catch (\Exception $e) {
                \Log::error('Instagram API Error: ' . $e->getMessage());
            }
            
            return $this->getDummyPosts('instagram');
        });
    }
    
    /**
     * FACEBOOK API
     * Requires: Facebook Page Access Token
     */
    public function getFacebookPosts($limit = 3)
    {
        $token = env('FACEBOOK_PAGE_TOKEN');
        $pageId = env('FACEBOOK_PAGE_ID');
        
        if (!$token || !$pageId) {
            return $this->getDummyPosts('facebook');
        }
        
        return Cache::remember('facebook_posts', 3600, function () use ($token, $pageId, $limit) {
            try {
                $response = Http::get("https://graph.facebook.com/v18.0/{$pageId}/posts", [
                    'fields' => 'id,message,full_picture,permalink_url,created_time',
                    'access_token' => $token,
                    'limit' => $limit
                ]);
                
                if ($response->successful()) {
                    return $response->json()['data'];
                }
            } catch (\Exception $e) {
                \Log::error('Facebook API Error: ' . $e->getMessage());
            }
            
            return $this->getDummyPosts('facebook');
        });
    }
    
    /**
     * YOUTUBE API
     * Requires: YouTube Data API v3 Key
     * Get key: https://console.cloud.google.com/
     */
    public function getYouTubePosts($limit = 3)
    {
        $apiKey = env('YOUTUBE_API_KEY');
        $channelId = env('YOUTUBE_CHANNEL_ID');
        
        if (!$apiKey || !$channelId) {
            return $this->getDummyPosts('youtube');
        }
        
        return Cache::remember('youtube_posts', 3600, function () use ($apiKey, $channelId, $limit) {
            try {
                $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
                    'part' => 'snippet',
                    'channelId' => $channelId,
                    'maxResults' => $limit,
                    'order' => 'date',
                    'type' => 'video',
                    'key' => $apiKey
                ]);
                
                if ($response->successful()) {
                    return $response->json()['items'];
                }
            } catch (\Exception $e) {
                \Log::error('YouTube API Error: ' . $e->getMessage());
            }
            
            return $this->getDummyPosts('youtube');
        });
    }
    
    /**
     * TWITTER/X API
     * Requires: Twitter API v2 Bearer Token
     * Note: Twitter API is now paid for most tiers
     */
    public function getTwitterPosts($limit = 3)
    {
        $bearerToken = env('TWITTER_BEARER_TOKEN');
        $username = env('TWITTER_USERNAME');
        
        if (!$bearerToken || !$username) {
            return $this->getDummyPosts('twitter');
        }
        
        return Cache::remember('twitter_posts', 3600, function () use ($bearerToken, $username, $limit) {
            try {
                // First get user ID
                $userResponse = Http::withToken($bearerToken)
                    ->get("https://api.twitter.com/2/users/by/username/{$username}");
                
                if ($userResponse->successful()) {
                    $userId = $userResponse->json()['data']['id'];
                    
                    // Then get tweets
                    $response = Http::withToken($bearerToken)
                        ->get("https://api.twitter.com/2/users/{$userId}/tweets", [
                            'max_results' => $limit,
                            'tweet.fields' => 'created_at,text'
                        ]);
                    
                    if ($response->successful()) {
                        return $response->json()['data'];
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Twitter API Error: ' . $e->getMessage());
            }
            
            return $this->getDummyPosts('twitter');
        });
    }
    
    /**
     * TIKTOK - No Official API for Feed
     * Alternative: Use RSS or manual embed
     */
    public function getTikTokPosts($limit = 3)
    {
        // TikTok doesn't have public feed API
        // Return dummy/manual posts
        return $this->getDummyPosts('tiktok');
    }
    
    /**
     * Fallback dummy posts
     */
    private function getDummyPosts($platform)
    {
        $links = [
            'instagram' => 'https://www.instagram.com/polresbangkalan/',
            'facebook' => 'https://www.facebook.com/humasPolresBKL',
            'youtube' => 'https://www.youtube.com/@humaspolresbangkalan',
            'twitter' => 'https://x.com/HumasResBKL',
            'tiktok' => 'https://www.tiktok.com/@polresbangkalan',
        ];
        
        return [
            [
                'caption' => 'Kunjungi halaman ' . ucfirst($platform) . ' kami untuk update terbaru',
                'link' => $links[$platform] ?? '#',
                'image' => 'https://via.placeholder.com/400x400/1a1a1a/ffffff?text=' . strtoupper($platform)
            ],
            [
                'caption' => 'Follow akun resmi Polres Bangkalan',
                'link' => $links[$platform] ?? '#',
                'image' => 'https://via.placeholder.com/400x400/dc3545/ffffff?text=Follow+Us'
            ],
            [
                'caption' => 'Informasi terbaru setiap hari',
                'link' => $links[$platform] ?? '#',
                'image' => 'https://via.placeholder.com/400x400/198754/ffffff?text=Latest+News'
            ],
        ];
    }
}
