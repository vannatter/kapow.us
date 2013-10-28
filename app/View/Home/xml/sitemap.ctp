<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url><loc>http://kapow.us/</loc></url>
<url><loc>http://kapow.us/blog</loc></url>
<url><loc>http://kapow.us/about-us</loc></url>
<url><loc>http://kapow.us/items/this_week</loc></url>
<?php foreach($new_this_week as $i) { ?><url><loc>http://kapow.us/items/<?php echo $this->Common->seoize($i['Item']['id'], $i['Item']['item_name']); ?></loc></url><?php } ?>
<url><loc>http://kapow.us/items/next_week</loc></url>
<?php foreach($new_next_week as $i) { ?><url><loc>http://kapow.us/items/<?php echo $this->Common->seoize($i['Item']['id'], $i['Item']['item_name']); ?></loc></url><?php } ?>
<url><loc>http://kapow.us/creators</loc></url>
<?php foreach($creators as $i) { ?><url><loc>http://kapow.us/creators/<?php echo $this->Common->seoize($i['Creator']['id'], $i['Creator']['creator_name']); ?></loc></url><?php } ?>
<url><loc>http://kapow.us/publishers</loc></url>
<?php foreach($publishers as $i) { ?><url><loc>http://kapow.us/publishers/<?php echo $this->Common->seoize($i['Publisher']['id'], $i['Publisher']['publisher_name']); ?></loc></url><?php } ?>
<url><loc>http://kapow.us/shops</loc></url>
<?php foreach($shops as $i) { ?><url><loc>http://kapow.us/shops/<?php echo $this->Common->seoize($i['Store']['id'], $i['Store']['name']); ?></loc></url><?php } ?>

</urlset>