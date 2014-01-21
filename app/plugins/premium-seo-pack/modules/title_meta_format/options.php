<?php
/**
 * module return as json_encode
 * http://www.aa-team.com
 * ======================
 *
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */

function __metaRobotsList() {
	return array(
		'noindex'	=> 'noindex', //support by: Google, Yahoo!, MSN / Live, Ask
		'nofollow'	=> 'nofollow', //support by: Google, Yahoo!, MSN / Live, Ask
		'noarchive'	=> 'noarchive', //support by: Google, Yahoo!, MSN / Live, Ask
		'noodp'		=> 'noodp' //support by: Google, Yahoo!, MSN / Live
	);
}
$__metaRobotsList = __metaRobotsList();


function psp_OpenGraphTypes( $istab = '' ) {
	global $psp;
	
	ob_start();

	$post_types = get_post_types(array(
		'public'   => true
	));
	//$post_types['attachment'] = __('Images', $psp->localizationName);
	//unset media - images | videos are treated as belonging to post, pages, custom post types
	unset($post_types['attachment'], $post_types['revision']);
	
	$options = $psp->get_theoption('psp_title_meta_format');
?>
<div class="psp-form-row<?php echo ($istab!='' ? ' '.$istab : ''); ?>">
	<label><?php _e('Default OpenGraph Type:', $psp->localizationName); ?>	</label>
	<div class="psp-form-item large">
	<span class="formNote">&nbsp;</span>
	<?php
	foreach ($post_types as $key => $value){
		
		$val = '';
		if( isset($options['social_opengraph_default']) && isset($options['social_opengraph_default'][$key]) ){
			$val = $options['social_opengraph_default'][$key];
		}
		?>
		<label for="social_opengraph_default[<?php echo $key;?>]" style="display:inline;float:none;"><?php echo ucfirst(str_replace('_', ' ', $value));?>:</label>
		&nbsp;
		<select id="social_opengraph_default[<?php echo $key;?>]" name="social_opengraph_default[<?php echo $key;?>]" style="width:120px;">
			<option value="none"><?php _e('None', $psp->localizationName); ?></option>
			<?php
			$opengraph_defaults = array(
				'Internet' 	=> array(
					'article'				=> __('article', $psp->localizationName),
					'blog'					=> __('Blog', $psp->localizationName),
					'profile'				=> __('Profile', $psp->localizationName),
					'website'				=> __('Website', $psp->localizationName)
				),
				'Products' 	=> array(
					'book'					=> __('Book', $psp->localizationName)
				),
				'Music' 	=> array(
					'music.album'			=> __('Album', $psp->localizationName),
					'music.playlist'		=> __('Playlist', $psp->localizationName),
					'music.radio_station'	=> __('Radio Station', $psp->localizationName),
					'music.song'			=> __('Song', $psp->localizationName)
				),
				'Videos' => array(
					'video.movie'			=> __('Movie', $psp->localizationName),
					'video.episode'			=> __('TV Episode', $psp->localizationName),
					'video.tv_show'			=> __('TV Show', $psp->localizationName),
					'video.other'			=> __('Video', $psp->localizationName)
				),
			);
			foreach ($opengraph_defaults as $k => $v){
				echo '<optgroup label="' . $k . '">';
				foreach ($v as $kk => $vv){
					echo 	'<option value="' . ( $kk ) . '" ' . ( $val == $kk ? 'selected="true"' : '' ) . '>' . ( $vv ) . '</option>';
				}
				echo '</optgroup>';
			}
			?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
	}
	?>
	</div>
</div>
<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

global $psp;
echo json_encode(
	array(
		$tryed_module['db_alias'] => array(
			/* define the form_messages box */
			'title_meta_format' => array(
				'title' 	=> __('Title & Meta Formats', $psp->localizationName),
				'icon' 		=> '{plugin_folder_uri}assets/menu_icon.png',
				'size' 		=> 'grid_4', // grid_1|grid_2|grid_3|grid_4
				'header' 	=> false, // true|false
				'toggler' 	=> false, // true|false
				'buttons' 	=> true, // true|false
				'style' 	=> 'panel', // panel|panel-widget

				// tabs
				'tabs'	=> array(
					'__tab1'	=> array(__('Format Tags List', $psp->localizationName), 'help_format_tags'),
					'__tab2'	=> array(__('Title Format', $psp->localizationName), 'home_title,post_title,page_title,category_title,tag_title,taxonomy_title,archive_title,author_title,search_title,404_title,pagination_title,use_pagination_title'),
					'__tab3'	=> array(__('Meta Description', $psp->localizationName), 'home_desc,post_desc,page_desc,category_desc,tag_desc,taxonomy_desc,archive_desc,author_desc,pagination_desc,use_pagination_desc'),
					'__tab4'	=> array(__('Meta Keywords', $psp->localizationName), 'home_kw,post_kw,page_kw,category_kw,tag_kw,taxonomy_kw,archive_kw,author_kw,pagination_kw,use_pagination_kw'),
					'__tab5'	=> array(__('Meta Robots', $psp->localizationName), 'home_robots,post_robots,page_robots,category_robots,tag_robots,taxonomy_robots,archive_robots,author_robots,search_robots,404_robots,pagination_robots,use_pagination_robots'),
					'__tab6'	=> array(__('Social Meta', $psp->localizationName), 'social_use_meta,social_include_extra,social_validation_type,social_site_title,social_default_img,social_home_title,social_home_desc,social_home_img,social_home_type,social_opengraph_default')
				),
				
				// create the box elements array
				'elements'	=> array(

					//=============================================================
					//== help
					'help_format_tags' => array(
						'type' 		=> 'message',
						
						'html' 		=> __('
							<h2>Basic Setup</h2>
							<p>You can set the custom page title using defined formats tags.</p>
							<h3>Available Format Tags</h3>
							<ul>
								<li><code>{site_title}</code> : the website\'s title (global availability)</li>
								<li><code>{site_description}</code> : the website\'s description (global availability)</li>
								<li><code>{current_date}</code> : current date (global availability)</li>
								<li><code>{current_time}</code> : current time (global availability)</li>
								<li><code>{current_day}</code> : current day (global availability)</li>
								<li><code>{current_year}</code> : current year (global availability)</li>
								<li><code>{current_month}</code> : current month (global availability)</li>
								<li><code>{current_week_day}</code> : current day of the week (global availability)</li>
								
								
								<li><code>{title}</code> : the page|post title (global availability)</li>
								<li><code>{id}</code> : the page|post id (specific availability)</li>
								<li><code>{date}</code> : the page|post date (specific availability)</li>
								<li><code>{description}</code> - the page|post full description (specific availability)</li>
								<li><code>{short_description}</code> - the page|post excerpt or if excerpt does not exist, 200 character maximum are retrieved from description (specific availability)</li>
								<li><code>{parent}</code> - the page|post parent title (specific availability)</li>
								<li><code>{author}</code> - the page|post author name (specific availability)</li>
								<li><code>{author_username}</code> - the page|post author username (specific availability)</li>
								<li><code>{author_nickname}</code> - the page|post author nickname (specific availability)</li>
								<li><code>{author_description}</code> - the page|post author biographical Info (specific availability)</li>
								<li><code>{categories}</code> : the post categories names list separated by comma (specific availability)</li>
								<li><code>{tags}</code> : the post tags names list separated by comma (specific availability)</li>
								<li><code>{terms}</code> : the post custom taxonomies terms names list separated by comma (specific availability)</li>
								<li><code>{category}</code> - the category name or the post first found category name (specific availability)</li>
								<li><code>{category_description}</code> - the category description or the post first found category description (specific availability)</li>
								<li><code>{tag}</code> - the tag name or the post first found tag name (specific availability)</li>
								<li><code>{tag_description}</code> - the tag description or the post first found tag description (specific availability)</li>
								<li><code>{term}</code> - the term name or the post first found custom taxonomy term name (specific availability)</li>
								<li><code>{term_description}</code> - the term description or the post first found custom taxonomy term description (specific availability)</li>
								<li><code>{search_keyword}</code> : the word(s) used for search (specific availability)</li>
								<li><code>{keywords}</code> : the post|page keywords already defined (specific availability)</li>
								<li><code>{focus_keywords}</code> : the post|page focus keywords already defined (specific availability)</li>
								<li><code>{totalpages}</code> - the total number of pages (if pagination is used), default value is 1 (specific availability)</li>
								<li><code>{pagenumber}</code> - the page number (if pagination is used), default value is 1 (specific availability)</li>
							</ul><br />
							<p>Info: when use {keywords}, if for a specific post|page {focus_keywords} is found then it is used, otherwise {keywords} remains active</p>
							', $psp->localizationName)
					),

					//=============================================================
					//== title format
					'home_title' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '{site_title}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Homepage Title Format:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags', $psp->localizationName)
					),
					'post_title'			=> array(
						'type' 		=> 'text',
						'std' 		=> '{title} | {site_title}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Post Title Format:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {id} {date} {description} {short_description} {parent} {author} {author_username} {author_nickname} {categories} {tags} {terms} {category} {category_description} {tag} {tag_description} {term} {term_description} {keywords} {focus_keywords}'
					),
					'page_title'	=> array(
						'type' 		=> 'text',
						'std' 		=> '{title} | {site_title}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Page Title Format:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {id} {date} {description} {short_description} {parent} {author} {author_username} {author_nickname} {categories} {tags} {terms} {category} {category_description} {tag} {tag_description} {term} {term_description} {keywords} {focus_keywords}'
					),
					'category_title'=> array(
						'type' 		=> 'text',
						'std' 		=> '{title} | {site_title}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Category Title Format:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {category} {category_description}'
					),
					'tag_title'=> array(
						'type' 		=> 'text',
						'std' 		=> '{title} | {site_title}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Tag Title Format:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {tag} {tag_description}'
					),
					'taxonomy_title'=> array(
						'type' 		=> 'text',
						'std' 		=> '{title} | {site_title}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Custom Taxonomy Title Format:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {term} {term_description}'
					),
					'archive_title'=> array(
						'type' 		=> 'text',
						'std' 		=> '{title} ' . __('Archives', $psp->localizationName) . ' | {site_title}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Archives Title Format:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {date} ' . __('- is based on archive type: per year or per month,year or per day,month,year', $psp->localizationName)
					),
					'author_title'	=> array(
						'type' 		=> 'text',
						'std' 		=> '{title} | {site_title}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Author Title Format:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {author} {author_username} {author_nickname}'
					),
					'search_title'	=> array(
						'type' 		=> 'text',
						'std' 		=> __('Search for ', $psp->localizationName) . '{search_keyword} | {site_title}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Search Title Format:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {search_keyword}'
					),
					'404_title'		=> array(
						'type' 		=> 'text',
						'std' 		=> __('404 Page Not Found |', $psp->localizationName) . ' {site_title}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('404 Page Not Found Title Format;', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags', $psp->localizationName)
					),
					'pagination_title'=> array(
						'type' 		=> 'text',
						'std' 		=> '{title} ' . __('- Page', $psp->localizationName) . ' {pagenumber} ' . __('of', $psp->localizationName) . ' {totalpages} | {site_title}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Pagination Title Format:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {totalpages} {pagenumber}'
					),
					'use_pagination_title' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Use Pagination:', $psp->localizationName),
						'desc' 		=> __('Choose Yes if you want to use Pagination Title Format in pages where it can be applied!', $psp->localizationName),
						'options'	=> array(
							'yes' 	=> __('YES', $psp->localizationName),
							'no' 	=> __('NO', $psp->localizationName)
						)
					),
					
					//=============================================================
					//== meta description
					'home_desc' 	=> array(
						'type' 		=> 'textarea',
						'std' 		=> '{site_description}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Homepage Meta Description:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags', $psp->localizationName)
					),
					'post_desc'			=> array(
						'type' 		=> 'textarea',
						'std' 		=> '{description} | {site_description}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Post Meta Description:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {id} {date} {description} {short_description} {parent} {author} {author_username} {author_nickname} {categories} {tags} {terms} {category} {category_description} {tag} {tag_description} {term} {term_description} {keywords} {focus_keywords}'
					),
					'page_desc'	=> array(
						'type' 		=> 'textarea',
						'std' 		=> '{description} | {site_description}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Page Meta Description:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {id} {date} {description} {short_description} {parent} {author} {author_username} {author_nickname} {categories} {tags} {terms} {category} {category_description} {tag} {tag_description} {term} {term_description} {keywords} {focus_keywords}'
					),
					'category_desc'=> array(
						'type' 		=> 'textarea',
						'std' 		=> '{category_description}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Category Meta Description:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {category} {category_description}'
					),
					'tag_desc'=> array(
						'type' 		=> 'textarea',
						'std' 		=> '{tag_description}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Tag Meta Description:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {tag} {tag_description}'
					),
					'taxonomy_desc'=> array(
						'type' 		=> 'textarea',
						'std' 		=> '{term_description}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Custom Taxonomy Meta Description:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {term} {term_description}'
					),
					'archive_desc'=> array(
						'type' 		=> 'textarea',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Archives Meta Description:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {date} ' . __('- is based on archive type: per year or per month,year or per day,month,year', $psp->localizationName)
					),
					'author_desc'	=> array(
						'type' 		=> 'textarea',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Author Meta Description:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {author} {author_username} {author_nickname} {author_description}'
					),
					'pagination_desc'=> array(
						'type' 		=> 'textarea',
						'std' 		=> __('Page {pagenumber}', $psp->localizationName),
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Pagination Meta Description:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {totalpages} {pagenumber}'
					),
					'use_pagination_desc' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Use Pagination:', $psp->localizationName),
						'desc' 		=> __('Choose Yes if you want to use Pagination Meta Description in pages where it can be applied!', $psp->localizationName),
						'options'	=> array(
							'yes' 	=> __('YES', $psp->localizationName),
							'no' 	=> __('NO', $psp->localizationName)
						)
					),
					
					//=============================================================
					//== meta keywords
					'home_kw' 	=> array(
						'type' 		=> 'text',
						'std' 		=> '{keywords}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Homepage Meta Keywords:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags', $psp->localizationName)
					),
					'post_kw'			=> array(
						'type' 		=> 'text',
						'std' 		=> '{keywords}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Post Meta Keywords:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {id} {date} {description} {short_description} {parent} {author} {author_username} {author_nickname} {categories} {tags} {terms} {category} {category_description} {tag} {tag_description} {term} {term_description} {keywords} {focus_keywords}'
					),
					'page_kw'	=> array(
						'type' 		=> 'text',
						'std' 		=> '{keywords}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Page Meta Keywords:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {id} {date} {description} {short_description} {parent} {author} {author_username} {author_nickname} {categories} {tags} {terms} {category} {category_description} {tag} {tag_description} {term} {term_description} {keywords} {focus_keywords}'
					),
					'category_kw'=> array(
						'type' 		=> 'text',
						'std' 		=> '{keywords}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Category Meta Keywords:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {category} {category_description}'
					),
					'tag_kw'=> array(
						'type' 		=> 'text',
						'std' 		=> '{keywords}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Tag Meta Keywords:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {tag} {tag_description}'
					),
					'taxonomy_kw'=> array(
						'type' 		=> 'text',
						'std' 		=> '{keywords}',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Custom Taxonomy Meta Keywords:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {term} {term_description}'
					),
					'archive_kw'=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Archives Meta Keywords:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {date} ' . __('- is based on archive type: per year or per month,year or per day,month,year', $psp->localizationName)
					),
					'author_kw'	=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Author Meta Keywords:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {author} {author_username} {author_nickname}'
					),
					'pagination_kw'=> array(
						'type' 		=> 'text',
						'std' 		=> '',
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Pagination Meta Keywords:', $psp->localizationName),
						'desc' 		=> __('Available here: (global availability) tags; (specific availability) tags:', $psp->localizationName) . ' {totalpages} {pagenumber}'
					),
					'use_pagination_kw' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Use Pagination:', $psp->localizationName),
						'desc' 		=> __('Choose Yes if you want to use Pagination Meta Keywords in pages where it can be applied!', $psp->localizationName),
						'options'	=> array(
							'yes' 	=> __('YES', $psp->localizationName),
							'no' 	=> __('NO', $psp->localizationName)
						)
					),
					
					//=============================================================
					//== meta robots
					'home_robots' 	=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array(),
						'size' 		=> 'small',
						'force_width'=> '400',
						'title' 	=> __('Homepage Meta Robots:', $psp->localizationName),
						'desc' 		=> __('if you do not select "noindex" => "index" is by default active; if you do not select "nofollow" => "follow" is by default active', $psp->localizationName),
						'options'	=> $__metaRobotsList
					),
					'post_robots'	=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array(),
						'size' 		=> 'small',
						'force_width'=> '400',
						'title' 	=> __('Post Meta Robots:', $psp->localizationName),
						'desc' 		=> __('if you do not select "noindex" => "index" is by default active; if you do not select "nofollow" => "follow" is by default active', $psp->localizationName),
						'options'	=> $__metaRobotsList
					),
					'page_robots'	=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array(),
						'size' 		=> 'small',
						'force_width'=> '400',
						'title' 	=> __('Page Meta Robots:', $psp->localizationName),
						'desc' 		=> __('if you do not select "noindex" => "index" is by default active; if you do not select "nofollow" => "follow" is by default active', $psp->localizationName),
						'options'	=> $__metaRobotsList
					),
					'category_robots'=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array(),
						'size' 		=> 'small',
						'force_width'=> '400',
						'title' 	=> __('Category Meta Robots:', $psp->localizationName),
						'desc' 		=> __('if you do not select "noindex" => "index" is by default active; if you do not select "nofollow" => "follow" is by default active', $psp->localizationName),
						'options'	=> $__metaRobotsList
					),
					'tag_robots'=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array(),
						'size' 		=> 'small',
						'force_width'=> '400',
						'title' 	=> __('Tag Meta Robots:', $psp->localizationName),
						'desc' 		=> __('if you do not select "noindex" => "index" is by default active; if you do not select "nofollow" => "follow" is by default active', $psp->localizationName),
						'options'	=> $__metaRobotsList
					),
					'taxonomy_robots'=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array(),
						'size' 		=> 'small',
						'force_width'=> '400',
						'title' 	=> __('custom Taxonomy Meta Robots:', $psp->localizationName),
						'desc' 		=> __('if you do not select "noindex" => "index" is by default active; if you do not select "nofollow" => "follow" is by default active', $psp->localizationName),
						'options'	=> $__metaRobotsList
					),
					'archive_robots'=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array('noindex','nofollow','noarchive','noodp'),
						'size' 		=> 'small',
						'force_width'=> '400',
						'title' 	=> __('Archives Meta Robots:', $psp->localizationName),
						'desc' 		=> __('if you do not select "noindex" => "index" is by default active; if you do not select "nofollow" => "follow" is by default active', $psp->localizationName),
						'options'	=> $__metaRobotsList
					),
					'author_robots'	=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array('noindex','nofollow','noarchive','noodp'),
						'size' 		=> 'small',
						'force_width'=> '400',
						'title' 	=> __('Author Meta Robots:', $psp->localizationName),
						'desc' 		=> __('if you do not select "noindex" => "index" is by default active; if you do not select "nofollow" => "follow" is by default active', $psp->localizationName),
						'options'	=> $__metaRobotsList
					),
					'search_robots'	=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array('noindex','nofollow','noarchive','noodp'),
						'size' 		=> 'small',
						'force_width'=> '400',
						'title' 	=> __('Search Robots:', $psp->localizationName),
						'desc' 		=> __('if you do not select "noindex" => "index" is by default active; if you do not select "nofollow" => "follow" is by default active', $psp->localizationName),
						'options'	=> $__metaRobotsList
					),
					'404_robots'		=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array('noindex','nofollow','noarchive','noodp'),
						'size' 		=> 'small',
						'force_width'=> '400',
						'title' 	=> __('404 Page Not Found Robots:', $psp->localizationName),
						'desc' 		=> __('if you do not select "noindex" => "index" is by default active; if you do not select "nofollow" => "follow" is by default active', $psp->localizationName),
						'options'	=> $__metaRobotsList
					),
					'pagination_robots'=> array(
						'type' 		=> 'multiselect',
						'std' 		=> array('noindex','nofollow','noarchive','noodp'),
						'size' 		=> 'small',
						'force_width'=> '400',
						'title' 	=> __('Pagination Meta Robots:', $psp->localizationName),
						'desc' 		=> __('if you do not select "noindex" => "index" is by default active; if you do not select "nofollow" => "follow" is by default active', $psp->localizationName),
						'options'	=> $__metaRobotsList
					),
					'use_pagination_robots' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Use Pagination:', $psp->localizationName),
						'desc' 		=> __('Choose Yes if you want to use Pagination Meta Robots in pages where it can be applied!', $psp->localizationName),
						'options'	=> array(
							'yes' 	=> __('YES', $psp->localizationName),
							'no' 	=> __('NO', $psp->localizationName)
						)
					),
					
					//=============================================================
					//== social tags
					
					'social_use_meta' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Use Social Meta Tags:', $psp->localizationName),
						'desc' 		=> __('Choose Yes if you want to use Facebook Open Graph Social Meta Tags in all your pages! If you choose No, you can still activate tags for a post in it\'s meta box.', $psp->localizationName),
						'options'	=> array(
							'yes' 	=> __('YES', $psp->localizationName),
							'no' 	=> __('NO', $psp->localizationName)
						)
					),
					'social_include_extra' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Include extra tags:', $psp->localizationName),
						'desc' 		=> __('Choose Yes if you want to include the following &lt;article:published_time&gt;, &lt;article:modified_time&gt;, &lt;article:author&gt; tags for your posts.', $psp->localizationName),
						'options'	=> array(
							'yes' 	=> __('YES', $psp->localizationName),
							'no' 	=> __('NO', $psp->localizationName)
						)
					),
					'social_validation_type' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Code Validation Type:', $psp->localizationName),
						'desc' 		=> '',
						'options'	=> array(
							'opengraph' 	=> 'opengraph',
							'xhtml' 		=> 'xhtml',
							'html5'			=> 'html5'
						)
					),
					'social_site_title' => array(
						'type' 		=> 'text',
						'std' 		=> get_bloginfo('name'),
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Site Name:', $psp->localizationName),
						'desc' 		=> __('&nbsp;', $psp->localizationName)
					),
					'social_default_img' => array(
						'type' 		=> 'upload_image',
						'size' 		=> 'large',
						'title' 	=> __('Default Image:', $psp->localizationName),
						'value' 	=> __('Upload image', $psp->localizationName),
						'thumbSize' => array(
							'w' => '100',
							'h' => '100',
							'zc' => '2',
						),
						'desc' 		=> __('Here you can specify an image URL or an image from your media library to use as a default image in the event that there is no image otherwise specified for a given webpage on your site.', $psp->localizationName),
					),
					
					'social_home_title' 	=> array(
						'type' 		=> 'text',
						'std' 		=> get_bloginfo('name'),
						'size' 		=> 'large',
						'force_width'=> '400',
						'title' 	=> __('Homepage Title:', $psp->localizationName),
						'desc' 		=> '&nbsp;'
					),
					'social_home_desc' 	=> array(
						'type' 		=> 'textarea',
						'std' 		=> get_bloginfo('description'),
						'size' 		=> 'small',
						'force_width'=> '400',
						'title' 	=> __('Homepage Description:', $psp->localizationName),
						'desc' 		=> '&nbsp;'
					),
					'social_home_img' => array(
						'type' 		=> 'upload_image',
						'size' 		=> 'large',
						'title' 	=> __('Homepage Image:', $psp->localizationName),
						'value' 	=> __('Upload image', $psp->localizationName),
						'thumbSize' => array(
							'w' => '100',
							'h' => '100',
							'zc' => '2',
						),
						'desc' 		=> '&nbsp;',
					),
					'social_home_type' => array(
						'type' 		=> 'select',
						'std' 		=> 'no',
						'size' 		=> 'large',
						'force_width'=> '120',
						'title' 	=> __('Homepage OpenGraph Type:', $psp->localizationName),
						'desc' 		=> '&nbsp;',
						'options'	=> array(
							'blog'					=> __('Blog', $psp->localizationName),
							'profile'				=> __('Profile', $psp->localizationName),
							'website'				=> __('Website', $psp->localizationName)
						)
					),
					
					'social_opengraph_default' => array(
						'type' 		=> 'html',
						'html' 		=> psp_OpenGraphTypes( '__tab6' )
					)

				)
			)
		)
	)
);