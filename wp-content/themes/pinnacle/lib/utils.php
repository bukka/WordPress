<?php

/**
 * Page titles
 */
function kadence_title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      echo get_the_title(get_option('page_for_posts', true));
    } else {
      _e('Latest Posts', 'pinnacle');
    }
  } elseif (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    if ($term) {
      echo $term->name;
    } elseif (is_post_type_archive()) {
      echo get_queried_object()->labels->name;
    } elseif (is_day()) {
      printf(__('Daily Archives: %s', 'pinnacle'), get_the_date());
    } elseif (is_month()) {
      printf(__('Monthly Archives: %s', 'pinnacle'), get_the_date('F Y'));
    } elseif (is_year()) {
      printf(__('Yearly Archives: %s', 'pinnacle'), get_the_date('Y'));
    } elseif (is_author()) {
      printf(__('Author Archives: %s', 'pinnacle'), get_the_author());
    } else {
      single_cat_title();
    }
  } elseif (is_search()) {
    printf(__('Search Results for %s', 'pinnacle'), get_search_query());
  } elseif (is_404()) {
    _e('Not Found', 'pinnacle');
  } else {
    the_title();
  }
}

function kad_is_element_empty($element) {
  $element = trim($element);
  return empty($element) ? false : true;
}
