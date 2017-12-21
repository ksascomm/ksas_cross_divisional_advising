<?php
/**
* The default template for displaying news via the hub's api
*
* @package FoundationPress
* @since FoundationPress 1.0.0
*/
?>
<h1 class="hub-title">Related News from <a href="https://hub.jhu.edu/">The Hub</a></h1>
<?php
$hub_url = 'https://api.hub.jhu.edu/topics/36/articles?v=1&key=bed3238d428c2c710a65d813ebfb2baa664a2fef&per_page=3';
//if ( false === ( $hub_call = get_transient( 'flagship_hub_query' ) ) ) {
	$hub_call = wp_remote_get($hub_url);
//set_transient( 'flagship_hub_query', $hub_call, 86400 ); }
$hub_results = json_decode($hub_call['body'], true);
$hub_articles = $hub_results['_embedded'];
foreach ($hub_articles['articles'] as $hub_article ) { ?>
<article class="hub-article" itemscope itemtype="http://schema.org/BlogPosting" aria-labelledby="post-<?php echo $hub_article['id'];?>">
	<header class="article-header">
		<?php $date = $hub_article['publish_date'];?>
		<time class="byline" datetime=""><?php echo date('F d, Y', $date);?></time>
		<h1 class="entry-title single-title" itemprop="headline">
			<a href="<?php echo $hub_article['url']; ?>" id="post-<?php echo $hub_article['id'];?>"><?php echo $hub_article['headline']; ?></a>
		</h1>
	</header>
	<div class="entry-content" itemprop="articleBody">
		<img class="float-left news" src="<?php echo $hub_article['_embedded']['image_thumbnail'][0]['sizes']['thumbnail']; ?>" alt="From The Hub: <?php echo $hub_article['headline']; ?>" />
		<summary>
		<p><?php echo $hub_article['subheadline'];
			if (empty($hub_article['subheadline']) ) {
				echo $hub_article['excerpt'];
			} ?>
		</p>
		</summary>
	</div>
	<hr>
</article>
<?php } ?>