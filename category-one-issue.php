<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */
	scientific_2016_the_archive_title( '<h1 class="page-title">', '</h1>' );

	if ( isset( $issue_sub_categories ) ) {
		// show the issue posts by category
		foreach ( $issue_sub_categories as $issue_sub_category ) {
			$sub_cat_posts;
			// the first category's posts were already retrieved by WP, so just print them
			if ( strpos( urldecode($issue_sub_category->slug), FIRST_CATEGORY_TO_SHOW_IN_ISSUE ) > -1 ) {
				global $wp_query;
				$sub_cat_posts = $wp_query;
				set_query_var( 'content_type', Scientific2016ContentType::Articles );
			}
			else {
				// get the posts of the sub category and print them
				$sub_cat_posts = new WP_Query( 'cat=' . $issue_sub_category->cat_ID . '&posts_per_page=-1&orderby=name' );
				if ( strpos( urldecode($issue_sub_category->slug), __('opinions', 'scientific-2016') ) > -1 ) {
					set_query_var( 'content_type', Scientific2016ContentType::Opinions );
				}
				if ( strpos( urldecode($issue_sub_category->slug), __('fast_science', 'scientific-2016') ) > -1 ) {
					set_query_var( 'content_type', Scientific2016ContentType::Fast_science );
				}
			}
			scientific_2016_issue_posts( $sub_cat_posts, $issue_sub_category );
		}
	}