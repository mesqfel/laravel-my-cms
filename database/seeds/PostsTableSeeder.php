<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $posts = array();
        $posts[] = [
        			'user_id' => 1,
        			'category_id' => 4,
        			'photo_id' => 1,
        			'title' => 'How PHP Will Fare In 2017?',
        			'body' => '<p>For the PHP community, the best news in 2016 was the release of version 7.1. While many initially saw PHP 7.1 as a minor release with bug fixes, it proved to be a whole different beast altogether. The version offered important improvements, a new return type (void) and Multi Catch Exception Handling.</p>
<p>This year, I went to the PHP community and asked about the general feelings and expectations about the trends that would dominate the PHP world in 2017. Essentially, I asked three questions in the Reddit thread:</p>
<ul>
<li>What was the best thing that happened to PHP in 2016?</li>
<li>What does the community thinks of PHP 7 and 7.1?</li>
<li>What is the best PHP framework?</li>
</ul>
<p>In addition, I asked about the community&rsquo;s response on the issue of official termination of support for PHP 5.6.</p>
<p>In addition to the Reddit, I also posed these questions via email to several community influencers. I received the following responses:</p>
<p>Cal Evans, Technical Manager at Zend Technologies and godfather of the PHP community responded:</p>
<blockquote>
<p>Versions 7 and 7.1 of PHP are not the revolutionary changes that we got in the later 5.x versions. They are however proof that PHP has stabilized, matured, and has a predictable path forward.</p>
</blockquote>
<p>In response to the question about the frameworks, Evans was very clear.</p>
<blockquote>
<p>Frameworks exist only to make developers lives better. Some developers won&rsquo;t want to sweat the details, they want to just get things done. There is nothing wrong with this and frameworks like Laravel will always exist to fill this need. In our ecosystem, Laravel stands above all others with the tooling and ecosystem built around it to help developers just get things done.</p>
</blockquote>
<p>Alex Makarov, a major contributor to Yii offered a personal insight for the question about PHP version 7+.</p>
<blockquote>
<p>While 7.0 was excellent revolutionary release, there was design issue with return types and returning null preventing me from using it. 7.1 added nullable types and now I&rsquo;m happy.</p>
</blockquote>
<p>When talking about favorite PHP framework, Makarov added:</p>
<blockquote>
<p>Depends on what is the definition of &ldquo;the best&rdquo;. If we&rsquo;re talking about &ldquo;most popular in US&rdquo; then it should be Laravel. If it&rsquo;s &ldquo;most popular in ex-USSR and asia&rdquo; then it&rsquo;s Yii. If we&rsquo;re talking about enterprise level support, that&rsquo;s Symfony without any doubt. If it&rsquo;s about features and performance, Yii has more out of the box.</p>
</blockquote>
<p>Stefan Koopmanschap, cofounder of PHPBenelux loved PHP 7+.</p>
<blockquote>
<p>I love it. I think it is a great step in the development of the language, PHP is a seriously mature language now, which can easily compete with other languages. And it&rsquo;s being used for highly scalable and business-critical applications.</p>
</blockquote>
<p>His response on the question of favorite framework echoed the sentiments of &ldquo;framework-independent&rdquo; developers.</p>
<blockquote>
<p>There is no best framework. There is a best fit for every use case. Symfony, Laravel, Zend Framework, Yii, Expressive, Silex, Slim, the list is endless, and each of the frameworks has a place. Which framework fits your use case depends on the requirements of the application, the developers you have on your team, the infrastructure it will be running on, and a lot of other factors.</p>
</blockquote>
<p>I would like to start discussing the Reddit poll with the comment by the Reddit user leeharris100, that sums up the PHP trends for 2017 very succinctly:</p>
<blockquote>
<p>This is why I think PHP will continue to be popular for a long time to come. It&rsquo;s easy to make applications of any size and scope. There is documentation and support for every single problem you could ever think of. And it&rsquo;s finally hit the point where performance is mostly acceptable.</p>
</blockquote>
<p><em>Originally posted by Cloudways at <a href="https://dev.to/cloudways/how-php-will-fare-in-2017" target="_blank" rel="noopener noreferrer">https://dev.to/cloudways/how-php-will-fare-in-2017</a></em></p>',
					'created_at' => '2017-04-09 21:00:48',
					'slug' => 'how-php-will-fare-in-2017'
        		   ];

        foreach ($posts as $post) {
            DB::table('posts')->insert($post);	
        }
    }
}
