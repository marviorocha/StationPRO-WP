<?php
/*
Page: station-pro
*/
?>

<div class="wrap about-wrap">

 


<h1><?php

echo __('Station PRO - Web radio player','piklist') . '&nbsp;'  . piklist::$version;

 ?></h1>
 
<div class="about-text"><?php _e('The most powerful plugin Icecast or Shoutcast player.','piklist'); ?></div>

<div class="piklist-badge">
  <?php printf(__('%sStationPRO%s','piklist'),'<span>','</span>','</br>');?>
  <?php printf(__('Version %s', 'piklist'), piklist::$version); ?>
</div>

<?php if (!empty(piklist_admin::$piklist_dependent)): ?>

    <div class="dependent-on-piklist">

        <h3><?php _e('Currently Powered by Staton Pro', 'piklist'); ?> <?php echo get_bloginfo('name');?></h2>

            <?php $dependencies = piklist_admin::$piklist_dependent; ?>

            <?php foreach ($dependencies as $type => $item): ?>

                <?php if($type == 'theme') : ?>

                    <p>

                        <strong><?php _e('Active Theme', 'piklist');?></strong>: <?php echo ($item[0]);?>

                    </p>

                <?php endif;?>

                <?php if($type == 'plugins') : ?>

                    <p>

                        <?php foreach ($item as $key => $value) : ?>

                            <?php $plugin_list[] = $value['name']; ?>

                        <?php endforeach;?>

                        <strong><?php _e('Active Plugins', 'piklist');?></strong> : <?php echo implode(', ', $plugin_list); ?>

                    </p>

                <?php endif; ?>

            <?php endforeach; ?>

    </div>

<?php endif; ?>

 
<!-- <div class="piklist-social-links">
  <a class="facebook_link" href="http://facebook.com/stationpro">
    <span class="dashicons dashicons-facebook-alt"></span>
  </a>
  <a class="twitter_link" href="http://twitter.com/piklist">
    <span class="dashicons dashicons-twitter"></span>
  </a>
  <a class="google_plus_link" href="https://plus.google.com/u/0/b/108403125978548990804/108403125978548990804/posts">
    <span class="dashicons dashicons-googleplus"></span>
  </a>
</div>.piklist-social-links -->

<div class="section">
  <h2 class="about-headline-callout"><?php _e('<i class="fas fa-broadcast-tower" ></i> The best solution HTML5 Shoutcast & Icecast Radio.','piklist'); ?></h2>
</div>

 <div class="flex flex-row space-x-4  ">



<div>
   
     
      <h3><?php _e('The Station Pro', 'piklist');?></h3>
      <h4><?php _e('- Station Pro is a responsive design player and then transform your simple wordpress into a better radio player..','piklist');?></h4>
      <h4><?php printf(__('- Station Pro  is compatible with SHOUTcast and Icecast metatada showing title song in your player. (Only premium)','piklist'),'<code>','</code>');?></h4>
      <h4><?php printf(__('- Works over ssl (https) websites.','piklist'),'<code>','</code>');?></h4>
      <h4><?php printf(__('- Smooth animated transitions of player','piklist'),'<code>','</code>');?></h4>
      <p class="mt-10">
        <?php _e('<a 
        class="hover:text-white focus:text-white  hover:bg-indigo-500 transition duration-500 
        bg-indigo-700 px-4 py-4 block uppercase rounded-md   w-full text-center text-white" href='.stationpro()->get_upgrade_url().'> UPGRADE NOW</a>', 'piklist') ;?>
      </p>
   
</div>
 

<div>
 
         
      <img class="screenshot" src="https://res.cloudinary.com/delqcamot/image/upload/v1629761559/StationPRO/banner_1_qxdwju.png">
  
 
</div>

</div>

 
 
<div class="flex flex-row space-x-1 mt-12 justify-items-center justify-between">

<div class="w-1/2 text-center">
<i class="fa fa-bolt fa-5x py-5"></i>
<h4><?php _e('Compatible with Shoutcast 1/2 & Icecast 2 servers.', 'piklist');?></h4>
</div>

<div class="w-1/2 text-center">
<i class="fas fa-mobile-alt fa-5x  py-5"> </i>
<h4><?php _e('Optimized to look great on Desktop, Tablet and Phone!', 'piklist');?></h4>
</div>

<div class="w-1/2 text-center">
<i class="fas fa-headset fa-5x  py-5"> </i>
<h4><?php _e('100% Guaranteed support. Updates and improvements in the future.', 'piklist');?></h4>

</div>

</div>


 
<div class="section">
  <h2 class="about-headline-callout"><?php _e('How to use Station Pro','piklist');?></h2>
  <p class="about-description"><?php _e('This is a small introduction the how to use the plugin Station Pro. Before looking at your brondcast link to work with this plugin.','piklist');?></p>

  <div class="feature-section col three-col">

    <div class="col-1">
      <h3><?php _e('Links the your broadcast','piklist');?></h3>
        <ul>
          <li><?php _e('- Check your broadcast link first if you can open it in your browser and play as normal.','piklist');?></li>
          <li><?php _e('- Some streams must have a "stream" prefix at the end of the browser link to the stream.','piklist');?></li>
          <li><?php _e('- Insert your URL into the fields according to your shoutcast or icecast broadcast, then click Save.');?></li>
          <li><?php _e('- Access your page and play wait to see if
it s working.', 'piklist') ?></li>
        </ul>
    </div>

    <div class="col-2">
      <h3><?php _e('Cors for Metadata working','piklist');?></h3>
        <ul>
          <li><?php _e('Cross-Origin Response Sharing is a client side security mechanism to prevent scripts from accessing other websites outside of the website the script originated from. ','piklist');?></li>
          <li><?php _e('Websites can opt-in to CORS by responding with various Access-Control headers.','piklist');?></li>
          <li><?php _e('Browsers will send an pre-flight OPTIONS request to the cross-origin resource when a script attempts to access a cross-origin resource. The actual request will be allowed only if the OPTIONS response contains the appropriate Access-Control headers.','piklist');?></li>
          <li><?php _e('Read more about CORS here: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS','piklist');?></li>
        </ul>
    </div>

    <div class="col-3 last-feature">
     
        <ul>
          <li><?php _e('We support work for email with replay 48/7 week','piklist');?></li>
          <li><?php _e('meta 1','piklist');?></li>
          <li><?php _e('meta 2','piklist');?></li>
          <li><?php _e('meta 3','piklist');?></li>
        </ul>
    </div>

  </div>

  <div class="feature-section col three-col">

    <div class="col-1">
     
    </div>

    <div class="col-2">
   
    </div>

    <div class="col-3 last-feature">
    
    </div>

  </div>

</div>



<div class="section">
  <div class="feature-section col three-col">
 
    <div class="col-2">
      <h2 class="about-headline-callout"><?php _e('Get Help','piklist');?></h2>
      <p class="about-description"><?php _e('Visit the StationPro.co to get answers to your questions, and suggest new features.','piklist');?></p>
      <a href="https://stationpro.co/"><?php printf(__('Visit StationPro.co %s','piklist'),'&#8594;');?></a>
    </div>
     
  </div>
</div>



 

</div>

<script type="text/javascript">
var addthis_share = {
    url_transforms : {
        shorten: {
             twitter: 'bitly'
        }
    },
    shorteners : {
        bitly : {}
    }
}
var addthis_config = {"data_track_addressbar":false};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fc6697407a3afe4"></script>
<!-- AddThis Button END -->

<style type="text/css">
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css");
@import "https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css";
  html,
  #wpcontent {
    background-color: #fff;
  }

 
  .about-wrap .feature-section {
    padding-bottom: 0;
  }

  .about-wrap .feature-section.two-col > div.alt-feature {
    float: right;
  }

  .wrap > h2 {
    display: none;
  }

  img.screenshot {
    width: 90%;
  }

 

  .icon16.icon-comments:before {
    font-size: 40px;
    padding: 0;
  }

  .piklist-badge {
    color: #3f37c9;
    background: url('https://res.cloudinary.com/delqcamot/image/upload/v1629761557/StationPRO/station_icon_qzstgi.png') no-repeat center 0px transparent !important;
    margin-top: 0;
    padding-top: 85px;
    display: inline-block;
    font-size: 14px;
    font-weight: 600;
    height: 40px;
    text-align: center;
    text-rendering: optimizelegibility;
    width: 150px;
    position: absolute;
    right: 0;
    top: 0;
  }

    .piklist-badge span {
      font-size: 16px;
    }

  #mce-EMAIL {
    font-family: monospace;
    font-size: 14px;
    padding: 5px 2px;
    margin: 5px 0;
    width: 100%;
  }

  .piklist-social-links a {
    padding: 5px;
    color: #fff;
    text-decoration: none;
  }

  .piklist-social-links a:hover {
    text-decoration: none;
    color: #F0F0F0;
  }

  .piklist-social-links a.facebook_link {
    background: #3460A1;
  }

  .piklist-social-links a.twitter_link {
    background: #29AAE3;
  }

  .piklist-social-links a.google_plus_link {
    background: #3460A1;
  }

  .piklist-social-links a span.dashicons {
    display: inline-block;
    -webkit-font-smoothing: antialiased;
    line-height: 1;
    font-family: 'Dashicons';
    text-decoration: none;
    font-weight: normal;
    font-style: normal;
    vertical-align: middle;
  }

  /* 3.7 style helpers */
  body.branch-3-7 .about-wrap .feature-section.col {
    margin-bottom: 0;
  }

  body.branch-3-7 .about-wrap hr {
    border: 0;
    height: 0;
    margin: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
  }

  body.branch-3-7 img.screenshot {
    vertical-align: bottom;
  }

  body.branch-3-7 .wrap h2 {
    text-align: center;
  }

  body.branch-3-7 .about-wrap .feature-section.two-col {
    padding-bottom: 0;
  }

  /* 3.6 style helpers */
  body.branch-3-6 .about-wrap .feature-section img {
    border: none;
    box-shadow: none;
    margin: 0;
    vertical-align: bottom;
  }

  body.branch-3-6 .about-wrap .feature-section.two-col {
    padding-bottom: 0px;
  }

  body.branch-3-6 .about-wrap hr {
    border: 0;
    height: 0;
    margin: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
  }

  body.branch-3-6 .about-wrap h3 {
    font-size: 22px;
  }

  .about-wrap .feature-section.col .last-feature {
      margin-bottom: 0px;
  }

  .dependent-on-piklist {
      text-align: center;
      border-top: 1px solid #000;
      border-bottom: 1px solid #000;
      padding: 10px 0;
      margin-bottom: 20px;
  }

  .dependent-on-piklist h3 {
      margin: 0;
  }

  @media (max-width: 782px) {

    html,
    #wpwrap {
      background-color: transparent;
    }

    .about-wrap .feature-section.two-col > div.alt-feature {
      float: none;
    }
  }

</style>
