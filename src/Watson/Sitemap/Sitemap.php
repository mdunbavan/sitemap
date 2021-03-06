<?php namespace Watson\Sitemap;

use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class Sitemap
{
	protected $sitemaps = array();

	protected $tags = array();

	/**
	 * Add new sitemap to the sitemaps index.
	 *
	 * @param  string  $loc
	 * @param  string  $lastmod
	 * @return void
	 */
	public function addSitemap($loc, $lastmod = null)
	{
		if ($lastmod)
		{
			$lastmod = Carbon::parse($lastmod)->toDateTimeString();
		}

		$this->sitemaps[] = compact('loc', 'lastmod');
	}

	/**
	 * Retrieve the array of sitemaps.
	 *
	 * @return array
	 */
	public function getSitemaps()
	{
		return $this->sitemaps;
	}

	/**
	 * Render an index of of sitemaps.
	 *
	 * @return Illuminate\Support\Facades\Response;
	 */
	public function renderSitemapIndex()
	{
		return Response::view('sitemap::sitemaps', array('sitemaps' => $this->sitemaps), 200, array('Content-type' => 'text/xml'));
	}

	/**
	 * Add a new sitemap tag to the sitemap.
	 *
	 * @param  string  $loc
	 * @param  string  $lastmod
	 * @param  string  $changefreq
	 * @param  string  $priority
	 * @return void
	 */
	public function addTag($loc, $lastmod = null, $changefreq = null, $priority = null)
	{
		if ($lastmod)
		{
			$lastmod = Carbon::parse($lastmod)->toDateTimeString(); 
		}

		$this->tags[] = compact('loc', 'lastmod', 'changefreq', 'priority');
	}

	/**
	 * Retrieve the array of tags.
	 *
	 * @return array
	 */
	public function getTags()
	{
		return $this->tags;
	}

	/**
	 * Render a sitemap.
	 *
	 * @return Illuminate\Support\Facades\Response;
	 */
	public function renderSitemap()
	{
		return Response::view('sitemap::sitemap', array('tags' => $this->tags), 200, array('Content-type' => 'text/xml'));
	}
}
