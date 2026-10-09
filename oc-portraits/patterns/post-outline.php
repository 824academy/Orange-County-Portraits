<?php
/**
 * Title: Blog post: article starter
 * Slug: oc-portraits/post-outline
 * Categories: oc-portraits
 * Post Types: post
 * Viewport Width: 1400
 * Description: Headings and contextual links for a new article.
 *
 * @package oc-portraits
 */

echo ocp_p( 'Opening paragraph: who this article is for and the question it answers.' );
echo ocp_heading( 'First main point' ) . ocp_p( 'Practical advice in a few short paragraphs.' );
echo ocp_heading( 'Second main point' ) . ocp_p( 'Link naturally to a related page, for example <a href="' . ocp_url( '/families/' ) . '">family sessions</a> or <a href="' . ocp_url( '/experience-pricing/' ) . '">the experience &amp; pricing</a>.' );
echo ocp_heading( 'In short' ) . ocp_p( 'A short summary, then invite readers to <a href="' . ocp_inquiry_url() . '">plan a session</a>.' );
